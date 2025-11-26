<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName('profile') ? 'active' : '' }}"
                            href="{{ url('profile') }}"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') ? 'active' : '' }}"
                            href="{{ url('profile/password') }}"><i class="bx bx-lock me-1"></i> Change
                            Password</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>

                    <!-- Account -->
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('success') }}
                            </div>
                        @elseif (session()->has('fotoSuccess'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('fotoSuccess') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="upload" enctype="multipart/form-data">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if (Auth::user()->foto_profile == null)
                                    <img src="../assets/img/avatars/1.png" wire:model="foto_profile" alt="user-avatar"
                                        class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                @else
                                    <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}"
                                        wire:model="foto_profile" alt="user-avatar" class="d-block rounded"
                                        height="100" width="100" id="uploadedAvatar" />
                                @endif

                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" wire:model="foto_profile"
                                            class="account-file-input" hidden accept="image/png, image/jpeg" />
                                    </label>
                                    <p class="text-muted mb-0">Allowed JPG or PNG. Max size of 1MB</p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr class="my-0" />

                    <div class="card-body">
                        <form wire:submit="update">
                            {{-- @method('PUT') --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" id="nama" wire:model="nama" />
                                </div>
                                @if (auth()->user()->role == 'Super Admin' || auth()->user()->role == 'Guru')
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="email" wire:model="email" />
                                    </div>
                                @endif
                                @if (auth()->user()->role == 'Siswa')
                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">Kelas</label>
                                        <select class="form-select" name="kelas" wire:model="kelas" required>
                                            <option value="" selected>Open this select menu</option>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">Jurusan</label>
                                        <select class="form-select" name="jurusan" wire:model="jurusan" required>
                                            <option value="" selected>Open this select menu</option>
                                            <option value="Tata Busana">Tata Busana</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="angkatan" class="form-label">Angkatan</label>
                                        <input class="form-control" type="number" wire:model="angkatan" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="email" wire:model="email" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="no_whatsapp" class="form-label">Nomor Whatsapp</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">+62</span>
                                            <input class="form-control" type="number" placeholder="81234567891"
                                                wire:model="no_whatsapp" />
                                        </div>
                                    </div>
                                @endif
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                    {{-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> --}}
                                </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
</div>
