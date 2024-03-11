<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class CustomerAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'firstname' =>'required|string',
            'email' =>'required|string|email|max:255|unique:customers',
            'password'=>'required|string|min:6'        
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $customers = Customers::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' =>$request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = auth('api')->login($customers);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if($token = auth('api')->attempt($credentials)){
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'unauthorized'], 401);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
