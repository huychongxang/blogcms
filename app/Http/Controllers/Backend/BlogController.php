<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = config('cms.image.directory');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed = false;
        if (($status = $request->get('status')) && $status == 'trash') {
            $posts = Post::onlyTrashed()->with('user', 'category')
                ->latest()
                ->paginate($this->limit);
            $onlyTrashed = true;
        } elseif (($status = $request->get('status')) && $status == 'published') {
            $posts = Post::published()->with('user', 'category')
                ->latest()
                ->paginate($this->limit);
        } elseif (($status = $request->get('status')) && $status == 'scheduled') {
            $posts = Post::scheduled()->with('user', 'category')
                ->latest()
                ->paginate($this->limit);
        } elseif (($status = $request->get('status')) && $status == 'draft') {
            $posts = Post::draft()->with('user', 'category')
                ->latest()
                ->paginate($this->limit);
        } elseif (($status = $request->get('status')) && $status == 'own') {
            $posts = $request->user()->posts()->with('user', 'category')
                ->latest()
                ->paginate($this->limit);
        } else {
            $posts = Post::with('user', 'category')
                ->latest()
                ->paginate($this->limit);
        }
        $statusList = $this->statusList($request);
        return view('backend.blog.index', compact('posts', 'onlyTrashed', 'statusList'));
    }

    private function statusList($request)
    {
        return [
            'own' => $request->user()->posts()->count(),
            'all' => Post::count(),
            'published' => Post::published()->count(),
            'scheduled' => Post::scheduled()->count(),
            'draft' => Post::draft()->count(),
            'trash' => Post::onlyTrashed()->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $categories = Category::pluck('title', 'id');
        return view('backend.blog.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $data = $this->handleRequest($request);
        $newPost = $request->user()->posts()->create($data);
        if ($newPost) {
            $newPost->createTags($data["post_tags"]);
            Session::flash('success', 'Tạo mới thành công');
            return redirect()->route('backend.blog.index');
        } else {
            Session::flash('fail', 'Tạo mới thất bại');
            return redirect()->route('backend.blog.index');
        }
    }

    private function handleRequest($request)
    {
        $request->request->add(['view_count' => 0]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $time = time();
            $fileName = $time . $fileName;
            $destination = $this->uploadPath;
            $successUploaded = $image->move($destination, $fileName);
            // Create thumb image
            if ($successUploaded) {
                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }
            // end Create thumb image
            $data['image'] = $fileName;
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('title', 'id');
        return view('backend.blog.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $oldImage = $post->image;
        $data = $this->handleRequest($request);
        $updated = $post->update($data);

        if ($updated) {
            $post->createTags($data['post_tags']);
            if ($oldImage != $post->image) {
                $this->removeImage($oldImage);
            }
            Session::flash('success', 'Sửa thành công');
            return redirect()->route('backend.blog.index');
        } else {
            Session::flash('fail', 'Sửa thất bại');
            return redirect()->route('backend.blog.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id)->delete();
        if ($post) {
            return redirect()->back()->with('trash-message', ['Xóa post thành công', $id]);
        } else {
            return redirect()->back()->with('fail', 'Xóa post thất bại');
        }
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->find($id)->restore();
        if ($post) {
            return redirect()->back()->with('success', 'Undo post thành công');
        } else {
            return redirect()->back()->with('fail', 'Undo post thất bại');
        }
    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $image = $post->image;
        $deletePost = $post->forceDelete();

        if ($deletePost) {
            $this->removeImage($image);
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('fail', 'Xóa thất bại');
        }
    }

    public function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = $this->uploadPath . '/' . $image;
            $ext = substr(strrchr($image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
        }
    }
}
