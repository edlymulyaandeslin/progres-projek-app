@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Ajukan Judul</h4>

            <form action="/judulprojek" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                        name="judul">
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pembimbing" class="form-label">Pembimbing</label>
                    <select class="form-select form-select-sm mb-3 @error('pembimbing') is-invalid @enderror"
                        name="pembimbing" id="pembimbing" aria-label=".form-select-sm example">
                        <option selected disabled>Pilih Pembimbing</option>
                        @foreach ($pembimbing as $mentor)
                            <option value="{{ $mentor->nama }}">{{ $mentor->nama }}</option>
                        @endforeach
                    </select>
                    @error('pembimbing')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select form-select-sm mb-3" name="status" id="status"
                        aria-label=".form-select-sm example">
                        <option selected>Pilih Status</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-primary">Tambah</button>
            </form>
        </div>
    </div>
@endsection
