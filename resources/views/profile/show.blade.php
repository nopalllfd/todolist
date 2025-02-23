<!-- filepath: /d:/ukk/todolist/resources/views/profile/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <h1>Profil Pengguna</h1>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="50" height="50">
                    <h3 class="ml-3">{{ $user->name }}</h3>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <!-- Tambahkan informasi profil lainnya di sini -->
                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>

        <!-- Form untuk mengunggah foto profil -->
        <div class="card">
            <div class="card-header">
                <h3>Unggah Foto Profil</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="profile_photo">Pilih Foto Profil</label>
                        <input type="file" class="form-control-file" id="profile_photo" name="profile_photo" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Unggah</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>