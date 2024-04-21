<?php

namespace Maestro\Users\Tests\Feature\Pages\UserForm;

use Livewire\Livewire;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Views\Pages\UserForm;

class UserEditingTest extends TestCase
{
    /**
     * Deve renderizar o formulário de edição corretamente.
     *
     * @return void
     */
    public function testRenderComponent()
    {
        $user = Users::factory()->model();

        Livewire::test(UserForm::class, ['id' => $user->id])
            ->assertSee(__('users::forms.first-name'))
            ->assertSee(__('users::forms.last-name'))
            ->assertSee(__('users::forms.email'))
            ->assertViewHas('firstName', $user->firstName)
            ->assertViewHas('lastName', $user->lastName)
            ->assertViewHas('email', $user->email)
            ->assertViewHas('account', $user->account()->name)
            ->assertDontSee(__('users::forms.password.label'))
            ->assertDontSee(__('users::forms.confirm-password'));
    }

    /**
     * Deve redirecionar para tela de login ao acessar a rota de edição
     * de usuário sem efetuar login. 
     *
     * @return void
     */
    public function testAccessRouteWithouLogin()
    {
        $user = Users::factory()->model();

        $route = route("maestro.users.edit", ['id' => $user->id]);

        $this->assertRedirectWithoutLogin($route);
    }

    /**
     * Deve exibir a tela de formulário de edição de usuário ao acessar
     * a rota com o ID de um usuário válido 
     *
     * @return void
     */
    public function testAccessRouteWithLogin()
    {
        $user = Users::factory()->login();
        
        $form = route("maestro.users.edit", ['id' => $user->id]);

        $this->get($form)->assertSeeLivewire(UserForm::class);
    }

    /**
     * Deve redirecionar para uma tela de "não encontrado" ao tentar acessar
     * a tela de
     *
     * @todo Deve redirecionar para uma pagina de não encontrado correta
     * @return void
     */
    public function testUserNotFound()
    {
        $this->initSession();

        $route = route('maestro.users.edit', ['id' => 123]);

        $notfound = route('maestro.admin.not-found');

        $this->get($route)->assertRedirect($notfound);
    }

    /**
     * Deve redirecionar para a tela de não encontrada ao tentar 
     * passar string como parâmetro na rota de edição do usuário.
     *
     * @todo Em breve deve permitir string, para consulta de nome da conta. 
     * @return void
     */
    public function testAccessRouteWithStringParams()
    {
        $this->initSession();

        $notfound = route('maestro.admin.not-found');

        $string  = route('maestro.users.edit', ['id' => 'maestro']);
        $special = route('maestro.users.edit', ['id' => '@$pec1a$al']);

        $this->get($string)->assertRedirect($notfound);
        $this->get($special)->assertRedirect($notfound);
    }

    /**
     * Deve conseguir editar um usuário pelo formulário com sucesso. 
     *
     * @return void
     */
    public function testEditUser()
    {
        $original = $this->initSession();

        $request = Users::factory()->fromRequest();

        Livewire::test(UserForm::class, ['id' => $original->id])
            ->set('firstName', $request->firstName)
            ->set('lastName', $request->lastName)
            ->set('email', $request->email)
            ->set('account', $request->accountName)
            ->call('save')
            ->assertHasNoErrors();
    }

    /**
     * Deve salvar com sucesso caso o usuário execute a função salvar,
     * sem alterar qualquer campo do formulário atual. 
     *
     * @return void
     */
    public function testFormWithoutChanges()
    {
        $original = $this->initSession();

        Livewire::test(UserForm::class, ['id' => $original->id])
            ->call('save')
            ->assertHasNoErrors();
    }

    /**
     * Deve exibir as mensagens de erro de validação ao tentar salvar os 
     * dados em branco no formulário de edição do usuário
     */
    public function testEditWithEmptyForm()
    {
        $original = $this->initSession();

        Livewire::test(UserForm::class, ['id' => $original->id])
            ->set('firstName', '')
            ->set('lastName', '')
            ->set('email', '')
            ->set('account', '')
            ->call('save')
            ->assertHasErrors(['accountName' => 'required'])
            ->assertHasErrors(['firstName'   => 'required'])
            ->assertHasErrors(['lastName'    => 'required'])
            ->assertHasErrors(['email'       => 'required'])
            ->assertSee(__("users::validations.email.required"))
            ->assertSee(__("users::validations.lastName.required"))
            ->assertSee(__("users::validations.firstName.required"));
    }

    public function testEditDuplicateAccount()
    {
        $first = $this->initSession();

        $second = Users::factory()->model();

        $v = Livewire::test(UserForm::class, ['id' => $first->id])
            ->set('account', $second->account()->name)
            ->call('save')
            ->assertHasErrors(['accountName' => 'accounts.unique']);
    }
}