<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;


class AuthController extends Controller
{
    use ApiResponse;
    
    function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if(!Auth::attempt($request->only('email','password'))){
            return $this->error('Credenciales invalidad', 401);
        }

        $user = $request->user();

        $tokenResult = $user->createToken('api-token',['posts.read','posts.write']);

        $token = $tokenResult->AccessToken;

        return $this->success([
            'token_type' => 'Bearer',
            'access_token' => $token,
            'user' => [
                'email' => $user->email,
                'roles' => $user->roles()->pluck('name'),
            ]
            ]);
    }

    function signup(Request $request) {
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data('name'),
            'email' => $data('email'),
            'password' => Hash::make($data['password']),
        ]);

        $defaulRole = Role::where('name','viewer')->first();
         if($defaulRole){
            $user->roles()->syncWithoutDetaching([$defaulRole->id]);
         }
        return $this->success("Hello Camper!");
    }
    
    function me(Request $request) {
        return $this->success("Hello Camper!");
    }
    function logout(Request $request) {
        return $this->success("Hello Camper!");
    }
}
