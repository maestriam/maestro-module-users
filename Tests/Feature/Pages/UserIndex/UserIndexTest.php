<?php

namespace Maestro\Users\Tests\Feature\Pages\UserIndex;

use Livewire\Livewire;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Views\Pages\UserIndex;

class UserIndexTest extends TestCase
{
    /**
     * Deve renderizar o componente corretamente com todos os seus 
     * labels
     *
     * @return void
     */
    public function testRenderComponent()
    {
        Livewire::test(UserIndex::class)
            ->assertSee(__('users::module.title'))
            ->assertSee(__('users::module.description'))
            ->assertSee(__('users::cards.list-user'))            
            ->assertSee(__('users::placeholders.search'))
            ->assertSee(__('users::buttons.add'))
            ->assertSee(__('users::tables.name'))
            ->assertSee(__('users::tables.email'))
            ->assertSee(__('users::tables.created-at'))
            ->assertSee(__('users::tables.accountname'));
    }

    /**
     * Deve redirecionar para a tela ao tentar acessar 
     * a rota de listagem de usuários sem estar logado no sistema. 
     *
     * @return void
     */
    public function testRouteWithoutLogin()
    {
        $route = route('maestro.users.index');
        $login = route('maestro.users.login');

        $this->get($route)->assertRedirect($login);
    }

    /**
     * Deve conseguir acessar a rota de listagem de usuário 
     * ao tentar acessar com um usuário logado no sistema. 
     * 
     * @return void
     */
    public function testRouteWithLogin() 
    {
        $this->initSession();

        $route = route('maestro.users.index');
        
        $this->get($route)
            ->assertSeeLivewire(UserIndex::class)
            ->assertStatus(200);
    }

    /**
     * Deve ser redirecionado para o formulário de criação de usuário
     * ao clicar no botão "adicionar usuário".
     *
     * @return void
     */
    public function testGoToCreateUser()
    {
        $route = route('maestro.users.create');

        Livewire::test(UserIndex::class)
            ->call('goToCreate')
            ->assertRedirect($route);
    }
 
    /**
     * Deve conseguir visualizar os itens nas tabelas de 
     * listagem de usuários. 
     *
     * @return void
     */
    public function testSeeItens()
    {
        $collection = $this->populate();

        foreach($collection as $user) {
            Livewire::test(UserIndex::class)
                ->assertSee($user->firstName)
                ->assertSee($user->lastName)
                ->assertSee($user->email)
                ->assertSee("@{$user->account()->name}")
                ->assertSee(ddmmYYYY($user->createdAt));
        }
    }
}