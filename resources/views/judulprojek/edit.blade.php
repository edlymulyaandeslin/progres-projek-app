@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Update Kemajuan</h4>

            <form action="/judulprojek/{{ $judulprojek->id }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                        name="judul" value="{{ $judulprojek->judul }}">
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
                        <option selected value="{{ '-' }}">Pilih Pembimbing</option>
                        @foreach ($users as $pembimbing)
                            @if ($pembimbing->nama == $judulprojek->pembimbing)
                                <option value="{{ $pembimbing->nama }}" selected>{{ $pembimbing->nama }}</option>
                            @else
                                <option value="{{ $pembimbing->nama }}">{{ $pembimbing->nama }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select form-select-sm mb-3" name="status" id="status"
                        aria-label=".form-select-sm example">
                        <option selected disabled>Diajukan</option>
                        @if ($judulprojek->status == 'diterima')
                            <option value="diterima" selected>Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        @elseif ($judulprojek->status == 'ditolak')
                            <option value="diterima">Diterima</option>
                            <option value="ditolak" selected>Ditolak</option>
                        @else
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        @endif
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
