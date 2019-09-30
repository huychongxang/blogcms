<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('name')->paginate($this->limit);
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name', 'id');
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $newUser = User::create($request->all());
        if ($newUser) {
            $newUser->attachRole($request->role);
            return redirect()->route('backend.users.index')->with('success', 'Tạo user thành công');
        } else {
            return redirect()->route('backend.users.index')->with('fail', 'Tạo mới thất bại');
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('display_name', 'id');
        return view('backend.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $updateUser = $user->update($data);
        if ($updateUser) {
            $user->detachRoles();
            $user->attachRole($request->role);
            return redirect()->route('backend.users.index')->with('success', 'Update thành công');
        } else {
            return redirect()->route('backend.users.index')->with('fail', 'Update thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $delete_option = $request->delete_option;
        $selected_user = $request->selected_user;

        if ($delete_option == 'delete') {
            //delete user posts
            $user->posts()->withTrashed()->forceDelete();
        } elseif ($delete_option == 'attribute') {
            $user->posts()->update([
                'user_id' => $selected_user,
            ]);
        }
        $destroyUser = $user->delete();
        if ($destroyUser) {
            return redirect()->route('backend.users.index')->with('success', 'Xóa user thành công');
        } else {
            return redirect()->route('backend.users.index')->with('fail', 'Xóa user thất bại');
        }
    }

    public function confirm($id)
    {
        $users = User::where('id', '!=', $id)->pluck('name', 'id');
        $user = User::findOrFail($id);
        return view('backend.users.confirm', compact('user', 'users'));
    }
}
