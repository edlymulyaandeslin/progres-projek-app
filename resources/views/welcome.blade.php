@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <h4>Hello {{ auth()->user()->nama }}</h4>
            <h3>Selamat Datang di Aplikasi Progres Projek</h3>
            <p>
                Progres projek adalah aplikasi yang membantu untuk memantau kinerja dari mahasiswa atau siswa yang mengikuti
                magang dikantor yang bersangkutan. pengguna aplikasi ini dibedakan menjadi beberapa level yaitu sebagai
                mahasiswa/ siswa yang merupakan default level ketika mendaftar melalui aplikasi.selanjutnya
                level pembimbing dan koordinator yang ditambahkan oleh admin ketika aplikasi ini baru
                diluncurkan. Aplikasi ini juga memiliki beberapa fitur utama yang akan berbeda setiap level
                dimana selanjutnya akan dijelaskan pada petunjuk penggunaan aplikasi.
            </p>
            <h5 class="my-3">Petunjuk Penggunaan Aplikasi</h5>
            <div class="col-md-10 offset-1 mt-3">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Sebagai Mahasiswa
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ol>
                                    <li>Melakukan pengajuan judul projek</li>
                                    <li>Ketika judul anda diterima, anda dapat mengajukan logbook setelah melakukan
                                        bimbingan ke mentor</li>
                                    <li> Untuk dapat mengakses pengajuan presentasi, anda harus memiliki riwayat logbook
                                        yang sudah disetujui mentor minimal 2 kali</li>
                                    <li>Anda dapat melihat jadwal presentasi yang disetujui pada fitur show yang ada pada
                                        kolom action pada menu aplikasi</li>
                                    <li>Presentasi akan diapprove oleh koordinator atau mentor</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Sebagai Pembimbing
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ol>
                                    <li>Anda dapat melihat semua mahasiswa yang bimbingan dengan anda pada sub-menu
                                        mahasiswa</li>
                                    <li>Anda dapat melihat semua judul yang diajukan mahasiswa pada menu pengajuan judul
                                    </li>
                                    <li>Anda dapat melakukan approve atau reject untuk logbook yang diajukan mahasiswa pada
                                        kolom action di menu logbook</li>
                                    <li>Anda dapat melakukan approve atau reject untuk presentasi yang diajukan mahasiswa
                                        pada kolom action di menu presentasi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Sebagai Koordinator
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ol>
                                    <li>Dapat menambah pembimbing baru</li>
                                    <li>Setelah mahasiswa mengajukan judul anda dapat melakukan approve atau reject judul
                                        yang diajukan pada kolom action di menu pengajuan judul</li>
                                    <li>Setelah mahasiswa mengajukan presentasi anda dapat melakukan approve atau reject
                                        presentasi pada kolom action di menu presentasi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
