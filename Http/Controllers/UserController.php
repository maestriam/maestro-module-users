<?php

namespace Maestro\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use Maestro\Users\Support\Users;
use Illuminate\Contracts\Support\Renderable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return Renderable
     */
    public function logout()
    {
        Users::auth()->logout();

        return redirect()->route('maestro.users.login');
    }
}
