<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request){

        $credentials = $request->only('email', 'password');
        if(!Auth::attempt($credentials)){
            return response([
                'message' => 'Credenciales Incorrectas!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token =  $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt',$token,68*24);

        return response([
            'message' => 'success'
        ])->withCookie($cookie);

    }

    public function register (Request $request){
        // DB::transaction(function ($request){
            return User::create([ 
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'document_type' => $request->input('document_type'),
                'document_number' => $request->input('document_number')
            ]);
        // });       
      
    }

    public function authenticate(Request $request)
    {
    $credentials = $request->only('email', 'password');
    try {
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales Invalidas'], Response::HTTP_UNAUTHORIZED);
        }
    } catch (JWTException $e) {
        return response()->json(['error' => 'could_not_create_token'], 500);
    }
    return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['No se encuentra el usuario'], 404);
        }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['Token Vencido!'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['Token Invalido'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }
}
