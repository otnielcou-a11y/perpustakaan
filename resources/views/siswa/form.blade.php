<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peminjaman Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4 class="mb-0">Peminjaman Buku</h4>
          </div>
          <div class="card-body">
            <form class="border rounded p-3">
              <h5 class="text-center mb-3">Data Buku</h5>
              <div class="mb-3">
                <label for="judulBuku" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judulBuku">
              </div>
              <div class="mb-3">
                <label for="jumlahBuku" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlahBuku" min="1" value="1">
              </div>
              <div class="mb-3">
                <label for="tanggalPengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="tanggalPengembalian">
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-primary">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>