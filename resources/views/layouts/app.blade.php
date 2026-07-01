<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/berita.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/profil.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tentang-kami.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/kontak.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/ppdb.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/skill.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vision-mission.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jurusan1.css') }}">

  <meta name="description" content="Website resmi SMK Mitra Industri MM2100 - Program Keahlian dan Kompetensi Industri">
  <link rel="icon" href="{{ asset('assets/img/logo-mt.png') }}" type="image/png">
  <title>@yield('title', 'SMK Mitra Industri MM2100')</title>
</head>

<body>
  @include('components.header')

  <div class="{{ request()->routeIs('home') ? '' : 'page-wrapper' }}">
    @yield('content')
  </div>

  @include('components.footer')

  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('scripts')
</body>

</html>
