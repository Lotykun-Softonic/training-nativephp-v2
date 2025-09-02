<?php

namespace App\app\Livewire;

use App\Models\User;
use Livewire\Component;
use function App\Livewire\redirect;
use function App\Livewire\session;
use function App\Livewire\view;

class UserForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public User $user;
    public bool $isNew = false;

    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->password = '';

        $this->isNew = !$user->name;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user->id
        ];

        if ($this->isNew) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        $this->validate($rules);

        $attributes = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->isNew) {
            $attributes['password'] = $this->password;
        }

        User::updateOrCreate(['id' => $this->user->id], $attributes);

        $flashMessage = $this->isNew ? 'User Created Successfully.' : 'User Updated Successfully.';
        session()->flash('message', $flashMessage);

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
