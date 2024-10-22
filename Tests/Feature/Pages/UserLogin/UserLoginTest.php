<?php

namespace Maestro\Users\Tests\Feature\Pages\UserLogin;

use Livewire\Livewire;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Views\Pages\UserLoginForm;

class UserLoginTest extends TestCase
{
    public function testRender()
    {
        Livewire::test(UserLoginForm::class)
                ->assertStatus(200);
    }

    public function testValidation()
    {
        Livewire::test(UserLoginForm::class)
                ->set('email', null)
                ->set('password', null)
                ->call('submit')
                ->assertHasErrors()
                ->assertSee(__('users::validations.email.required'))
                ->assertSee(__('users::validations.password.required'));
    }
}