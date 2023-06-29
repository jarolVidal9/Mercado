<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserREquest;
use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(){
        $users = User::get();
        return response()->json(['users'=> $users], 200);
    }

    public function getAUser(User $user){
        return response()->json(['user'=>$user], 200);
    }

    public function createUser(CreateUserRequest $request) {
        $user = new User($request->all());
        $user->save();
        if ($request->ajax()) return response()->json(['user'=>$user], 201);
        return back()->with('success', 'Usuario creado');
    }
    public function EditUser(User $user,EditUserRequest $request){
        $user->update($request->all());
        if ($request->ajax()) return response()->json(['user'=>$user->refresh()], 200);
        return back()->with('success', 'Usuario actualizado');
    }
    public function deleteUser(User $user){
        $user->delete();
        return response()->json([], 204);
    }
    //web
    public function showUsers()
    {
        return view('users.users');
    }
}
