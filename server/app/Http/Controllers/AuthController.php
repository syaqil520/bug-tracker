<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false,
            ]);
        }

        $data = $validator->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        if($user) return response()->json([
            'success' => true
        ]);

        return response()->json([
            'success' => false,
            'errors' => 'register unsuccessfull'
        ]);

    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false,
            ]);
        }

        $data = $validator->validated();

        if(Auth::attempt($data)) {

            return response()->json([
                'success' => true,
                'errors' => null,
                'user' => Auth::user()

            ]);
        }

        return response()->json([
            'errors' => 'Password or Email is incorrect',
            'success' => false
        ]);

        
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'success' => true
        ], 200);
    }


}
