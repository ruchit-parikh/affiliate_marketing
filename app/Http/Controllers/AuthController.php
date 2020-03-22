<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username|max:255|alpha_num',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:8|max:32|confirmed',
            'profile_img' => 'nullable|url',
            'pay_id' => 'required|string', 
            'pay_type' => ['required', Rule::in(array_column(User::$payouts, 'key'))], 
        ]);

        try {
            $user = User::create($request->only([
                'username', 'name', 'email', 'password', 
                'profile_img', 'pay_id', 'pay_type'
            ]));
            return $this->respondWithToken(auth()->login($user));
        } catch (\Exception $e) {
            return jsonResponse('error', __('auth.register_failed'));
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:8|max:32'
        ]);

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return jsonResponse('error', __('auth.unauthorized'), [], 401);
        }
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return jsonResponse('success', __('auth.logout'));
    }

    /**
     * Return bearer token response with set expiry timeout
     * 
     * @param string $token 
     * @return JSON
     */
    protected function respondWithToken($token)
    {
        return jsonResponse('success', __('auth.loggedin'), [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
