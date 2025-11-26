<?php

namespace App\Livewire;

use App\Http\Resources\UserResource;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Title('User')] 
#[Layout('components.layouts.app')]

class Userlist extends Component
{
    public $perPage = 10;
    public $search = '';

    public $user_id;
    public $nama, $kelas, $email, $no_whatsapp, $password, $role = '';
    public $batchId;
    public $importFile;
    public $importing = false;
    public $importFilePath;
    public $importFinished = false;
    public $orderDesc=true;

    use WithPagination;
    use WithFileUploads;

     protected $rules = [
        'nama' => 'required|string',
        'email' => 'required|email|unique',
        'role' => 'required|string',
        'password' => 'required|min:5'
    ];

    public function render()
    {
        return view('livewire.userlist',[
            'users' => User::whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($this->search) . '%'])
            ->orderBy('id',$this->orderDesc ? 'desc' : 'asc')
            ->whereIn('role', ['Siswa'])
            ->paginate($this->perPage)
        ]);
    }

    public function create(){
       try {
        User::create([
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => 12345,
        ]);
        redirect('/siswa')->with('createSuccess', 'User berhasil dibuat!');
       } catch (\Exception) {
        redirect('/siswa')->with('createFailed', 'User gagal dibuat!');
       }
    }

    public function edit($id){
        $user = User::findOrFail($id);

        $this->user_id = $user->id;
        $this->nama = $user->nama;
        $this->kelas = $user->kelas;
        $this->email = $user->email;
        $this->no_whatsapp = $user->no_whatsapp;
        $this->role = $user->role;
        $this->password = '';
    }

    public function update(){
        $this->validate([
        'nama' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $this->user_id,
        'role' => 'required|string',
        ]);

        $user = User::findOrFail($this->user_id);
        $user->nama = $this->nama;
        $user->email = $this->email;
        $user->role = $this->role;

        $user->save();
        redirect('/siswa')->with('updateSuccess', 'User berhasil diperbaharui!');

    }

    public function import()
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new UsersImport, $this->importFile->getRealPath());

        redirect('/siswa')->with('importSuccess', 'Import User berhasil!');

    }

}
