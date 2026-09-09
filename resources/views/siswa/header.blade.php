<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') - Librea</title>
  @include('partials.head', [
    'title' => trim($__env->yieldContent('title', 'Dashboard')) . ' - Librea',
    'robots' => 'noindex',
  ])
  <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>