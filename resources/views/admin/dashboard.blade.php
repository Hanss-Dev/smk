@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <h1>Dashboard</h1>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      {{-- Flash --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
      @endif

      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalNews }}</h3>
              <p>Total Berita</p>
            </div>
            <div class="icon"><i class="fas fa-newspaper"></i></div>
            <a href="{{ route('admin.news.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $publishNews }}</h3>
              <p>Berita Publish</p>
            </div>
            <div class="icon"><i class="fas fa-check"></i></div>
            <a href="{{ route('admin.news.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalHighlight }}</h3>
              <p>Highlight</p>
            </div>
            <div class="icon"><i class="fas fa-star"></i></div>
            <a href="{{ route('admin.highlight.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $totalPopup }}</h3>
              <p>Popup</p>
            </div>
            <div class="icon"><i class="fas fa-bullhorn"></i></div>
            <a href="{{ route('admin.popup.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{ $totalAlumni }}</h3>
              <p>Alumni</p>
            </div>
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
            <a href="{{ route('admin.alumni.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{ $totalContentJurusan }}</h3>
              <p>Content Jurusan</p>
            </div>
            <div class="icon"><i class="fas fa-book"></i></div>
            <a href="{{ route('admin.content-jurusan.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalKeungulan }}</h3>
              <p>Keunggulan</p>
            </div>
            <div class="icon"><i class="fas fa-award"></i></div>
            <a href="{{ route('admin.keungulan.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalPesan }}</h3>
              <p>Pesan</p>
            </div>
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <a href="{{ route('admin.pesan.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-dark">
            <div class="inner">
              <h3>{{ $totalPageSection }}</h3>
              <p>Page Sections (Podcast)</p>
            </div>
            <div class="icon"><i class="fas fa-th-large"></i></div>
            <a href="{{ route('admin.podcast.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{ $totalAdminUser }}</h3>
              <p>Admin Users</p>
            </div>
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Statistik Konten</h3>
            </div>
            <div class="card-body">
              <canvas id="contentChart" height="120"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Status Berita</h3>
            </div>
            <div class="card-body">
              <canvas id="newsChart"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const contentCtx = document.getElementById('contentChart').getContext('2d');
new Chart(contentCtx, {
  type: 'bar',
  data: {
    labels: ['Berita', 'Highlight', 'Popup'],
    datasets: [{
      label: 'Jumlah',
      data: [{{ $totalNews }}, {{ $totalHighlight }}, {{ $totalPopup }}],
      backgroundColor: ['#3490dc', '#f6c23e', '#e3342f']
    }]
  },
  options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

const newsCtx = document.getElementById('newsChart').getContext('2d');
new Chart(newsCtx, {
  type: 'doughnut',
  data: {
    labels: ['Publish', 'Draft'],
    datasets: [{
      data: [{{ $publishNews }}, {{ $draftNews }}],
      backgroundColor: ['#28a745', '#ffc107']
    }]
  }
});
</script>
@endsection
