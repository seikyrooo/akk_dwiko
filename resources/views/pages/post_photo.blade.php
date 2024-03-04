@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="w-25 my-5 rounded p-4 shadow-lg">
            <h2 class="text-center mb-5">Post Photo</h2>
            <form action="{{ route('photo.postProcess') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input class="form-control" type="file" id="photo" accept="image/jpg,image/jpeg,image/png"
                        name="photo" aria-label="photo upload">
                    @error('photo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="judul_foto" class="form-label">Title</label>
                    <input type="text" class="form-control" name="judul_foto" id="judul_foto"
                        placeholder="Judul Foto...">
                    @error('judul_foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi_foto" class="form-label">Description</label>
                    <textarea name="deskripsi_foto" class="form-control" id="deskripsi_foto" rows="10"></textarea>
                    @error('deskripsi_foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <button type="submit" class="btn btn-dark w-100">Confirm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
