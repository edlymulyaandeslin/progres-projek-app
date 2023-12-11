@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Ajukan Presentasi</h4>

            <form action="/presentasi/{{ $present->id }}" method="POST">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <select class="form-select form-select-sm mb-3 @error('judul_id') is-invalid @enderror" name="judul_id"
                        id="judul_id" aria-label=".form-select-sm example">
                        <option selected disabled>Pilih Judul</option>
                        <option value="{{ $present->judul->id }}" selected>{{ $present->judul->judul }}</option>
                    </select>
                    @error('judul_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="form-control @error('tanggal')
                        is-invalid
                    @enderror"
                        value="{{ $present->tanggal }}">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jam" class="form-label">Jam</label>
                    <input type="time" name="jam" id="jam"
                        class="form-control @error('jam')
                        is-invalid
                    @enderror"
                        value="{{ $present->jam }}">
                    @error('jam')
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
                        @if ($present->status == 'diterima')
                            <option value="diterima" selected>Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        @elseif ($present->status == 'ditolak')
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
