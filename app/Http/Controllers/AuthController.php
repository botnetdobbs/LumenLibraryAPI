<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Register user
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8'
        ]);
        
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json(["status" => "ok", "user" => $user->only(['name', 'email']), "message" => "user created successfull. Proceed to login"], 201);
        } catch (QueryException $e) {

            return response()->json(['status' => "error", "message" => $e->getMessage()], 500);
        }
    }

    /**
     * Login user
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['status' => 'error', 'message' => 'user not found'], 404);
            }

        return response()->json(['status' => 'ok', "access_token" => array_values(compact('token'))[0]], 200);
    }
}
