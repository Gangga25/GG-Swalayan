<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Stuff;
use App\Models\User;

class ApiController extends Controller
{
    function login(Request $req)
    {
        $email = $req->input('email');
        $password = $req->input('password');
        $user = User::where('email', $email)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json([
                    'token' => $token,
                    'value' => $user,
                    'mess' => 'User Ditemukan',
                    'isError' => false,
                ]);
            } else {
                return response()->json([
                    'token' => '',
                    'value' => null,
                    'mess' => 'Password Salah',
                    'isError' => true,
                ]);
            } 
        } else {
            return response()->json([
                'token' => '',
                'value' => null,
                'mess' => 'User tidak ditemukan',
                'isError' => true,
            ]);
        }
    }
    function auth(Request $req)
    {
        if (Auth::check()) {
            $id = Auth::id();
            $user = User::findOrFail($id);

            return response()->json([
                'value' => $user,
                'mess' => 'User Ditemukan',
                'isError' => false,
            ]);

        } else {
            return response()->json([
                'value' => null,
                'mess' => 'User tidak ditemukan',
                'isError' => true,
            ]);
        }
    }
    function stuff(Request $req)
    {
        $data = Stuff::all();

        return response()->json([
            'value' => $data,
            'isError' => false,
        ]);
    }
    function stuffAdd(Request $req)
    {
        $data = Stuff::create($req->all());

        return response()->json([
            'value' => $data,
            'isError' => false,
        ]);
    }
    function stuffUpdate(Request $req, Stuff $stuff )
    {
        $stuff->fill($req->all());
        $data = $stuff->save();

        return response()->json([
            'value' => $data,
            'isError' => false,
        ]);
    }
    function stuffDelete(Request $req, Stuff $stuff )
    {
        $data = $stuff->delete();

        return response()->json([
            'value' => $data,
            'isError' => false,
        ]);
    }
}
