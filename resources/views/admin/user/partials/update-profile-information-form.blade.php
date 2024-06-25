<section>
    <header>
        <h2 class="text-lg font-medium">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Perbarui informasi profil dan alamat email akun Anda
        </p>
    </header>

    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="form-label d-block" for="select-nama-desa">Nama Desa</label>
            <select class="form-control select-desa @error('desa_id') is-invalid @enderror"
                value="{{ old('desa_id', $user->desa_id) }}" id="select-nama-desa" name="desa_id" disabled required>
                <option>Pilih desa</option>
                @foreach ($desa as $data)
                @if (old('desa_id', $user->desa_id) == $data->id)
                <option value="{{ $data->id }}" selected>{{ $data->nama_desa }}</option>
                @else
                <option value="{{ $data->id }}">{{ $data->nama_desa }}</option>
                @endif
                @endforeach
            </select>
            @error ('desa_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label class="form-label" for="nama">Nama</label>
            <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama"
                value="{{ old('nama', $user->nama) }}" name="nama" placeholder="Nama" required />
            @error ('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label class="form-label" for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" id="email" name="email" placeholder="Email" required />
            @error ('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div>
            <label class="form-label d-block" for="select-role">Role</label>
            <select class="form-control select @error('role') is-invalid @enderror" name="role" required disabled
                id="select-role">
                <option value="">Pilih Role User</option>
                <option value="Admin" {{ old('role', $user->role)=='Admin' ? 'selected' : '' }}>
                    Admin</option>
                <option value="Super Admin" {{ old('role', $user->role)=='Super Admin' ? 'selected' : '' }}>
                    Super Admin</option>
            </select>
            @error ('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Simpan.') }}</p>
            @endif
        </div>
    </form>
</section>