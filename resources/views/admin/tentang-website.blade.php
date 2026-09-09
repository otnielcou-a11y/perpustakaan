<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Website - Admin SMKN 2 Purwakarta</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary: #0c4d2d;
      --primary-dark: #07351e;
      --accent-yellow: #facc15;
      --bg-app: #f8fafc;
      --sidebar-bg: #f8fafc;
      --text-main: #0f172a;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --white: #ffffff;
    }
    ::-webkit-scrollbar {
        width: 0px;
        background: transparent;
    }

    * {
        scrollbar-width: none;
    }

    * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
    body { background-color:var(--bg-app); color:var(--text-main); display:flex; min-height:100vh; overflow-x:hidden; }
    a { text-decoration:none; color:inherit; cursor:pointer; }

    /* SIDEBAR */
    .sidebar { width:260px; background-color:var(--sidebar-bg); border-right:1px solid var(--border); display:flex; flex-direction:column; justify-content:space-between; min-height:100vh; position:fixed; left:0; top:0; z-index:100; }
    .sidebar-top { padding:24px 20px; }
    .sidebar-brand { display:flex; align-items:center; gap:12px; margin-bottom:28px; }

    .sidebar-nav { display:flex; flex-direction:column; gap:4px; }
    .nav-item { display:flex; align-items:center; gap:12px; padding:12px 16px; font-size:13.5px; font-weight:600; color:#334155; border-radius:6px; transition:0.2s; }
    .nav-item:hover { background-color:#f1f5f9; }
    .nav-item.active { background-color:var(--accent-yellow); color:#000; font-weight:700; }
    .sidebar-bottom { padding:20px; border-top:1px solid var(--border); display:flex; flex-direction:column; gap:4px; }

    /* MAIN WRAPPER */
    .main-wrapper { margin-left:260px; flex:1; display:flex; flex-direction:column; min-width:0; }

    /* TOP HEADER: SEJAJAR & FIXED DROPDOWN */
    .top-header { height:70px; background-color:var(--white); border-bottom:1px solid var(--border); display:flex; flex-direction:row; align-items:center; justify-content:space-between; padding:0 36px; position:sticky; top:0; z-index:90; }

    .btn-back-home { display:inline-flex; align-items:center; gap:8px; padding:8px 16px; background:#f8fafc; border:1px solid var(--border); border-radius:8px; font-size:13px; font-weight:700; color:var(--primary); transition:0.2s; }
    .btn-back-home:hover { background:var(--primary); color:#ffffff; border-color:var(--primary); }

    /* DROPDOWN ADMIN HEADER HOVER STYLES */
    .admin-dropdown-wrapper { position:relative; padding-bottom:12px; margin-bottom:-12px; }
    .admin-dropdown-wrapper:hover .fa-chevron-down { transform:rotate(180deg); color:var(--primary); }

    .admin-dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background-color: #ffffff;
      min-width: 220px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
      border-radius: 10px;
      border: 1px solid var(--border);
      z-index: 10000;
      margin-top: 6px;
    }

    .admin-dropdown-menu::before {
      content: '';
      position: absolute;
      top: -12px;
      left: 0;
      width: 100%;
      height: 12px;
    }

    .admin-dropdown-wrapper:hover .admin-dropdown-menu {
      display: block;
      animation: fadeInAdmin 0.2s ease forwards;
    }

    @keyframes fadeInAdmin {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .admin-dropdown-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 18px;
      font-size: 13px;
      font-weight: 600;
      color: #334155;
      transition: all 0.2s ease;
    }

    .admin-dropdown-item i { width: 16px; text-align: center; }
    .admin-dropdown-item:hover { background-color: #f1f5f9; color: var(--primary); padding-left: 22px; }

    /* CONTENT BODY */
    .content-body { padding:32px 36px; }
    .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
    .page-title h1 { font-size:26px; font-weight:800; letter-spacing:-0.5px; }
    .page-title p { font-size:13px; color:var(--text-muted); margin-top:4px; }

    .dashboard-panel { background:var(--white); border:1px solid var(--border); border-radius:12px; padding:32px; margin-bottom:24px; max-width: 800px;}
    .panel-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; padding-bottom: 16px; border-bottom: 1px solid var(--border); }
    .panel-header h3 { font-size:18px; font-weight:800; color: var(--text-main); }

    .badge-status { padding:6px 12px; border-radius:20px; font-size:12px; font-weight:800; display:inline-block; }
    .status-active { background-color:#e0f2fe; color:#0369a1; border: 1px solid #bae6fd; }

    /* ABOUT CONTENT TYPOGRAPHY */
    .about-section { margin-bottom: 28px; }
    .about-section h4 { font-size: 15px; font-weight: 700; color: var(--primary); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
    .about-section p { font-size: 14px; color: var(--text-muted); line-height: 1.7; }
    .about-section ul { margin-top: 10px; margin-left: 20px; }
    .about-section li { font-size: 14px; color: var(--text-muted); line-height: 1.7; margin-bottom: 6px; }
    .about-section li strong { color: var(--text-main); }

    .system-info-card { background-color: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid var(--border); margin-top: 10px; display: flex; gap: 40px; flex-wrap: wrap; }
    .info-group { display: flex; flex-direction: column; gap: 4px; }
    .info-label { font-size: 12px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .info-value { font-size: 14px; font-weight: 700; color: var(--text-main); }

    /* RESPONSIVE MOBILE & DRAWER */
    .btn-sidebar-toggle { display: none; background: none; border: 1px solid var(--border); border-radius: 8px; padding: 8px 12px; font-size: 16px; color: var(--text-main); cursor: pointer; align-items: center; justify-content: center; transition: 0.2s; }
    .btn-sidebar-toggle:hover { background: #f1f5f9; }
    .sidebar-backdrop { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 998; backdrop-filter: blur(2px); }
    .sidebar-backdrop.show { display: block; }
    .sidebar-close-btn { display: none; background: none; border: none; font-size: 20px; color: var(--text-muted); cursor: pointer; padding: 4px 8px; margin-left: auto; }
    .sidebar-close-btn:hover { color: var(--text-main); }

    @media (max-width: 992px) {
      .sidebar { transform: translateX(-100%); transition: transform 0.3s ease-in-out; z-index: 999; box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
      .sidebar.show { transform: translateX(0); }
      .sidebar-close-btn { display: block; }
      .main-wrapper { margin-left: 0 !important; width: 100% !important; }
      .btn-sidebar-toggle { display: inline-flex; }
      .top-header { padding: 0 16px; gap: 10px; }
      .content-body { padding: 20px 16px; }
      .page-header { flex-direction: column; align-items: stretch; gap: 14px; }
      .dashboard-panel { max-width: 100%; }
    }

    @media (max-width: 640px) {
      .hide-mobile-text { display: none; }
      .page-title h1 { font-size: 22px; }
      .system-info-card { flex-direction: column; gap: 16px; }
    }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <div class="sidebar-brand">
        @include('partials.logo', ['theme' => 'dark'])
        <button type="button" class="sidebar-close-btn" id="sidebarClose" aria-label="Tutup Menu">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <nav class="sidebar-nav">
        <a href="{{ url('/admin/dashboard') }}" class="nav-item">
          <i class="fa-solid fa-table-cells-large"></i> Dashboard
        </a>
        <a href="{{ url('/admin/data-buku') }}" class="nav-item">
          <i class="fa-solid fa-book-open"></i> Book Management
        </a>
        <a href="{{ url('/admin/data-anggota') }}" class="nav-item">
          <i class="fa-solid fa-users"></i> Member Management
        </a>
        <a href="{{ url('/admin/transaksi') }}" class="nav-item">
          <i class="fa-solid fa-arrow-right-arrow-left"></i> Transactions
        </a>
        <a href="{{ url('/admin/kategori') }}" class="nav-item">
          <i class="fa-solid fa-tags"></i> Category Management
        </a>
        @if(auth()->user() && auth()->user()->role === 'superadmin')
        <a href="{{ url('/admin/tambah-admin') }}" class="nav-item">
          <i class="fa-solid fa-user-shield"></i> Administrator
        </a>
        @endif
        <a href="{{ url('/admin/tentang-website') }}" class="nav-item active">
          <i class="fa-solid fa-circle-info"></i> About Website
        </a>
      </nav>
    </div>

    <div class="sidebar-bottom">
      <a href="{{ url('/admin/settings') }}" class="nav-item">
        <i class="fa-solid fa-gear"></i> Settings
      </a>
      <a href="{{ url('/logout') }}" class="nav-item" style="color: #ef4444;">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
      </a>
    </div>
  </aside>

  <!-- MAIN WRAPPER -->
  <div class="main-wrapper">
    <!-- TOP HEADER -->
    <header class="top-header">
      <div style="display:flex; align-items:center; gap:10px;">
        <button type="button" class="btn-sidebar-toggle" id="sidebarToggle" aria-label="Menu Navigasi">
          <i class="fa-solid fa-bars"></i>
        </button>
        <a href="{{ url('/') }}" class="btn-back-home">
          <i class="fa-solid fa-house"></i> <span class="hide-mobile-text">Kembali ke Beranda</span>
        </a>
      </div>

      @include('partials.admin_avatar')
    </header>

    <main class="content-body">

      <div class="page-header">
        <div class="page-title">
          <h1>About Website</h1>
          <p>System information, project details, and current version.</p>
        </div>
      </div>

      <!-- ABOUT CONTENT PANEL -->
      <div class="dashboard-panel">
        <div class="panel-header">
          <h3>System Overview</h3>
          <span class="badge-status status-active">Version 0.0.1</span>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-book-bookmark"></i> The Project</h4>
          <p>
            Welcome to the administration dashboard of the <strong>SMKN 2 Purwakarta Libraries</strong>.
            This platform is an online-based library system designed to digitally manage book collections,
            streamline the administration process, and provide students and staff with an integrated educational resource center.
          </p>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-pager"></i> Main Interface Pages</h4>
          <p>The public-facing website is built to enhance the user experience. It consists of several primary pages:</p>
          <ul>
            <li><strong>Home:</strong> The landing page displaying library statistics and recommended book collections.</li>
            <li><strong>Categories:</strong> A classified view organizing books by specific genres, topics, or academic fields for easier navigation.</li>
            <li><strong>Collections:</strong> A comprehensive directory for users to explore books based on vocational categories.</li>
            <li><strong>Book Details:</strong> Specific pages showcasing the synopsis, stock availability, and detailed metadata of a book.</li>
            <li><strong>Profile & Login:</strong> Personalized user areas for tracking library activities.</li>
            <li><strong>Library Profile:</strong> A page displaying essential library information, including contact details, and service overview across vocational programs</li>
            <li><strong>About Library:</strong> A dedicated page presenting the vision and mission of the library.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-flask"></i> Core Features (Beta)</h4>
          <p>
            The system is currently undergoing active development. At this stage, our primary focus is testing
            the core library operations. The main features that are currently in their <strong>Beta</strong> phase include:
          </p>
          <ul>
            <li><strong>Borrowing (Peminjaman):</strong> Automated book borrowing requests requiring administrator validation.</li>
            <li><strong>Returning (Pengembalian):</strong> Secure book return processes connected directly to the user's transaction history and library stock management.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-shield-halved"></i> Authentication & Security</h4>
          <p>The platform provides a secure multi-layered authentication system for all types of users:</p>
          <ul>
            <li><strong>Login & Register:</strong> Students and teachers can create accounts using their NISN/NIP and email. NISN validation is performed in real-time during registration.</li>
            <li><strong>Forgot Password (OTP via Email):</strong> Users who forget their password can request a One-Time Password (OTP) sent to their registered email. After verification, they can reset their password securely (Coming soon).</li>
            <li><strong>Role-Based Access Control:</strong> Different user roles (Superadmin, Admin, Guru, Murid) are granted different access permissions throughout the system.</li>
            <li><strong>Session Management:</strong> Authenticated sessions are handled by Laravel's built-in session guard, ensuring secure state management across pages.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-users-gear"></i> User Roles & Access Levels</h4>
          <p>The system distinguishes four types of users, each with distinct capabilities:</p>
          <ul>
            <li><strong>Superadmin:</strong> Full system access, including the ability to manage other administrators (add, edit, downgrade, or remove admin accounts).</li>
            <li><strong>Admin:</strong> Can manage books, categories, members, and transactions. Cannot manage other admin accounts.</li>
            <li><strong>Guru (Teacher):</strong> Can browse book collections, borrow and return books, and manage their personal account settings.</li>
            <li><strong>Murid (Student):</strong> Can browse book collections, borrow and return books, view their borrowing history, and manage their personal account settings.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-toolbox"></i> Admin Panel Features</h4>
          <p>The administration dashboard provides powerful tools for library management:</p>
          <ul>
            <li><strong>Dashboard Overview:</strong> A centralized view displaying real-time statistics including total books, categories, active members, and recent transactions at a glance.</li>
            <li><strong>Book Management (Data Buku):</strong> Full CRUD operations for book records — add new books with cover images, edit book details, delete individual or multiple books (bulk delete), and manage stock quantities.</li>
            <li><strong>Category Management (Data Kategori):</strong> Create, edit, and delete book categories to organize the library collection. Supports bulk deletion for efficient management.</li>
            <li><strong>Member Management (Data Anggota):</strong> View all registered members (students and teachers), add new members manually, edit their details, view their borrowing history, and ban/unban members if necessary.</li>
            <li><strong>Transaction Management (Transaksi):</strong> A complete loan management interface where admins can approve or reject borrow requests, process book returns, and monitor all active and historical transactions.</li>
            <li><strong>Administrator Management:</strong> Exclusive to Superadmin — add new admin accounts, edit admin profiles, downgrade admins, or remove them from the system entirely.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-graduation-cap"></i> Student & Teacher Dashboard</h4>
          <p>Registered students and teachers have access to a personalized dashboard featuring:</p>
          <ul>
            <li><strong>Active Loans:</strong> View all currently borrowed books with their due dates and status in real-time.</li>
            <li><strong>Return History:</strong> A record of recently returned books to track past borrowing activity.</li>
            <li><strong>Quick Actions:</strong> Direct links to browse book collections, return borrowed books, or manage account settings from the dashboard.</li>
            <li><strong>Account Settings:</strong> Personalize profile details such as name, email, password, and profile picture through a dedicated settings page.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-gear"></i> Settings & Customization</h4>
          <p>The admin settings panel allows system-wide configuration:</p>
          <ul>
            <li><strong>Admin Profile:</strong> Administrators can update their own name, email, and password from the settings page.</li>
            <li><strong>Library Branding:</strong> Customize the library's display name, description text, and logo that appears across all public-facing pages and admin panels.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-search"></i> Search & Discovery</h4>
          <p>The platform includes intelligent search and discovery features:</p>
          <ul>
            <li><strong>Live Book Search:</strong> Real-time search suggestions as users type, powered by an API endpoint for instant results.</li>
            <li><strong>Category Filtering:</strong> Browse books filtered by specific categories or vocational programs for targeted discovery.</li>
            <li><strong>Collection Browsing:</strong> A dedicated collections page with pagination and multiple filtering options for comprehensive book exploration.</li>
            <li><strong>Randomized Recommendations:</strong> The homepage dynamically displays random book recommendations to encourage diverse reading habits.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-code"></i> Technology Stack</h4>
          <p>This application is built on modern, reliable web technologies:</p>
          <ul>
            <li><strong>Backend Framework:</strong> Laravel (PHP) — a robust MVC framework providing routing, authentication middleware, Eloquent ORM, and Blade templating.</li>
            <li><strong>Frontend:</strong> Blade Templates with custom CSS (Plus Jakarta Sans typography) and Font Awesome icons. Fully responsive design optimized for desktop and mobile devices.</li>
            <li><strong>Database:</strong> MySQL — relational database managing books, categories, users, loans, and system settings.</li>
            <li><strong>Authentication:</strong> Laravel's built-in Auth system with Bcrypt password hashing, CSRF protection, and session-based authentication.</li>
            <li><strong>Email Service:</strong> SMTP-based email delivery for password reset OTP functionality.</li>
            <li><strong>Local Development:</strong> Laragon — a portable, fast, and lightweight development environment for Windows.</li>
          </ul>
        </div>

        <div class="about-section">
          <h4><i class="fa-solid fa-road"></i> Development Roadmap</h4>
          <p>Upcoming features and improvements planned for future releases:</p>
          <ul>
            <li><strong>Late Return Penalties:</strong> Automatic fine calculation for overdue book returns.</li>
            <li><strong>Advanced Reporting:</strong> Exportable reports for borrowing statistics, popular books, and member activity analytics.</li>
            <li><strong>Notification System:</strong> Email and in-app notifications for due date reminders, loan approvals, and system announcements.</li>
            <li><strong>Digital Book Reader:</strong> Integrated e-book reading capabilities for digital library resources.</li>
            <li><strong>QR Code Integration:</strong> Generate and scan QR codes for faster book borrowing and returning processes.</li>
          </ul>
        </div>

        <div class="system-info-card">
          <div class="info-group">
            <span class="info-label">Current Build</span>
            <span class="info-value">v0.0.1 Beta</span>
          </div>
          <div class="info-group">
            <span class="info-label">Framework</span>
            <span class="info-value">Laravel (PHP)</span>
          </div>
          <div class="info-group">
            <span class="info-label">Database</span>
            <span class="info-value">MySQL</span>
          </div>
          <div class="info-group">
            <span class="info-label">Environment</span>
            <span class="info-value">Laragon</span>
          </div>
        </div>

      </div>
    </main>
  </div>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarToggle && sidebar) {
      sidebarToggle.addEventListener('click', () => {
        sidebar.classList.add('show');
        if (sidebarBackdrop) sidebarBackdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
      });
    }

    function closeMobileSidebar() {
      if (sidebar) sidebar.classList.remove('show');
      if (sidebarBackdrop) sidebarBackdrop.classList.remove('show');
      document.body.style.overflow = '';
    }

    if (sidebarClose) sidebarClose.addEventListener('click', closeMobileSidebar);
    if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeMobileSidebar);
  </script>
  <link rel="stylesheet" href="{{ asset('asset/css/admin-mobile.css') }}?v={{ time() }}">
</body>
</html>
