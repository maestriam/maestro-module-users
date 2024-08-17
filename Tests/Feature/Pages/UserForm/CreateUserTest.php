<?php

namespace Maestro\Users\Tests\Feature\Pages\UserForm;

use Livewire\Livewire;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Views\Pages\UserForm;
use Maestro\Users\Support\Users;
use Livewire\Features\SupportTesting\Testable;
use Maestro\Users\Http\Requests\StoreUserRequest;
use Maestro\Accounts\Views\Components\AccountForm;

class CreateUserTest extends TestCase
{
    /**
     * Deve exibir o formulário de criação ao tentar acessar a rota
     * via get, com uma sessão iniciada com um usuário válido.
     *
     * @return void
     */
    public function testRoute()
    {
        $this->initSession();

        $route = route('maestro.users.create');

        $this->get($route)->assertSeeLivewire(AccountForm::class);
    }
    
    /**
     * Deve criar um usuário um usuário no sistema ao fornecer 
     * dados válidos ao formulário de criação. 
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = Users::factory()->fromRequest();
        $this->save($user);
       
        $collection = Users::finder()->all();        
        $first = $collection->first();     

        $this->assertCount(1, $collection);
        $this->assertEquals($first->firstName, $user->firstName);
        $this->assertEquals($first->lastName, $user->lastName);
        $this->assertEquals($first->email, $user->email);
        $this->assertEquals($first->account()->name, $user->accountName);
    }

    /**
     * Deve retornar uma mensagem de erro ao passar senhas diferentes
     * no campo de "senha" e "confirmação de senha"
     *
     * @return void
     */
    public function testPasswordConfirmation()
    {
        $user = Users::factory()->fromRequest();
        
        $user->password = "d1f3r3n+";
        $user->password_confirmation = "an0th3r-dif3rent";

        $this->save($user)
             ->assertHasErrors(['password' => 'confirmed'])
             ->assertSee(__('users::validations.password.confirmed'));
    }

    /**
     * Deve renderizar o componente corretamente, juntamente com 
     * todos os labels. 
     *
     * @return void
     */
    public function testRenderComponent()
    {
        Livewire::test(UserForm::class)
            ->assertStatus(200)
            ->assertSeeLivewire(AccountForm::class)
            ->assertSee(__('users::forms.first-name'))
            ->assertSee(__('users::forms.last-name'))
            ->assertSee(__('users::forms.email'))
            ->assertSee(__('users::forms.password.label'))
            ->assertSee(__('users::forms.confirm-password'));
    }

    /**
     * Deve retornar e exibir as mensagens de erros de validação ao
     * executar a ação de salvar com o formulário totalmente vazio. 
     *
     * @return void
     */
    public function testEmptyForm()
    {
        Livewire::test(UserForm::class)
            ->call("save")
            ->assertHasErrors(['accountName' => 'required'])
            ->assertHasErrors(['firstName'   => 'required'])
            ->assertHasErrors(['lastName'    => 'required'])
            ->assertHasErrors(['email'       => 'required'])
            ->assertHasErrors(['password'    => 'required'])
            ->assertSee(__("users::validations.email.required"))
            ->assertSee(__("users::validations.password.required"))
            ->assertSee(__("users::validations.lastName.required"))
            ->assertSee(__("users::validations.firstName.required"));
    }

    /**
     * Deve redirecionar para a tela de indice de usuários ao clicar
     * no botão "voltar". 
     *
     * @return void
     */
    public function testBackButton()
    {
        Livewire::test(UserForm::class)
            ->call("back")
            ->assertRedirectToRoute("maestro.users.index");
    }

    /**
     * Retorna o teste de execução de salvar formulário
     *
     * @param StoreUserRequest $request
     * @return Testable
     */
    private function save(StoreUserRequest $request) : Testable
    {        
        return Livewire::test(UserForm::class)
                ->set('email', $request->email)
                ->set('lastName', $request->lastName)
                ->set('password', $request->password)
                ->set('account', $request->accountName)
                ->set('firstName', $request->firstName)
                ->set('confirmPassword', $request->password_confirmation)
                ->call('save');
    }
}