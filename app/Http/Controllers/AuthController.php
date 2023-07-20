<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function login(Request $request) {

        $validasi = $request->validate([
            'username' =>'required|string',
            'password' => 'required'
        ]);

        try {
            $user = User::where('username', $validasi["username"])->first();
            if (!$user || !Hash::check($validasi["password"], $user->password)) {
                throw ValidationException::withMessages([
                    'username' => ['Kredensial yang diberikan salah.'],
                ]);
            }

            // create token and send res json
            $token = $user->createToken($validasi["username"])->plainTextToken;
            return response()->json([
                'status' => "success",
                "token" => $token
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => "error",
                "massage" => "Username atau password yang anda berikan salah"
            ], 401);
        }

    }


}
