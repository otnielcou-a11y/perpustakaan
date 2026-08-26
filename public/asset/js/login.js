document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Login berhasil! Mengalihkan ke halaman Home...');
      window.location.href = 'home.html';
    });
  }
});