<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends CoreController
{

    public function test(){
        return User::all();
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        error_log("user => ". $user);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ["token" => null, "permissions" => []];
        }
        return [
            "token" => $user->createToken('auth_token')->plainTextToken,
            "permissions" => $user->getPermissionNames(),
            "role" => $user->getRoleNames()->first()
        ];
    }

    public function user(){
        return User::all();
    }
}
