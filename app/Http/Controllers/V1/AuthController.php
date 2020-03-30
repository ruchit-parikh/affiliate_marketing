<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Mail\SendPasswordResetLink;
use App\Role;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username|max:255|alpha_num',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:8|max:32|confirmed',
            'pay_id' => 'required|string', 
            'pay_type' => ['required', Rule::in(array_column(User::$payouts, 'key'))], 
        ]);

        try {
            $request->merge([
                'status' => User::$status['active']['code'], 
                'role_id' => Role::where('slug', User::$default_role)->firstOrFail()->id
            ]);
            $user = User::create($request->only([
                'username', 'name', 'email', 'password', 'role_id',
                'pay_id', 'pay_type', 'status'
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

        try {
            if (!$token = auth()->attempt($request->only(['email', 'password']))) {
                return jsonResponse('error', __('auth.invalid_credentials'), [], 401);
            }
            return $this->respondWithToken($token);
        } catch(\Exception $e) {
            return jsonResponse('error', __('auth.something_went_wrong')); 
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return jsonResponse('success', __('auth.logout'));
        } catch(\Exception $e) {
            return jsonResponse('error', __('auth.something_went_wrong')); 
        }
    }

    public function sendResetPasswordLink(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users,email',
        ]);
        
        try {
            $old_reset = DB::table('password_resets')->where('email', $request->email)->first();
            if (!empty($old_reset)) {
                $token = $old_reset->token;
            } else {
                $token = Str::random(60);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token
                ]);
            }

            Mail::to($request->email)->send(new SendPasswordResetLink($token));
            return jsonResponse('success', __('password.sent'), [
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return jsonResponse('error', __('auth.something_went_wrong'));
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:8|max:32|confirmed', 
        ]);
        $token_row = DB::table('password_resets')->where('email', $request->email);

        if (!empty($token_row->first()) && $token_row->first()->token == $request->token) {
            User::where('email', $request->email)->firstOrFail()->update([
                'password' => $request->password
            ]);
            $token_row->delete();
            return jsonResponse('success', __('passwords.reset'));
        } else {
            return jsonResponse('error', __('passwords.token'));
        }
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
