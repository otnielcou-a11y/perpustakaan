document.addEventListener('DOMContentLoaded', function () {
  // 1. Toggle Peran (Murid / Guru)
  const rolePills = document.querySelectorAll('.role-pill');
  const roleInput = document.getElementById('roleInput');
  const nisNipLabel = document.getElementById('nisNipLabel');
  const nisNipInput = document.getElementById('nisNipInput');

  rolePills.forEach(pill => {
    pill.addEventListener('click', function () {
      rolePills.forEach(p => p.classList.remove('active'));
      this.classList.add('active');

      const role = this.dataset.role;
      if (roleInput) roleInput.value = role;

      // Ubah label di form register sesuai peran
      if (nisNipLabel && nisNipInput) {
        if (role === 'guru') {
          nisNipLabel.textContent = 'Nomor Induk Pegawai / NIP';
          nisNipInput.placeholder = 'Masukkan NIP Anda';
        } else {
          nisNipLabel.textContent = 'Nomor Induk Siswa / NIS';
          nisNipInput.placeholder = 'Masukkan NIS atau NIP';
        }
      }
    });
  });

  // 2. Toggle Intip Password (Hide/Show)
  const togglePassButtons = document.querySelectorAll('.toggle-password');
  togglePassButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const input = this.closest('.input-icon-wrapper').querySelector('input');
      const icon = this.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });
  });
});
