<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Stuff;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Detail;
use Exception;

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
    function saveTransaction(Request $req)
    {
        try {
            $nota = Str::random(10);

            Transaction::create([
                'nota' => $nota,
                'id_user' => $req->input('id_user'),
                'id_customer' => null,
                'pembeli' => $req->input('pembeli'),
                'desc' => $req->input('desc'),
                'date' => date('Y-m-d H:i:s'),
            ]);

            foreach ($req->input('detail_transaction') as $key => $value) {
            
                Detail::create([
                    'nota' => $nota,
                    'id_stuff' => $value['id'],
                    'price' => $value['price'],
                    'discount' => 0,
                    'count' =>$value['count'],
                ]);
            }
        
            return response()->json([
                'value' => null,
                'isError' => false,
                'error' => null,
            ]);
        
        }
        catch(Exception $e) {

            return response()->json([
                'value' => null,
                'isError' => false,
                'error' => null,
            ]);
        }
    }
}
