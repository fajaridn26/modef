<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Profile')]
#[Layout('components.layouts.app')]
class Profile extends Component
{
    public $id, $nama, $kelas, $jurusan, $angkatan, $email, $no_whatsapp, $foto_profile;
    public $kode_negara = 62;

    use WithFileUploads;

    public function render()
    {
        return view('livewire.profile');
    }

    public function mount(){
       $user = Auth::user();

       $this->nama = $user->nama;
       $this->kelas = $user->kelas;
       $this->jurusan = $user->jurusan;
       $this->angkatan = $user->angkatan;
       $this->email = $user->email;
       $this->no_whatsapp = preg_replace('/^62/', '', $user->no_whatsapp);
       $this->foto_profile = $user->foto_profile;
    }

    public function update(){
    $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'kelas' => 'nullable|string|max:50',
            'jurusan' => 'nullable|string|max:100',
            'angkatan' => 'nullable|integer',
            'no_whatsapp' => 'nullable|string|max:20',
        ]);

        $user = User::find(Auth::id());

        $user->update([
            'nama' => $this->nama,
            'kelas' => $this->kelas,
            'jurusan' => $this->jurusan,
            'angkatan' => $this->angkatan,
            'email' => $this->email,
            'no_whatsapp' => '62' . $this->no_whatsapp
        ]);

        redirect('profile')->with('success', 'Profile berhasil diperbarui!');
    
    }

    public function upload(){
        $this->validate([
            'foto_profile' => 'image|max:1024'
        ]);

        $user = User::find(Auth::id());

        $user->update([
            'foto_profile' => $this->foto_profile->store('files', 'public')
        ]);

        redirect('profile')->with('fotoSuccess', 'Foto Profile berhasil diperbarui!');
    }

    public function updatedFotoProfile()
    {
        $this->upload();
    }
    
}