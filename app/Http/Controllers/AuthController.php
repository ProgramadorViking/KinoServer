<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\User;
use DB;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function register(Request $request) {
        $user = new User($request->all());
        $user->password=app('hash')->make($request->password);
        $user->save();
        //TODO: estandaritzar la resposta, també donar una resposta en cas d'error
        return response()->json($user);
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);
        

        try {

            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json('invalid', 401);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }
        $users = DB::table('users')->select('rol')->where('email',$request->email)->get();
        $rol=$users[0]->rol;
        $last_login = date_create();
        $data = compact("last_login");
        DB::table('users')->where('email',$request->email)->update($data);
        return response()->json(compact('token','rol'));
    }
}