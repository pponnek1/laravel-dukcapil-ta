<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
            <img src="assets/img/logo.png" alt="">
            <h1 class="sitename">e-Dukcapil</h1>
            <span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}/#about" class="">About</a> <!-- Karena ini anchor dalam halaman -->
                </li>
                <li>
                    <a href="{{ route('antrian.index') }}" class="{{ Request::is('antrian') ? 'active' : '' }}">
                        Ambil Antrian
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('daftar-antrian.index') }}"
                        class="{{ Request::is('daftar-antrian*') ? 'active' : '' }}">
                        <span>Daftar Antrian</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        @foreach ($antrianList as $antrian)
                        <li>
                            <a href="{{ route('daftar-antrian.show', $antrian->slug) }}"
                                class="{{ Request::is('daftar-antrian/' . $antrian->slug) ? 'active' : '' }}">
                                {{ $antrian->nama_layanan }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">
                        Contact
                    </a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


        @auth
        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            hallo, {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu">
            @if (auth()->user()->hasRole('admin'))
            <li><a class="dropdown-item" href="/admin">Dashboard</a></li>
            @else
            <li><a class="dropdown-item" href="/antrian/detail">Antrian Saya</a></li>
            @endif
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item"><span class="align-middle">keluar</span></button>
                </button>
            </form>
        </ul>
        @else
        <a class="btn-getstarted" href="/login">Login</a>
        @endauth
    </div>
</header>
