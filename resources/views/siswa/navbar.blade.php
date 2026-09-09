<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="light">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('siswa.dashboard') }}" style="color: #0c4d2d;">Librea</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="{{ route('siswa.dashboard') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('siswa.dashboard') }}">Pinjaman Buku</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('collections') }}">Daftar Buku</a></li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name ?? 'Akun' }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('user.settings') }}">Pengaturan Akun</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="dropdown-item text-danger" style="width:100%; text-align:left; border:none; background:none;">Logout</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>