@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Isi Logbook</h4>

            <form action="/logbook" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <select class="form-select form-select-sm mb-3 @error('judul_id') is-invalid @enderror" name="judul_id"
                        id="judul_id" aria-label=".form-select-sm example">
                        <option selected disabled>Pilih Judul</option>
                        @foreach ($juduls as $judul)
                            @if ($judul->status === 'diterima')
                                <option value="{{ $judul->id }}">{{ $judul->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('judul_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea type="text" rows="6" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if (auth()->user()->level_id === 4)
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select form-select-sm mb-3" name="status" id="status"
                            aria-label=".form-select-sm example">
                            <option selected disabled>Pilih Status</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                @endif

                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
