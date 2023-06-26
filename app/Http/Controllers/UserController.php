<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserREquest;
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

    public function createUser(CreateUserREquest $request) {
        $user = new User($request->all());
        $user->save();
        return response()->json(['user'=>$user], 201);
    }
}
