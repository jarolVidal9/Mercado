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
        return response()->json(['user'=>$user], 201);
    }
    public function EditUser(User $user,EditUserRequest $request){
        $user->update($request->all());
        return response()->json(['user'=>$user->refresh()], 200);
    }
    public function deleteUser(User $user){
        $user->delete();
        return response()->json([], 204);
    }
}
