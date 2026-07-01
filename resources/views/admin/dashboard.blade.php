@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">

  <style>
    /* Dashboard small-box tidy and responsive */
    .dashboard-cards .small-box { display:flex; flex-direction:column; justify-content:space-between; min-height:120px; }
    .dashboard-cards .small-box .inner { padding: 15px; }
    .dashboard-cards .small-box .icon { top:10px; right:10px; }
    .list-group-item .badge { text-transform:capitalize; }
    /* Quick stats layout */
    .quick-stats { display:flex; gap:12px; flex-wrap:wrap; }
    .stat-item { background: #fff; border:1px solid #e9ecef; border-radius:6px; padding:12px; flex:1 1 140px; display:flex; align-items:center; gap:12px; min-width:140px; }
    .stat-item .stat-icon { font-size:28px; color:#6c757d; width:48px; height:48px; display:flex; align-items:center; justify-content:center; border-radius:6px; background:#f8f9fa; }
    .stat-item .stat-body { flex:1; }
    .stat-item .stat-num { font-size:20px; font-weight:700; }
    .stat-item .stat-label { font-size:13px; color:#6c757d; }
    @media (min-width:1200px) {
      .dashboard-cards .small-box { min-height:130px; }
    }
    @media (max-width:575px) {
      .dashboard-cards .small-box { min-height:100px; }
    }
    .recent-news a { color: inherit; text-decoration: none; }
  </style>

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
        <div class="col-lg-3 col-6 dashboard-cards">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{ $totalAlumni }}</h3>
              <p>Alumni</p>
            </div>
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
            <a href="{{ route('admin.alumni.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6 dashboard-cards">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{ $totalContentJurusan }}</h3>
              <p>Konten Jurusan</p>
            </div>
            <div class="icon"><i class="fas fa-book"></i></div>
            <a href="{{ route('admin.content-jurusan.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6 dashboard-cards">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalKeungulan }}</h3>
              <p>Keunggulan</p>
            </div>
            <div class="icon"><i class="fas fa-award"></i></div>
            <a href="{{ route('admin.keungulan.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6 dashboard-cards">
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
        <div class="col-lg-3 col-6 dashboard-cards">
          <div class="small-box bg-dark">
            <div class="inner">
              <h3>{{ $totalPageSection }}</h3>
              <p>Bagian Halaman (Podcast)</p>
            </div>
            <div class="icon"><i class="fas fa-th-large"></i></div>
            <a href="{{ route('admin.podcast.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6 dashboard-cards">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{ $totalAdminUser }}</h3>
              <p>Pengguna Admin</p>
            </div>
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Quick Statistics</h3>
            </div>
            <div class="card-body">
              <div class="quick-stats">
                <div class="stat-item">
                  <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                  <div class="stat-body">
                    <div class="stat-num">{{ $publishPercent }}%</div>
                    <div class="stat-label">Persentase Berita Terbit ({{ $publishNews }}/{{ $totalNews }})</div>
                  </div>
                </div>

                <div class="stat-item">
                  <div class="stat-icon"><i class="fas fa-envelope-open-text"></i></div>
                  <div class="stat-body">
                    <div class="stat-num">{{ $unreadPesan }}</div>
                    <div class="stat-label">Pesan Belum Dibaca</div>
                  </div>
                </div>

                <div class="stat-item">
                  <div class="stat-icon"><i class="fas fa-users"></i></div>
                  <div class="stat-body">
                    <div class="stat-num">{{ $totalUser }}</div>
                    <div class="stat-label">Total Pengguna Terdaftar</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card card-outline">
            <div class="card-header">
              <h3 class="card-title">Berita Terbaru</h3>
            </div>
            <div class="card-body p-0">
              <ul class="list-group list-group-flush">
                @foreach($latestNews as $n)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                      <a class="recent-news" href="{{ route('admin.news.edit', $n->id) }}">{{ \Illuminate\Support\Str::limit($n->title, 70) }}</a>
                      <div class="text-muted small">{{ $n->created_at->format('Y-m-d') }}</div>
                    </div>
                    <span class="badge badge-{{ $n->status === 'publish' ? 'success' : 'secondary' }}">{{ $n->status === 'publish' ? 'Terbit' : 'Draft' }}</span>
                  </li>
                @endforeach
                @if($latestNews->isEmpty())
                  <li class="list-group-item">Belum ada berita.</li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-3">
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
