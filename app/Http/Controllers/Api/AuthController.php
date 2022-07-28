<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeamsRequest;
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
use Pusher\PushNotifications\PushNotifications;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['Login','Register']);
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
            'avatar' => !empty($data['avatar']) ? Storage::putFile("avatar",$data['avatar']) : null,
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

    /**
     * @param BeamsRequest $request
     * @return JsonResponse
     * @throws \Exception
     * @Route("api/auth/beams",methods=["GET"],name="auth.beams")
     */
    public function Beams(BeamsRequest $request)
    {
        $PushNotifications = new PushNotifications([
            "instanceId" => config('broadcasting.connections.pusher.beams_instance_id'),
            "secretKey" => config('broadcasting.connections.pusher.beams_secret_key'),
        ]);

        // If you use a different auth system, do your checks here
        $user = Auth::user();
        $userIdInQueryParam = $request->input('user_id');

        if ($user->id == $userIdInQueryParam) {
            $beamsToken = $PushNotifications->generateToken((string)$user->id)['token'];

            return new JsonResponse($beamsToken);
        }

        return new JsonResponse(['message' => __("message.not_found", ["attribute" => __("attribute.user")])], Response::HTTP_NOT_FOUND);

    }
}
