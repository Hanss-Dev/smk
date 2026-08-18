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

  <script>
    // Keeps --header-height-actual in sync with the real, rendered height of
    // the fixed header (which varies by breakpoint/logo size/content) so the
    // page content below it never has a gap or overlap. Runs immediately
    // (not on DOMContentLoaded) so it's set before the page-wrapper below is
    // painted, and stays in sync afterward via ResizeObserver.
    (function () {
      var header = document.querySelector('.header');
      if (!header) return;
      var root = document.documentElement;

      function setHeaderHeightVar() {
        root.style.setProperty('--header-height-actual', header.offsetHeight + 'px');
      }

      setHeaderHeightVar();

      if (window.ResizeObserver) {
        new ResizeObserver(setHeaderHeightVar).observe(header);
      } else {
        window.addEventListener('resize', setHeaderHeightVar);
        window.addEventListener('orientationchange', setHeaderHeightVar);
      }

      window.addEventListener('load', setHeaderHeightVar);
    })();
  </script>

  <div class="{{ request()->routeIs('home') ? '' : 'page-wrapper' }}">
    @yield('content')
  </div>

  @include('components.footer')

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('scripts')
</body>

</html>
