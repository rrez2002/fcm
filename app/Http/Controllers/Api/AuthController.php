<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['Logout','Me']);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @Route("api/auth/register",methods=["POST"],name="auth.register")
     */
    public function Register(RegisterRequest $request)
    {
        $data = $request->validated();

        User::create([
            'avatar' => Storage::putFile("avatar",$data['avatar']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return new JsonResponse(["message" => __("auth.register")],Response::HTTP_CREATED);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @Route("api/auth/login",methods=["POST"],name="auth.login")
     */
    public function Login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::once($data)){

            $token = Auth::user()->createToken("")->plainTextToken;

            return new JsonResponse(["message" => __("auth.login"),"token" => $token],Response::HTTP_OK);

        }
        return new JsonResponse(["message" => __("auth.login_failed")],Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("api/auth/logout",methods=["POST"],name="auth.logout")
     */
    public function Logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();

        return new JsonResponse(["message" => __("auth.logout")],Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return UserResource
     * @Route("api/auth/me",methods=["GET"],name="auth.me")
     */
    public function Me(Request $request)
    {
        return new UserResource($request->user());
    }
}
