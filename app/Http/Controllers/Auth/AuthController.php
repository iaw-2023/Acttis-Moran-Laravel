<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\OrderResource;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        
        if ( ! $token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['errors' => 'Invalid email or Password'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $user = User::create(array_merge(
            $validator->validate(),
            ['password' => bcrypt($request->password),]
        ));

        return response()->json([
            'message' => '¡Successfully registered user!',
            'user' => $user,
        ], 201);
    }

     /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the orders associated to the logged user using token
     * 
     */
    public function userOrders(Request $request)
    {
        $currentUser = auth()->guard('api')->user();

        if(!$currentUser)
            return response()->json(['status' => 'Invalid Token.'], 401);

        $userOrders = Order::where('client_email', $currentUser->email)->get();

        if($userOrders->isEmpty())
            return response()->json(['status' => 'Not found orders associated with the user.'], 404);

        return OrderResource::collection($userOrders);
    }
}