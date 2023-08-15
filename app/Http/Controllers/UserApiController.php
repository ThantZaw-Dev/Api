<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function Register(Request $request)
    {
        $fields = $request->validate(['name' => 'required|string', 'email' => 'required|unique:users', 'password' => 'required|min:6']);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        //create token for user auth
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged out'], 200);
    }

    public function Login(Request $request)
    {
        $fields = $request->validate([ 'email' => 'required', 'password' => 'required|min:6']);

        //Check Email
        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ]);
        }

        //create token for user auth
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }
}
