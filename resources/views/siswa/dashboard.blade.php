<div class="container pb-4">

  <!-- HERO CARD -->
  <div class="row mt-3">
    <div class="col-12">
      <div class="card border-0 text-white"
           style="background: linear-gradient(135deg, #0c4d2d 0%, #07351e 60%, #eab308 100%);">
        <div class="card-body d-flex flex-column justify-content-center align-items-center text-center px-3 py-5 rounded">
          <h1 class="fw-bold display-4 mb-2">Librea</h1>
          <p class="fs-5 text-center mb-0" style="max-width: 480px; color: #facc15;">
            Selamat datang di ruang baca digital yang tenang
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- PINJAMAN AKTIF -->
  <div class="card mt-4 shadow-sm">
    <div class="card-header bg-white fw-bold" style="color: #0c4d2d;">
      Peminjaman Aktif
    </div>
    <div class="card-body">
      @php($activeLoans = $activeLoans ?? collect())
      @if($activeLoans->isEmpty())
        <p class="text-muted mb-0">Belum ada peminjaman aktif. Silakan pinjam buku dari halaman Daftar Buku.</p>
      @else
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Tgl. Pinjam</th>
                <th>Tenggat</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($activeLoans as $loan)
              <tr>
                <td>{{ $loan->book->title ?? '-' }}</td>
                <td>{{ $loan->book->author ?? '-' }}</td>
                <td>{{ $loan->loan_date ? \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') : '-' }}</td>
                <td>{{ $loan->due_date ? \Carbon\Carbon::parse($loan->due_date)->format('d M Y') : '-' }}</td>
                <td><span class="badge text-bg-success">Dipinjam</span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

</div>