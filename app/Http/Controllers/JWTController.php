<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPasswor;
class JWTController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'registerUser']]);
    }

     public function destroy(Request $request)
    {
        $request->delete();
        return response()->json([
            'message' => 'User Deleted!'
        ], 200);
    }

    /**
     * Register user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request -> name,
            'lname' => $request -> lname,
            'cName' => $request -> cName,
            'country' => $request -> country,
            'nEmployee' => $request -> nEmployee,
            'sector' => $request -> sector,
            'rCode' => $request -> rCode,
            'email' => $request -> email,
            'password' => Hash::make($request->password)
            ]);
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }




// staff registration
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $staff = Staff::create([
            'name' => $request -> name,
            'lname' => $request -> lname,
            'country' => $request -> country,
            'email' => $request -> email,
            'role' => $request -> role,
            'password' => Hash::make($request->password)
            ]);
        return response()->json([
            'message' => 'Staff successfully registered',
            'user' => $staff
        ], 201);

       }
    //    end of


    // me
    public function me()
    {
        return response()->json(auth('admin_api')->user());
    }


    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Either email or password is wrong.'], 401);
        }

        return $this->respondWithToken($token);
    }


    public function guard(){
        return Auth::guard('api');
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully logged out.']);
    }

    /**
     * Refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
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
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
    public function forgetPasword(){

    }

}

