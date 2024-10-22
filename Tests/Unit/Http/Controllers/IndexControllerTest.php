<?php

namespace Maestro\Users\Tests\Unit\Http\Controllers;

use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;

class IndexControllerTest extends TestCase
{
    public function testRedirectToLogin()
    {
        $route = route('maestro.users.login');

        $this->get('/')->assertRedirect($route);
    }
    
    public function testRedirectToHome()
    {
        $this->initSession();

        $route = route('maestro.admin.home');

        $this->get('/')->assertRedirect($route);
    }
}