<section>
    <header>
        <h2 class="text-lg font-medium">
            Perbarui Password
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="form-label" for="update_password_current_password">Password Sekarang</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full form-control" autocomplete="current-password">
            @error ('current_password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label class="form-label" for="update_password_password">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full form-control"
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="form-label" for="update_password_password_confirmation">Password Konfirmasi</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Simpan</button>


            @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>