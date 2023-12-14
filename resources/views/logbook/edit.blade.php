@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Update Log book</h4>
            {{-- {{ $logbook }} --}}
            <form action="/logbook/{{ $logbook->id }}" method="POST">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <select class="form-select form-select-sm mb-3 @error('judul_id') is-invalid @enderror" name="judul_id"
                        id="judul_id" aria-label=".form-select-sm example">
                        <option value="{{ $logbook->judul->id }}" selected>{{ $logbook->judul->judul }}</option>
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
                        name="description">{{ old('description', $logbook->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select form-select-sm mb-3" name="status" id="status"
                        aria-label=".form-select-sm example">
                        <option selected disabled>Diajukan</option>
                        @if ($logbook->status == 'diterima')
                            <option value="diterima" selected>Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        @elseif ($logbook->status == 'ditolak')
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
