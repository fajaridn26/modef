<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Siswa</h4>

        <!-- Responsive Table -->

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" wire:ignore.self>
            Tambah User
        </button>

        <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#importCSV">
            <span class="tf-icons bx bx-file"></span>&nbsp; Import Excel
        </button>

        <div class="card mt-3">
            <h5 class="card-header">Daftar Siswa</h5>
            @if (session()->has('updateSuccess'))
                <div class="alert alert-success alert-dismissible ms-4 me-4" role="alert">
                    {{ session('updateSuccess') }}
                </div>
            @elseif (session()->has('createSuccess'))
                <div class="alert alert-success alert-dismissible ms-4 me-4" role="alert">
                    {{ session('createSuccess') }}
                </div>
            @elseif (session()->has('createFailed'))
                <div class="alert alert-danger alert-dismissible ms-4 me-4" role="alert">
                    {{ session('createFailed') }}
                </div>
            @elseif (session()->has('importSuccess'))
                <div class="alert alert-success alert-dismissible ms-4 me-4" role="alert">
                    {{ session('importSuccess') }}
                </div>
            @endif
            <div class="mt-1 mb-3 ms-4">
                <div class="col-10 col-md-3">
                    <input class="form-control" type="search" placeholder="Search ..."
                        wire:model.live.debounce.300ms='search' />
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Angkatan</th>
                            <th>Email</th>
                            <th>No Whatsapp</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <th scope="row">{{ $users->firstItem() + $index }}</th>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->kelas }} - {{ $user->jurusan }}</td>
                                <td>{{ $user->angkatan ? $user->angkatan : '-' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->no_whatsapp ? $user->no_whatsapp : '-' }}</td>
                                @if ($user->role == 'Super Admin')
                                    <td>
                                        <span class="badge bg-label-primary text-capitalize">{{ $user->role }}</span>
                                    </td>
                                @elseif ($user->role == 'Guru')
                                    <td>
                                        <span class="badge bg-label-warning text-capitalize">{{ $user->role }}</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge bg-label-success text-capitalize">{{ $user->role }}</span>
                                    </td>
                                @endif
                                <td>
                                    <div>
                                        <Button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit"
                                            wire:click="edit({{ $user->id }})">Edit</Button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div>
                                        <img class="item-center" src="{{ asset('assets/img/no_data.svg') }}"
                                            alt="" width="300">
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
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-md-10 ms-4">
                        {{ $users->links('vendor.livewire.bootstrap') }}
                    </div>
                </div>
            </div>
        </div>

        <!--/ Responsive Table -->
    </div>

    <form wire:submit="create">
        @csrf
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" id="nama" wire:model="nama" class="form-control"
                                    placeholder="Masukkan Nama" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" wire:model="email" class="form-control"
                                    placeholder="Masukkan Email" required />
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

    <form wire:submit.prevent="import" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="importCSV" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="csv" class="form-label">File CSV</label>
                                <input type="file" wire:model="importFile" class="form-control" required />
                            </div>
                            @error('import_file')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
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

    <form wire:submit='update'>
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Nama</label>
                                <input type="text" id="nama" wire:model="nama"class="form-control"
                                    disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Kelas</label>
                                <input type="text" id="kelas" wire:model="kelas" class="form-control"
                                    disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Email</label>
                                <input type="text" id="email" wire:model="email" class="form-control"
                                    disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">No Whatsapp</label>
                                <input type="number" id="no_whatsapp" wire:model="no_whatsapp" class="form-control"
                                    disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Role</label>
                                <select class="form-select" id="role" wire:model="role" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="Guru">Guru</option>
                                    <option value="Siswa">Siswa</option>
                                </select>
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

</div>
