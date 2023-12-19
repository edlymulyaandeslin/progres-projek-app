            <!-- Sidebar Start -->
            <div class="sidebar pe-3 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <a href="#" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary">Progress Project</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src="https://ui-avatars.com/api/?name={{ auth()->user()->nama }}"
                                alt="" style="width: 40px; height: 40px;">
                            <div
                                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">{{ auth()->user()->nama }}</h6>
                            <span>{{ auth()->user()->level->name }}</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">

                        <a href="/" class="nav-item nav-link {{ Request::is('/*') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                        @if (auth()->user()->level_id === 4 || auth()->user()->level_id === 2)
                            <a href="/mahasiswa"
                                class="nav-item nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}"><i
                                    class="fa fa-user-friends me-2"></i>Mahasiswa</a>
                        @endif

                        @if (auth()->user()->level_id === 4 || auth()->user()->level_id === 3)
                            <a href="/pembimbing"
                                class="nav-item nav-link {{ Request::is('pembimbing*') ? 'active' : '' }}"><i
                                    class="fa fa-user-tie me-2"></i>Pembimbing</a>
                        @endif

                        @if (auth()->user()->level_id === 4)
                            <a href="/koordinator"
                                class="nav-item nav-link {{ Request::is('koordinator*') ? 'active' : '' }}"><i
                                    class="fa fa-user-shield me-2"></i>Koordinator</a>
                        @endif

                        <a href="/judulprojek"
                            class="nav-item nav-link {{ Request::is('judulprojek*') ? 'active' : '' }}"><i
                                class="fa fa-keyboard me-2"></i>Pengajuan
                            Judul</a>

                        @if (auth()->user()->level_id !== 3)
                            <a href="/logbook"
                                class="nav-item nav-link {{ Request::is('logbook*') ? 'active' : '' }}"><i
                                    class="fa fa-address-book me-2"></i>Log
                                Book</a>
                        @endif

                        <a href="/presentasi"
                            class="nav-item nav-link {{ Request::is('presentasi*') ? 'active' : '' }}"><i
                                class="fa fa-address-card me-2"></i>Presentasi</a>

                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->
