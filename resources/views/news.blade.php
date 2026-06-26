@extends('layouts.app')

@section('title', 'Berita & Artikel - SMK Mitra Industri MM2100')

@section('content')
<section class="breadcrumbs">
  <div class="breadcrumbs-bg" style="background-image:url('https://smkind-mm2100.sch.id/wp-content/uploads/2025/03/WhatsApp-Image-2025-03-21-at-13.39.29.jpeg')">
    <div class="overlayy"></div>
    <div class="container">
      <h1 class="page-title">Berita & Artikel</h1>
      <div class="breadcrumbs-nav">
        <a href="{{ route('home') }}">SMK Mitra Industri MM2100</a>
        <span>&gt;</span>
        <span class="current">Berita & Artikel</span>
      </div>
    </div>
  </div>
</section>

<section id="berita" style="padding: 60px 0;">
  <div class="berita-container">
    <div class="berita-header text-center" style="margin-bottom: 40px;">
      <h2>Berita SMK Mitra Industri MM2100</h2>
      <div class="berita-divider" style="margin: 10px auto;"></div>
    </div>

    <div class="berita-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px; margin-bottom: 30px;">
      @forelse ($newsList as $n)
        <div class="berita-card" style="box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; background: #fff; display: flex; flex-direction: column;">
          <div class="berita-image" style="height: 200px; overflow: hidden;">
            @if ($n->thumbnail)
              <img src="{{ asset('uploads/news/' . $n->thumbnail) }}" alt="{{ $n->title }}" style="width: 100%; height: 100%; object-fit: cover;">
            @endif
          </div>
          <div class="berita-content" style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <div class="berita-date" style="font-size: 13px; color: #888; margin-bottom: 10px;">
                {{ $n->created_at ? $n->created_at->format('d F Y') : '' }}
              </div>
              <h3 style="font-size: 18px; line-height: 1.4; margin-bottom: 10px; font-weight: 600;">
                <a href="{{ route('news.show', $n->slug) }}" style="color: #333; text-decoration: none;">
                  {{ $n->title }}
                </a>
              </h3>
              <p class="berita-desc" style="font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 15px;">
                {{ Str::limit(strip_tags($n->content), 120) }}...
              </p>
            </div>
            <a href="{{ route('news.show', $n->slug) }}" class="berita-btn" style="display: inline-block; padding: 8px 16px; background: #041d54; color: #fff; text-decoration: none; border-radius: 4px; font-size: 13px; font-weight: 600; text-align: center;">
              Baca Selengkapnya
            </a>
          </div>
        </div>
      @empty
        <p class="text-center" style="grid-column: 1/-1; color: #888;">Belum ada berita.</p>
      @endforelse
    </div>

    <div style="margin-top: 30px;">
      {{ $newsList->links() }}
    </div>
  </div>
</section>
@endsection
