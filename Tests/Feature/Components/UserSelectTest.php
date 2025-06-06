<?php

namespace Maestro\Users\Tests\Feature\Components;

use Livewire\Livewire;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Views\Components\UserSelect;

class UserSelectTest extends TestCase
{
    public function testRender()
    {
        Livewire::test(UserSelect::class)
                ->assertStatus(200);
    }
}