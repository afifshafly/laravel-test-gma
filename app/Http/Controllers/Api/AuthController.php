<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
 /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'toko',
        ]);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        if(!$user->save()){
            return response()->json([
                "message" => "User Gagal Terdaftar"
            ], 401);
        }

        return response()->json([
            "message" => "User registered successfully"
        ], 201);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;

            $response = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                // 'role' => $user->role,
                'token' => $user->createToken('MyToken')->accessToken,
            ];



            return response()->json([
                "user"=>$response,
                // "message" => $user->email,
                // 'token'  => $user->createToken('MyToken')->accessToken
            ],200);
        }
        else{
            return response()->json([
                'message' => 'Invalid Email or Password'
            ],401);
        }
    }

    public function getUser(){
        $user = User::all();

        return response()->json($user);
    }
}
