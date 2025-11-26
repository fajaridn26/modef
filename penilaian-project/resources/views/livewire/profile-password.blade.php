<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"><i
                                class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') ? 'active' : '' }}"
                            href="{{ url('profile/password') }}"><i class="bx bx-lock me-1"></i> Change
                            Password</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>

                    <!-- Account -->

                    <hr class="my-0" />

                    <div class="card-body">
                        @if (session()->has('changePasswordSuccess'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('changePasswordSuccess') }}
                            </div>
                        @elseif (session()->has('passwordLamaError'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ session('passwordLamaError') }}
                            </div>
                        @endif

                        <form wire:submit="update">
                            {{-- @method('PUT') --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label for="password" class="form-label">Password Lama</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" wire:model="passwordLama"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" required />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="passwordBaru" class="form-control"
                                            wire:model="passwordBaru"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" required />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label for="password" class="form-label">Konfirmasi Password Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="konfirmasiPasswordBaru" class="form-control"
                                            wire:model="konfirmasiPasswordBaru"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" required />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>
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
