<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @if (auth()->user()->role == 'Siswa')
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Selamat Datang {{ auth()->user()->nama }}</h5>
                                    <p class="mb-4">
                                        Yuk segera tambahkan project <span class="fw-bold">Project</span> kamu.
                                    </p>

                                    <a href="#" class="btn btn-sm btn-outline-primary">Tambahkan Project</a>
                                </div>
                            </div>
                            {{-- <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endif
            {{-- <div class="col-lg-4 col-md-4 order-1"> --}}
            @if (auth()->user()->role == 'Super Admin' || auth()->user()->role == 'Guru')
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/Siswa.svg" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Siswa</span>
                            <h3 class="card-title mb-2">{{ $totalSiswa }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/Project.svg" alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Project</span>
                            <h3 class="card-title mb-2">{{ $totalProject }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/Belum Dinilai.svg" alt="Credit Card"
                                        class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Belum Dinilai</span>
                            <h3 class="card-title mb-2">{{ $belumDinilai }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/Sudah Dinilai.svg" alt="Credit Card"
                                        class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Sudah Dinilai</span>
                            <h3 class="card-title mb-2">{{ $sudahDinilai }}</h3>
                        </div>
                    </div>
                </div>
            @endif

            {{-- @if (auth()->user()->role == 'Super Admin' || auth()->user()->role == 'Guru')
                <div class="col">
                    <div class="card">
                        <h5 class="card-header">Belum Dinilai</h5>
                        @if ($penilaianSuccess)
                            <div class="alert alert-success alert-dismissible ms-4 me-4" role="alert">
                                {{ $penilaianSuccess }}
                            </div>
                        @endif
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Nama Project</th>
                                        <th>File Project</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($listProject as $project)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $project->user->nama }}</td>
                                            <td>{{ $project->user->kelas }} - {{ $project->user->jurusan }}</td>
                                            <td>{{ $project->nama_project }}</td>
                                            <td><a href="#"
                                                    wire:click="lihatFile({{ $project->id }}) "data-bs-toggle="modal"
                                                    data-bs-target="#modalLihatFile">Lihat
                                                </a></td>
                                            @if ($project->nilai > 69)
                                                <td>
                                                    <span
                                                        class="badge bg-label-success fs-6">{{ $project->nilai }}</span>
                                                </td>
                                            @elseif ($project->nilai > 0)
                                                <td>
                                                    <span
                                                        class="badge bg-label-danger fs-6">{{ $project->nilai }}</span>
                                                </td>
                                            @elseif ($project->nilai == 0)
                                                <td>
                                                    <span
                                                        class="badge bg-label-warning fs-6">{{ $project->nilai }}</span>
                                                </td>
                                            @endif
                                            <td>
                                                <div>
                                                    <Button type="button" class="btn btn-secondary"
                                                        data-bs-toggle="modal" data-bs-target="#modalEdit"
                                                        wire:click="edit({{ $project->id }})">Nilai</Button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div>
                                                    <img class="item-center"
                                                        src="{{ asset('assets/img/no_data.svg') }}" alt=""
                                                        width="300">
                                                    <div class="fw-semibold fs-big">
                                                        Tidak ada data.
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="row mt-3">
                                <div class="col-lg-1 col-md-2 col-3 ms-3 mb-3">
                                    <select class="form-select" wire:model.live="perPage">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                    </select>
                                </div>
                                <div class="col-md-10 ms-4">
                                    {{ $listProject->links('vendor.livewire.bootstrap') }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif --}}

            {{-- <div class="modal fade" id="modalLihatFile" tabindex="-1" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel4">{{ $nama_project }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                @if ($selectedProject && $selectedProject->file_project)
                                    <img src="{{ asset('storage/' . $selectedProject->file_project) }}"
                                        alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form wire:submit='update'>
                <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Beri Nilai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Nama Siswa</label>
                                        <input type="text" id="nama" wire:model="nama"class="form-control"
                                            disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Nama Project</label>
                                        <input type="text" id="nama_project"
                                            wire:model="nama_project"class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Deskripsi Project</label>
                                        <input type="text" id="deskripsi_project" wire:model="deskripsi_project"
                                            class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Nilai</label>
                                        <input type="text" id="nilai" maxlength="2" wire:model="nilai"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
</div>

{{-- <script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('closeModalEdit', () => {
            const modalEl = document.getElementById('modalEdit');

            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
            }
        });
    });

    document.getElementById('nilai').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    })
</script> --}}
