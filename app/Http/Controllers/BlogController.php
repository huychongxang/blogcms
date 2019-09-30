<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CommentStoreRequest;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit = 2;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user', 'category', 'tags', 'comments')
            ->published()
            ->filter(request()->only(['term', 'month', 'year']))
            ->paginate($this->limit);
        return view('blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function comments(CommentStoreRequest $request, Post $post)
    {
        $createComment = $post->comments()->create($request->all());
        if ($createComment) {
            return redirect()->back()->with('success', 'Thêm bình luận thành công');
        } else {
            return redirect()->back()->with('fail', 'Thêm bình luận thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->increment('view_count');
        $postComments = $post->comments()->simplePaginate(3);
        return view('blog.show', compact('post', 'postComments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Filter posts by category
    public function category(Category $category)
    {
        $categoryName = $category->title;
        $posts = $category->posts()
            ->with('user', 'category', 'tags', 'comments')
            ->latest()
            ->published()
            ->paginate($this->limit);
        return view('blog.index', compact('posts', 'categoryName'));
    }

    // Filter posts by author
    public function author(User $user)
    {
        $authorName = $user->name;
        $posts = $user->posts()
            ->with('category', 'tags', 'comments')
            ->latest()
            ->published()
            ->paginate($this->limit);
        return view('blog.index', compact('posts', 'authorName'));
    }

    // Filter posts by tag
    public function tag(Tag $tag)
    {
        $tagName = $tag->name;
        $posts = $tag->posts()
            ->with('category', 'tags', 'comments')
            ->latest()
            ->published()
            ->paginate($this->limit);
        return view('blog.index', compact('posts'));
    }
}
