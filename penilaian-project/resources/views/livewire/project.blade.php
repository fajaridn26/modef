<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Project</h4>

        <!-- Responsive Table -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahProject">
            Tambah Project
        </button>

        <form wire:submit="create" enctype="multipart/form-data">
            <div class="modal fade" id="modalTambahProject" tabindex="-1" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Tambah Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nama_project" class="form-label">Nama Project</label>
                                    <input type="text" id="nama_project" wire:model="nama_project"
                                        class="form-control" placeholder="Enter Project Name" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="deskripsi_project" class="form-label">Deskripsi Project</label>
                                    <textarea type="text" id="deskripsi_project" wire:model="deskripsi_project" class="form-control"
                                        placeholder="Enter Deskripsi" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="file_project" class="form-label">File Project</label>
                                    <input type="file" id="file_project" wire:model="file_project"
                                        class="form-control" required />
                                    <p class="text-muted mt-2">Allowed JPG or PNG. Max size of 1MB</p>

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
        </form>

        <div class="card mt-3">
            <h5 class="card-header">Project</h5>
            @if (session()->has('createSuccess'))
                <div class="alert alert-success alert-dismissible ms-4 me-4" role="alert">
                    {{ session('createSuccess') }}
                </div>
            @elseif (session()->has('updateSuccess'))
                <div class="alert alert-success alert-dismissible ms-4 me-4" role="alert">
                    {{ session('updateSuccess') }}
                </div>
            @endif
            {{-- <div class="mt-1 mb-3 ms-4">
                <div class="col-md-3">
                    <input class="form-control" type="text" placeholder="Search ..."
                        wire:model.live.debounce.300ms='search' />
                </div>
            </div> --}}
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>No</th>
                            <th>Nama Project</th>
                            <th>Deskripsi Project</th>
                            <th>File Project</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($project as $item)
                            <tr>
                                <td scope="row">{{ $project->firstItem() + $loop->index }}</td>
                                <td>{{ $item->nama_project }}</td>
                                <td>{{ $item->deskripsi_project }}</td>
                                <td><a href="#" wire:click="lihatFile({{ $item->id }}) "data-bs-toggle="modal"
                                        data-bs-target="#modalLihatFile">Lihat
                                    </a></td>
                                @if ($item->nilai > 70)
                                    <td>
                                        <span class="badge bg-label-success fs-6">{{ $item->nilai }}</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge bg-label-danger fs-6">{{ $item->nilai }}</span>
                                    </td>
                                @endif
                                <td>
                                    <div>
                                        <Button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit"
                                            wire:click="edit({{ $item->id }})">Edit</Button>
                                    </div>
                                </td>
                            @empty
                                <td colspan="6" class="text-center">
                                    <div>
                                        <img class="item-center" src="{{ asset('assets/img/no_data.svg') }}"
                                            alt="" width="300">
                                        <div class="fw-semibold fs-big">
                                            Tidak ada data.
                                        </div>
                                    </div>
                                </td>
                        @endforelse
                    </tbody>
                </table>
                <div class="row mt-3">
                    <div class="col-lg-1 col-md-2 col-3 ms-3 mb-3">
                        <select class="form-select" wire:model.live="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-md-10 ms-4">
                        {{-- {{ $project->links('vendor.livewire.bootstrap') }} --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLihatFile" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">File Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if ($selectedProject && $selectedProject->file_project)
                                <img src="{{ asset('storage/' . $selectedProject->file_project) }}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form wire:submit='update' enctype="multipart/form-data">
            <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Edit Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nama_project" class="form-label">Nama Project</label>
                                    <input type="text" id="nama_project"
                                        wire:model="nama_project"class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="deskripsi_project" class="form-label">Deskripsi Project</label>
                                    <textarea type="text" id="deskripsi_project" wire:model="deskripsi_project" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="file_project" class="form-label">File Project</label>
                                    <input type="file" id="file_project" wire:model="file_project"
                                        class="form-control" required />
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
        </form>
        <!--/ Responsive Table -->

    </div>
</div>

{{-- <script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('closeModalTambahProject', () => {
            const modalEl = document.getElementById('modalTambahProject');

            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
            }
        });
    });
</script> --}}
