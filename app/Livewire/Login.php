<?php

namespace App\Livewire;

use App\Services\Auth\AuthService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{

    public $username;
    public $password;
    public $auth;
    public $data;

    protected AuthService $authService;

    public function boot(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        if (!$this->username) {
            $this->dispatch('toast', ['type' => 'error', 'message' => 'User Name kosong']);
            return false;
        }

        if (!$this->password) {
            $this->dispatch('toast', ['type' => 'error', 'message' => 'Password kosong']);
            return false;
        }

        if ($this->authService->login($this->username, $this->password)) {
            return redirect('dashboard');
        } else {
            $this->dispatch('toast', ['type' => 'error', 'message' => 'User tidak ditemukan']);
            return false;
        }
    }

    #[Layout('components.layouts.login')]
    public function render()
    {
        return view('livewire.login');
    }
}
