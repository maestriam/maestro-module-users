<?php

namespace Maestro\Users\Tests\Feature\Pages\UserIndex;

use Livewire\Livewire;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Views\Pages\UserIndex;

class UserIndexTest extends TestCase
{
    public function testDisplayLabels()
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

    public function testRouteWithoutLogin()
    {
        $this->get('/users')->assertRedirect('/login');
    }

    public function testRouteWithLogin() 
    {
        $this->initSession();
        
        $this->get('/users')
            ->assertSeeLivewire(UserIndex::class)
            ->assertStatus(200);
    }

    public function testGoToCreateUser()
    {
        Livewire::test(UserIndex::class)
            ->call('goToCreate')
            ->assertRedirect('/users/create');
    }
    
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

    public function testSearchByName()
    {
        $collection = $this->populate(20);

        $first = $collection[0];

        Livewire::test(UserIndex::class)
            ->set('search', $first->firstName)
            ->assertViewHas('users', fn($users) => count($users) > 0);

        Livewire::test(UserIndex::class)
            ->set('search', "{$first->firstName} {$first->lastName}")
            ->assertViewHas('users', fn($users) => count($users) == 1);

        Livewire::test(UserIndex::class)
            ->set('search', "not-exitst")
            ->assertViewHas('users', fn($users) => count($users) == 0)
            ->assertSeeHtml("empty-state");
    }

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
}