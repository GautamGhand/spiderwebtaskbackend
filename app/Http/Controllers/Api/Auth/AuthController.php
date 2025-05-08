<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\AuthRegisterRequest;
use App\Http\Requests\Api\Auth\AuthRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('Login')->plainTextToken;
            return Response::json([
                'success' => true,
                'message' => 'Login Successfull!',
                'token' => $token
            ], 200);
        }
        return Response::json([
            'success' => false,
            'message' => 'Invalid Credentials!',
        ], 401);
    }
    public function register(AuthRegisterRequest $request){
        try{
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            User::create($data);
            return Response::json([
                'success' => true,
                'message' => 'User Registered Successfully!'
            ]);
        }
        catch(Exception $e){
            return Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ],401);
        }
    }
}
