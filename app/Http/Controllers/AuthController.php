<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use stdClass;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $res = new stdClass();
        $res->message = 'Register Success';
        $res->data = $user;
        $res->token = $token;

        return response()->json($res, 200);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid Email or Password'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $res = new stdClass();
        $res->message = 'Login Success';
        $res->token = $token;

        return response()->json($res, 200);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return [
            'message' => 'Logged Out'
        ];
    }

}