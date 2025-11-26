<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Title('Change Password')]
#[Layout('components.layouts.app')]

class ProfilePassword extends Component
{
    public $passwordLama, $passwordBaru, $konfirmasiPasswordBaru;
    public function render()
    {
        return view('livewire.profile-password');
    }

    public function update(){
        $this->validate([
            'passwordLama' => 'required|min:5',
            'passwordBaru' => 'required|min:5',
            'konfirmasiPasswordBaru' => 'required|same:passwordBaru|min:5',
        ]);

        $users = User::findOrFail(Auth::id());

        if (!Hash::check($this->passwordLama, $users->password)){
            redirect('profile/password')->with('passwordLamaError', 'Password lama salah!');
            return;
        } 
      
        $users->update([
            'password' => Hash::make($this->passwordBaru),
        ]);

        redirect('profile/password')->with('changePasswordSuccess', 'Password berhasil diperbarui!');

    }
}
