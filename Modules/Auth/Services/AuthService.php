<?php 

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Auth;

class AuthService {    
    /**
     * login
     *
     * @param  mixed $request
     * @return mixed
     */
    public function login($request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return true;
        }
        return false;
    }
}