<?php

namespace App\Livewire;

use App\Exports\ProjectsExport;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Penilaian Project')]
#[Layout('components.layouts.app')]

class PenilaianProject extends Component
{
    public $perPage = 10;
    public $search = '';
    public $user_id;
    public $project_id;
    public $nama = '';
    public $nama_project = '';
    public $deskripsi_project = '';
    public $nilai = '';
    public $file_project;
    public $totalProject;
    public $belumDinilai;
    public $sudahDinilai;
    public $filter = 'semua';
    public $orderDesc = true;
    public $selectedProject;
    public $penilaianSuccess = null;

    use WithPagination;

    public function render()
    {

        $totalProject = Project::all()->count();
        $belumDinilai = Project::where('nilai', 0)->count();
        $sudahDinilai = Project::where('nilai', '>', 0)->count();

        $this->totalProject = $totalProject;
        $this->belumDinilai = $belumDinilai;
        $this->sudahDinilai = $sudahDinilai;

        $query = Project::with('user')
            ->where(function ($q) {
                $q->whereRAW('LOWER(nama_project) LIKE ?', ['%' . strtolower($this->search) . '%'])
                    ->orWhereHas('user', function ($q) {
                        $q->whereRAW('LOWER(nama) LIKE ?', ['%' . strtolower($this->search) . '%']);
                    });
            });

        if ($this->filter === 'belumDinilai') {
            $query->where('nilai', 0);
        } elseif ($this->filter === 'sudahDinilai') {
            $query->where('nilai', '>', 0);
        }

        return view('livewire.penilaian-project', [
            'totalProject' => $totalProject,
            'belumDinilai' => $belumDinilai,
            'sudahDinilai' => $sudahDinilai,
            'listProject' => $query->orderBy('id', $this->orderDesc ? 'desc' : 'asc')->paginate($this->perPage)
        ]);
    }

    public function setFilter($value)
    {
        $this->filter = $value;
    }

    public function edit($id)
    {
        $project = Project::with('user')->findOrFail($id);

        $this->project_id = $project->id;
        $this->nama = $project->user->nama;
        $this->project_id = $project->id;
        $this->nama_project = $project->nama_project;
        $this->deskripsi_project = $project->deskripsi_project;
        $this->nilai = $project->nilai;
    }

    public function update()
    {
        // $this->validate();

        $project = Project::findOrFail($this->project_id);
        $project->nilai = $this->nilai;

        $project->save();
        // session()->flash('penilaianSuccess', 'Project berhasil dinilai!');
        $this->penilaianSuccess = 'Project berhasil dinilai!';
        $this->dispatch('closeModalEdit');
    }

    public function lihatFile($id)
    {
        $user = Project::with('user')->findOrFail($id);

        $this->user_id = $user->id_user;
        $this->nama_project = $user->nama_project;
        $this->selectedProject = Project::find($id);
    }

    public function export()
    {
        return Excel::download(new ProjectsExport, 'Penialain Project.xlsx');
    }
}
