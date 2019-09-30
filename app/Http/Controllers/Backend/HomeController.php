<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.home.index');
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        return view('backend.home.edit',compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
        $user = $request->user();
        $update = $user->update($request->all());
        if($update){
            return redirect()->back()->with('success','Account was updated successfully');
        } else {
            return redirect()->back()->with('fail','Account was updated fail');
        }
    }
}
