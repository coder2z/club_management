<?php

namespace App\Http\Controllers\User\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $loginRequest)
    {
        try {
            $credentials = self::credentials($loginRequest);
            if (!$token = auth('user')->attempt($credentials)) {
                return response()->fail(100, '账号或者用户名错误!', null);
            }
            if (self::checkUser()) {
                self::logout();
                return response()->fail(100, '用户未启用!', null);
            }
            return self::respondWithToken($token, '登陆成功!');
        } catch (\Exception $e) {
            return response()->fail(500, '登陆失败!', null, 500);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Exception $e) {

        }
        return auth()->check() ?
            response()->fail(100, '注销登陆失败!', null) :
            response()->success(200, '注销登陆成功!', null);
    }

    public function refresh()
    {
        try {
            $newToken = auth()->refresh();
        } catch (\Exception $e) {
        }
        return $newToken != null ?
            self::respondWithToken($newToken, '刷新成功!') :
            response()->fail(100, '刷新token失败!');
    }

    protected function credentials($request)
    {
        return ['school_id' => $request['school_id'], 'password' => $request['password']];
    }

    protected function checkUser()
    {
        return auth()->user()->account_state == '0' ?
            true :
            false;
    }

    protected function respondWithToken($token, $msg)
    {
        return response()->success(200, $msg, array(
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ));
    }
}
