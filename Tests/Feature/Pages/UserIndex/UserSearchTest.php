<?php

use Livewire\Livewire;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Views\Pages\UserIndex;

class UserSearchTest extends TestCase
{
    /**
     * Deve conseguir gerar a paginação corretamente
     *
     * @return void
     */
    public function testPagination()
    {
        $pages = 2;
        $count = 10;
        $total = 15;
        
        $this->populate($total);

        Livewire::test(UserIndex::class)
            ->assertViewHas('users', fn($users) => $users->count() == $count)
            ->assertViewHas('users', fn($users) => $users->total() == $total)
            ->assertViewHas('users', fn($users) => $users->lastPage() == $pages);                        
    }

    /**
     * Deve realizar uma consulta pelo primeiro nome, último nome
     * e pelo primeiro e último nome do usuário juntos.
     *
     * @return void
     */
    public function testSearchByName()
    {
        $collection = $this->populate(20);

        $first = $collection[0];

        Livewire::test(UserIndex::class)
            ->set('search', $first->firstName)
            ->assertViewHas('users', fn($users) => count($users) > 0);

        Livewire::test(UserIndex::class)
            ->set('search', $first->lastName)
            ->assertViewHas('users', fn($users) => count($users) > 0);

        Livewire::test(UserIndex::class)
            ->set('search', "{$first->firstName} {$first->lastName}")
            ->assertViewHas('users', fn($users) => count($users) == 1);

        Livewire::test(UserIndex::class)
            ->set('search', "not-exitst")
            ->assertViewHas('users', fn($users) => count($users) == 0)
            ->assertSeeHtml("empty-state");
    }

    /**
     * Deve conseguir realizar uma pesquisa por e-mail
     *
     * @return void
     */
    public function testSearchByEmail()
    {
        $collection = $this->populate(10);

        $first = $collection[0];

        Livewire::test(UserIndex::class)
            ->set('search', $first->email)
            ->assertViewHas('users', fn($users) => count($users) > 0);

        Livewire::test(UserIndex::class)
            ->set('search', "no-one@any-where")
            ->assertViewHas('users', fn($users) => count($users) == 0)
            ->assertSeeHtml("empty-state");
    }

    /*public function testSearchByAccountName()
    {
        $request = Users::factory()->fromRequest();
        $request->accountName = "__my-account" ;

        $user = Users::user()->create($request);

        Livewire::test(UserIndex::class)
            ->set('search', $user->account()->name)
            ->assertViewHas('users', fn($users) => count($users) > 0);
    }*/

    /**
     * Deve conseguir realizar uma visita para uma determinada 
     * paginação na listagem de usuários. 
     *
     * @return void
     */
    public function testVisitPage()
    {
        $page = 2;

        $this->populate(30);

        Livewire::withQueryParams(['page' => $page])
            ->test(UserIndex::class)            
            ->assertViewHas('users', fn($users) => $users->currentPage() == $page);
    }

    /**
     * Deve conseguir realizar uma pesquisa com paginação pela URL. 
     *
     * @return void
     */
    public function testSearchWithPaginationAndQuery()
    {
        $collection = $this->populate(30);

        $first = $collection[0];
        $query = ['page' => 2, 'q' => $first->email]; 

        Livewire::withQueryParams($query)
            ->test(UserIndex::class)            
            ->assertViewHas('users', fn($users) => $users->count() == 1)
            ->assertViewHas('users', fn($users) => $users->currentPage() == 1)
            ->assertViewHas('users', fn($users) => $users->first()->id == $first->id);
    }
}