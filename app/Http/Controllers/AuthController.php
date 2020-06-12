<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use App\Http\Requests\ToggleAdminRoleRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(registerRequest $request)
    {
        $user = User::create($request->all()); // create user
        return response()->json(
            ['data' => [
                'type' => 'user',
                'id' => $user->id,
                'attributes' => [ $user ] 
            ]
        ],201);
    }

    public function login(loginRequest $request)
    {
        try {
            if (! $token = JWTAuth::attempt($request->all())) { //credencials don't match
                return response()->json(
                    ['error' => [
                        'status' => '404',
                        'title' => 'Invalid credentials',
                        'detail' => 'Didn\'t find an account with this credentials.'
                    ]
                ], 404);
            }
        } catch (JWTException $e) { //something is bad
            return response()->json(
                ['error' => [
                    'status' => '500',
                    'title' => 'Login error',
                    'detail' => 'Failed to login, please try again.'
                ]
            ], 500);
        }
        //all good return token
        return response()->json(['data'=> [ 'token' => $token ]], 200);
    }

    public function logout() 
    {
        try {
            //invalidate token
            JWTAuth::invalidate(auth()->user()->getJWTIdentifier());
            //destroy auth session
            auth()->logout();
            return response()->json(
                ['data' => 
                    [ 'message'=> "You have successfully logged out." ]
                ], 200);
        } catch (JWTException $e) {
            return response()->json(
                ['error' => [
                    'status' => '500',
                    'title' => 'Logout error',
                    'detail' => 'Couldn\'t make the logout, please try again.'
                ]
            ], 500);
        }
    }

    public function toggleAdmin(ToggleAdminRoleRequest $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $admin = ($user->admin) ? false : true;
            $user->update(['admin' => $admin]);
            $data = ['data' => [
                'type' => 'user',
                'id' => $user->id,
                'attributes' => [ $user ] 
            ]];
        }
        else{
            $data = $response = ['error' => [
                'status' => '202',
                'title' => 'User not found',
                'detail' => 'The given user isn\'t registered'
            ]];
        }
        return response()->json($data,200);
        
    }
}
