<?php

namespace Maestro\Users\Http\Controllers;

use Maestro\Users\Support\Users;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    /**
     * Redireciona o usuário para a aplicação principal. 
     * Caso o usuário não esteja logado, deve-se redirecionar
     * para a tela de login.  
     * Se estiver logado, deve-se redirecionar para a tela 
     * home. 
     *
     * @return void
     */
    public function init()
    {
        $route = Users::auth()->isLogged() == true ? 
                    route('maestro.admin.home') : 
                    route('maestro.users.login');

        return redirect($route);
    }
}