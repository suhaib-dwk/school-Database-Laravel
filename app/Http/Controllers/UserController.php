<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Jobs\CheckUserJob;
use App\Models\Course;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type
        ]);

        return response()->json([
            'message' => 'User message successful',
            'user' => $user,
        ]);
    }



    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     if (!$token = auth()->attempt($validator->validated())) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     return $this->responseWithToken($token);
    // }

    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => $this->guard()->factory()->getTTL() * 60
    //     ]);
    // }


    // public function guard()
    // {
    //     return Auth::guard();
    // }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = JWTAuth::attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    protected function respondWithToken($token)
    {
        $payload = JWTAuth::setToken($token)->getPayload();
        $user = Auth::user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $payload['exp'] - time(),
            'user' => $user
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function getToken(Request $request) {
        $token = $request->header('Authorization');

        if (str_starts_with($token, 'Bearer ')) {
            return substr($token, 7);
        }

        return null;
    }
}
