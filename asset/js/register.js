document.addEventListener('DOMContentLoaded', () => {
  const registerForm = document.getElementById('registerForm');
  if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Pendaftaran akun berhasil! Silakan login.');
      window.location.href = 'login.html';
    });
  }
});