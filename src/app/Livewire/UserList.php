<?php

namespace App\app\Livewire;

use App\Models\User;
use Livewire\Component;
use function App\Livewire\view;

class UserList extends Component
{
    public function render()
    {
        $users = User::all();

        return view('livewire.user-list', ['users' => $users]);
    }
}
