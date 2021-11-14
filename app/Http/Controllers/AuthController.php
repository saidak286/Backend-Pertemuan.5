<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // membuat fitur Register
    function register(Request $request) 
    {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($input);

        $data = [
            'message' => 'User berhasil dibuat'
        ];

        return response()->json($data, 200);
    }

    function login(Request $request) 
    {
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $input['email'])->first();

        $LoginSuccessfuly = (
            $input['email'] == $user->email
            &&
            Hash::check($input['password'], $user->password)
        );

        if ($LoginSuccessfuly) {
            
            $token = $user->createToken('auth_token');

            $data = [
                'message' => 'Login successfuly',
                'token' => $token->plainTextToken
            ];

            return response()->json($data, 200);
        }
        else {

            $data = [
                'message' => 'Username or Password is wrong'
            ];

            return response()->json($data, 401);
        }
    }


    // function login(Request $request)
    // {
    //     $input = [
    //         'email' => $request->email,
    //         'password' => $request->password
    //     ];

    //     if (Auth::attempt($input)) {

    //         $token = Auth::user()->createToken('auth_token');

    //         $data = [
    //             'message' => 'Login successfuly',
    //             'token' => $token->plainTextToken
    //         ];

    //         return response()->json($data, 201);
    //     }
    //     else {

    //         $data = [
    //             'message' => 'Username or Password is wrong'
    //         ];

    //         return response()->json($data, 401);
    //     }
    // }
}
