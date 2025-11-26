<?php

namespace App\Livewire;

use App\Http\Resources\ProjectResource;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Project as ModelsProject;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Project')]
#[Layout('components.layouts.app')]

class Project extends Component
{
    public $perPage = 10;
    public $project_id;
    public $nama_project = '';
    public $deskripsi_project = '';
    public $file_project;
    public $nilai = 0;
    public $orderAsc=true;
    public $selectedProject;
    public $createSuccess = null;
    
    use WithPagination;
    use WithFileUploads;

    protected $rules = [
        'nama_project' => 'required|string',
        'deskripsi_project' => 'required|string',
        'file_project' => 'required|image|max:3024',
    ];
    public function render()
    {
        return view('livewire.project', [
            'project' => ModelsProject::where('id_user', auth()->id())->orderBy('id', $this->orderAsc ? 'asc' : 'desc')->paginate($this->perPage)
        ]);
    }

    public function create(){
        $this->validate();

        ModelsProject::create([
            'id_user' => auth()->id(),
            'nama_project' => $this->nama_project,
            'deskripsi_project' => $this->deskripsi_project,
            'file_project' => $this->file_project->store('files', 'public'),
            'nilai' => 0,
        ]);

        $this->reset(['nama_project', 'deskripsi_project', 'file_project']);

        redirect('/project')->with('createSuccess', 'Project berhasil dibuat!');

        // $this->createSuccess = 'Project berhasil dibuat!';
        // $this->dispatch('closeModalTambahProject');
    }

    public function edit($id){
        $project = ModelsProject::findOrFail($id);

        $this->project_id = $project->id;
        $this->nama_project = $project->nama_project;
        $this->deskripsi_project = $project->deskripsi_project;
        $this->file_project = $project->file_project;
    }

    public function update(){
        $this->validate();

        $project = ModelsProject::findOrFail($this->project_id);
        $project->nama_project = $this->nama_project;
        $project->deskripsi_project = $this->deskripsi_project;
        $project->file_project = $this->file_project->store('files', 'public');

        $project->save();
        session()->flash('updateSuccess', 'Project berhasil diperbaharui!');
    }

    public function lihatFile($id){
        $this->selectedProject = ModelsProject::find($id);
    }

}
