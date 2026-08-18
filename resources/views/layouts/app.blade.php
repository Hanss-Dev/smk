<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  @vite([
    'resources/css/style.css',
    'resources/css/berita.css',
    'resources/css/profil.css',
    'resources/css/tentang-kami.css',
    'resources/css/kontak.css',
    'resources/css/ppdb.css',
    'resources/css/skill.css',
    'resources/css/vision-mission.css',
    'resources/css/jurusan1.css',
    'resources/css/podcast.css',
    'resources/css/lab.css',
    'resources/css/safety.css',
    'resources/js/main.js'
  ])

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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('scripts')
</body>

</html>
