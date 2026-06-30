@extends('layouts.app')

@section('title', $news->title . ' - SMK Mitra Industri MM2100')

@section('content')
<style>
body.nx-body {
  font-family: 'Poppins', sans-serif;
  background: #f4f7fb;
  margin: 0;
  color: #1a1a1a;
}

.nx-container {
  max-width: 900px;
  margin: 60px auto;
  padding: 20px;
}

.nx-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  overflow: hidden;
}

/* ===== IMAGE ===== */
.nx-image img {
  width: 100%;
  height: 400px;
  object-fit: cover;
}

/* ===== CONTENT ===== */
.nx-content {
  padding: 30px;
}

/* ===== TITLE ===== */
.nx-title {
  font-size: 28px;
  font-weight: 600;
  margin-bottom: 10px;
  line-height: 1.4;
  color: #333;
}

/* ===== META ===== */
.nx-meta {
  font-size: 14px;
  color: #888;
  margin-bottom: 20px;
}

/* ===== CONTENT TEXT ===== */
.nx-text {
  line-height: 1.8;
  font-size: 16px;
  color: #333;
}

.nx-text p {
  margin-bottom: 16px;
}

.nx-tags {
  margin-top: 25px;
}

.nx-tag {
  display: inline-block;
  background: #e8f0ff;
  color: #2a5bd7;
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 13px;
  margin: 4px;
  text-decoration: none;
}

.nx-back {
  display: inline-block;
  margin-top: 30px;
  text-decoration: none;
  background: #041d54;
  color: #fff;
  padding: 10px 18px;
  border-radius: 8px;
  transition: 0.3s;
}

.nx-back:hover {
  background: #0a2c7d;
}

@media (max-width: 600px) {
  .nx-title {
    font-size: 22px;
  }

  .nx-image img {
    height: 250px;
  }
}
</style>

<div class="nx-container">
  <div class="nx-card">
    @if ($news->thumbnail)
      <div class="nx-image">
        <img src="{{ asset('storage/news/' . $news->thumbnail) }}" alt="{{ $news->title }}">
      </div>
    @endif

    <div class="nx-content">
      <h1 class="nx-title">
        {{ $news->title }}
      </h1>

      <div class="nx-meta">
        📅 {{ $news->created_at ? $news->created_at->format('d F Y') : '' }}
      </div>

      <div class="nx-text">
        {!! $news->content !!}
      </div>

      <a href="{{ route('home') }}#berita" class="nx-back">← Kembali</a>
    </div>
  </div>
</div>
@endsection
