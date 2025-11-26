<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public $totalSiswa, $totalProject, $belumDinilai, $sudahDinilai, $user_id, $nama_project, $selectedProject, $project_id, $nama, $deskripsi_project, $nilai;
    public $penilaianSuccess = null;
    public $orderDesc = true;
    public $perPage = 5;

    public function render()
    {
        return view('livewire.dashboard', [
            'listProject' => Project::with('user')->where('nilai', 0)
                ->orderBy('id', $this->orderDesc ? 'desc' : 'asc')->paginate($this->perPage)
            ]);
    }

    public function mount(){

        $this->totalSiswa = User::where('role', 'Siswa')->count();
        $this->totalProject = Project::all()->count();
        $this->belumDinilai = Project::where('nilai' , 0)->count();
        $this->sudahDinilai = Project::where('nilai', '>' , 0)->count();
        // $this->listProject = Project::with('user')->where('nilai', 0)->get();
    }

    public function edit($id){
        $project = Project::with('user')->findOrFail($id);

        $this->project_id = $project->id;
        $this->nama = $project->user->nama;
        $this->project_id = $project->id;
        $this->nama_project = $project->nama_project;
        $this->deskripsi_project = $project->deskripsi_project;
        $this->nilai = $project->nilai;
    }

     public function update(){
        // $this->validate();

        $project = Project::findOrFail($this->project_id);
        $project->nilai = $this->nilai;

        $project->save();
        // session()->flash('penilaianSuccess', 'Project berhasil dinilai!');
        $this->penilaianSuccess = 'Project berhasil dinilai!';
        $this->dispatch('closeModalEdit');
    }

    public function lihatFile($id){
        $user = Project::with('user')->findOrFail($id);

        $this->user_id = $user->id_user;
        $this->nama_project = $user->nama_project;
        $this->selectedProject = Project::find($id);
    }
}
