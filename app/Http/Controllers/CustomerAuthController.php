<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Validator;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
class CustomerAuthController extends Controller

{
    public function index(){
     
        $users = DB::select('select * from users WHERE role="Admin" && role="Admin" ');
        return response()->json(['data'=>$users], 200);     
        }
        public function getMe(){
            $users = DB::select('select * from users WHERE role="Mentor"');
            return response()->json(['data'=>$users], 200);     
            }
        // getting trainner
    public function getTrainer(){
        $users = DB::select('select * from users WHERE role="Trainner"');
        return response()->json(['data'=>$users], 200);     
    }
           // getting Mentor
    public function getMentor(){
    $users = DB::select('select * from users WHERE role="Mentor"');
    return response()->json(['data'=>$users], 200);     
}
        //getUser By Id
    public function getUserByuId($id){
        $data = User::find($id);
        if(is_null($data)){
            return response()->json(['message' => 'user'],404);
        }
        return response()->json(User::find($id),200);
    }
    // update
        // edit users
   public function updateUser(Request $request, $id){
    $data = User::find($id);
    if(is_null($data)){
        return response()->json(['message' => 'User Edited'],404);
    }
    $data->update($request->all());
    return response($data,200);
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

        $user = User::createCustomer([
            'name' => $request -> name,
            'lname' => $request -> lname,
            'cName' => $request -> cName,
            'country' => $request -> country,
            'nEmployee' => $request -> nEmployee,
            'sector' => $request -> sector,
            'rCode' => $request -> rCode,
            'email' => $request -> email,
            'role' => $request -> role,
            'password' => Hash::make($request->password)
            ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

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
    public function loginCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);    }

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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}