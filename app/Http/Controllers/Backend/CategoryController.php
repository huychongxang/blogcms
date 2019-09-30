<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $categories = Category::orderBy('title')->with('posts')->paginate($this->limit);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $newCategory = Category::create($request->all());
        if ($newCategory) {
            Session::flash('success', 'Tạo mới thành công');
            return redirect()->route('backend.categories.index');
        } else {
            Session::flash('fail', 'Tạo mới thất bại');
            return redirect()->route('backend.categories.index');
        }
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
        $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        if ($category) {
            Session::flash('success', 'Sửa thành công');
            return redirect()->route('backend.categories.index');
        } else {
            Session::flash('fail', 'Sửa thất bại');
            return redirect()->route('backend.categories.index');
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
        if ($id == config('cms.default_category_id')) {
            return redirect()->back()->with('success', 'Bạn không thể xóa category mặc định');
        }
        $category = Category::findOrFail($id);
        Post::withTrashed()->where('category_id', $id)->update(['category_id' => config('cms.default_category_id')]);
        $category->delete();
        if ($category) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('fail', 'Xóa thất bại');
        }
    }
}
