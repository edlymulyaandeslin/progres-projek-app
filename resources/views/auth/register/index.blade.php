<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-4 mb-4 offset-3 bg-light p-4 rounded">
                    <h4 class="text-center text-uppercase">Register</h4>
                    <form action="/auth/register" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" value="{{ old('alamat') }}">
                            @error('alamat')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select name="agama" id="agama"
                                class="form-control @error('agama')
                                is-invalid
                            @enderror">
                                <option selected disabled>Pilih agama</option>
                                @if (old('agama'))
                                    <option value="{{ old('agama') }}" selected>{{ old('agama') }}</option>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha">Budha</option>
                                @else
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha">Budha</option>
                                @endif
                            </select>
                            @error('agama')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jenis kelamin</label>
                            <div class="form-check">
                                <div>
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin" value="laki-laki">
                                    <label class="form-check-label" for="jenis_kelamin">
                                        Laki Laki
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin" value="perempuan">
                                    <label class="form-check-label" for="jenis_kelamin">
                                        Perempuan
                                    </label>
                                </div>
                            </div>

                            @error('jenis_kelamin')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}">
                            @error('pekerjaan')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                name="password" id="password">
                            @error('password')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>

                    <div class="mt-2">
                        <small>Sudah memiliki akun? <a href="/auth/login">Login disini</a></small>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
