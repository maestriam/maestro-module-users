<?php

namespace Maestro\Users\Views\Components;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Maestro\Users\Support\Concerns\SearchesUsers;

class UserSelect extends Component
{
    use SearchesUsers;

    private Collection $users;

    public function mount()
    {
        $this->setUsers();
    }

    public function setUsers() : void
    {
        $this->users = $this->finder()->all();

        foreach($this->users as $user) {

        }
    }

    public function render()
    {
        return view('users::components.user-select');
    }
}