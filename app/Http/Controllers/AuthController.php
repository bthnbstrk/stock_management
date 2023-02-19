<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\JsonServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    protected $json_service_provider;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->json_service_provider = new JsonServiceProvider();
    }

    public function register(Request $request){
        Log::info($request);
        $validator = Validator::make($request->only(['email', 'name','password','password_confirmation']),[
            'name'=>'required',
            'email'=>'required|string|email|unique:tbl_users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
        ]);

        if($validator->fails()){
          return $this->json_service_provider->fail(["message"=>$validator->errors()->toJson()],400);
        }


        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        $user->token = $token;

        return $this->json_service_provider->success(["message"=>"User created success!","data"=>$user],201);
    }


    public function login(Request $request)
    {
        Log::info($request);
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
               return $this->json_service_provider->fail([
                    "message" => "E-mail or password wrong!",
                ]);
            }
        } catch (JWTException $e) {
            return $this->json_service_provider->fail([
                "message" => "Could not create token!",
            ]);
        }

        return $this->json_service_provider->success([
            "message" => "Login successful!",
            "access_token" => $token,
        ]);
    }


    public function logout(Request $request){
        Log::info($request);
        auth()->logout();
        return $this->json_service_provider->success(["message" => __("response.logoutSuccess")]);
    }

    public function refreshToken(){

        if(auth()->user()){
            return $this->json_service_provider->success([
                "message" => "Successful refresh!",
                "access_token" => auth()->refresh(),
            ]);
        }else{
            return $this->json_service_provider->fail([
                "message" => "User is not authenticated!",
            ]);
        }


    }
}
