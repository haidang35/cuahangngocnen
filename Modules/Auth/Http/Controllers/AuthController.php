<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    /**
     * __construct
     *
     * @param  mixed $authService
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function login()
    {
        return view('auth::login');
    }

    /**
     * postLogin
     *
     * @param  mixed $request
     * @return mixed
     */
    public function postLogin(LoginRequest $request)
    {
        $result = $this->authService->login($request);
        if ($result) {
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
