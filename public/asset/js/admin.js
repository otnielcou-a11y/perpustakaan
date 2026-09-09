/* ============================================================
   ADMIN SMKN 2 PURWAKARTA - JS Helpers (Drawer, Modal, Dropdown)
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {
  // ---------- MOBILE SIDEBAR DRAWER ----------
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebarClose = document.getElementById('sidebarClose');
  const sidebarBackdrop = document.getElementById('sidebarBackdrop');
  const sidebar = document.querySelector('.sidebar');

  function openSidebar() {
    if (!sidebar) return;
    sidebar.classList.add('show');
    if (sidebarBackdrop) sidebarBackdrop.classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closeSidebar() {
    if (!sidebar) return;
    sidebar.classList.remove('show');
    if (sidebarBackdrop) sidebarBackdrop.classList.remove('show');
    document.body.style.overflow = '';
  }

  if (sidebarToggle) sidebarToggle.addEventListener('click', openSidebar);
  if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
  if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeSidebar);

  // Tutup sidebar setelah klik menu di layar HP (untuk navigasi cepat)
  if (sidebar) {
    sidebar.querySelectorAll('.sidebar-nav a, .sidebar-bottom a').forEach(function (link) {
      link.addEventListener('click', function () {
        if (window.innerWidth <= 992) closeSidebar();
      });
    });
  }

  // ---------- MODAL ----------
  window.openModal = function (id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
  };

  window.closeModal = function (id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.remove('show');
    document.body.style.overflow = '';
  };

  document.querySelectorAll('.modal-backdrop').forEach(function (modal) {
    modal.addEventListener('click', function (e) {
      if (e.target === this) window.closeModal(this.id);
    });
    modal.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') window.closeModal(this.id);
    });
    // Tangani tombol tutup (icon-btn/close) di dalam modal
    modal.querySelectorAll('[data-close-modal]').forEach(function (btn) {
      btn.addEventListener('click', function () { window.closeModal(modal.id); });
    });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-backdrop.show').forEach(function (m) {
        window.closeModal(m.id);
      });
    }
  });

  // ---------- DROPDOWN (Header Admin / Umum) ----------
  document.querySelectorAll('.admin-dropdown-wrapper').forEach(function (wrapper) {
    const toggle = wrapper.querySelector('.dropdown-toggle-link, .admin-dropdown-trigger');
    if (!toggle) return;

    toggle.addEventListener('click', function (e) {
      const isTouch = window.matchMedia('(max-width: 768px)').matches;
      if (!isTouch) return;
      e.preventDefault();
      e.stopPropagation();
      const menu = wrapper.querySelector('.admin-dropdown-menu, .dropdown-content');
      if (!menu) return;

      document.querySelectorAll('.admin-dropdown-menu.open, .dropdown-content.open').forEach(function (d) {
        if (d !== menu) d.classList.remove('open');
      });
      menu.classList.toggle('open');

      if (menu.classList.contains('open')) {
        menu.style.display = 'block';
      } else {
        menu.style.display = '';
      }
    });
  });

  document.addEventListener('click', function (e) {
    if (!e.target.closest('.admin-dropdown-wrapper, .dropdown-wrapper')) {
      document.querySelectorAll('.admin-dropdown-menu.open, .dropdown-content.open').forEach(function (d) {
        d.classList.remove('open');
        d.style.display = '';
      });
    }
  });

  // ---------- GLOBAL SEARCH (jika ada) ----------
  const globalSearch = document.getElementById('globalSearch');
  if (globalSearch) {
    globalSearch.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        const q = globalSearch.value.trim();
        if (q) window.location.href = '/admin/data-buku?search=' + encodeURIComponent(q);
      }
    });
  }
});