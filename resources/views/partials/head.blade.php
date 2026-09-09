@php
  $pageTitle = $title ?? 'SMKN 2 Purwakarta Libraries';
  $pageDescription = $description ?? 'Sistem Perpustakaan Digital SMKN 2 Purwakarta: akses koleksi buku, jurnal, dan referensi kurikulum kejuruan untuk mendukung pembelajaran vokasi.';
  $pageImage = $image ?? asset('/favicon.ico');
  $pageRobots = $robots ?? 'index, follow';
  $canonicalUrl = $canonical ?? url()->current();
@endphp
<meta name="description" content="{{ $pageDescription }}">
<meta name="robots" content="{{ $pageRobots }}">
<meta name="theme-color" content="#0c4d2d">
<link rel="canonical" href="{{ $canonicalUrl }}">
<link rel="icon" href="{{ asset('/favicon.ico') }}" sizes="32x32">

<meta property="og:type" content="website">
<meta property="og:site_name" content="SMKN 2 Purwakarta Libraries">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $pageImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
<meta name="twitter:image" content="{{ $pageImage }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"></noscript>