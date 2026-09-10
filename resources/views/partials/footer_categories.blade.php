@php
  $footerCategories ??= \App\Models\Category::orderBy('name', 'asc')->take(4)->get();
@endphp
@foreach($footerCategories as $footerCat)
  <li><a href="{{ url('/collections?category=' . urlencode($footerCat->name)) }}">{{ $footerCat->name }}</a></li>
@endforeach