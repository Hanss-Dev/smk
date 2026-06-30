@extends('layouts.admin')

@section('title', 'Kelola Podcast')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Podcast</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Podcast</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
      @endif

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
          <h3 class="card-title mb-0">Daftar Bagian — Podcast</h3>
          <div class="d-flex align-items-center" style="gap: 8px;">
            <!-- Search Box -->
            <div class="input-group input-group-sm" style="width: 240px;">
              <input type="text" id="searchSection" class="form-control"
                     placeholder="Cari nama bagian..." autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
            </div>
            <a href="{{ route('admin.podcast.create') }}" class="btn btn-primary btn-sm">
              <i class="fas fa-plus"></i> Tambah Bagian
            </a>
          </div>
        </div>

        <div class="card-body">
          @php $sections = $page->content ?? []; @endphp

          @if(count($sections) === 0)
            <p class="text-muted text-center py-3">Belum ada bagian. Klik "Tambah Bagian" untuk mulai.</p>
          @else
            <div id="sectionsContainer">
              @foreach($sections as $sIdx => $section)
                <div class="card card-outline card-primary mb-3 section-card"
                     data-name="{{ strtolower($section['nama'] ?? 'bagian ' . ($sIdx + 1)) }}">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                      <i class="fas fa-layer-group mr-1 text-primary"></i>
                      {{ $section['nama'] ?? 'Bagian ' . ($sIdx + 1) }}
                      <span class="badge badge-light ml-2">{{ count($section['elemen'] ?? []) }} elemen</span>
                    </h5>
                    <div>
                      <a href="{{ route('admin.podcast.edit', ['sIdx' => $sIdx]) }}"
                         class="btn btn-warning btn-sm" title="Edit bagian ini">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('admin.pagesection.deleteSection', ['key' => 'podcast', 'sIdx' => $sIdx]) }}"
                            method="POST" style="display:inline;"
                            class="form-delete" data-confirm-message="Hapus bagian ini beserta semua elemennya?">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" title="Hapus bagian">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </div>

                  <div class="card-body py-2">
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered mb-0">
                        <thead class="bg-light">
                          <tr>
                            <th width="40">#</th>
                            <th width="80">Tipe</th>
                            <th>Preview / Nilai</th>
                            <th width="80">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($section['elemen'] ?? [] as $eIdx => $el)
                            <tr>
                              <td class="text-center">{{ $eIdx + 1 }}</td>
                              <td>
                                <span class="badge
                                  @if($el['type'] === 'image') badge-success
                                  @elseif($el['type'] === 'link') badge-info
                                  @else badge-secondary @endif">
                                  {{ strtoupper($el['type']) }}
                                </span>
                              </td>
                              <td>
                                @if($el['type'] === 'image')
                                  <img src="{{ asset('uploads/podcast/' . $el['value']) }}"
                                       style="height:40px; object-fit:cover; border-radius:4px;" class="mr-2">
                                  <small class="text-muted">{{ $el['alt'] ?? '' }}</small>
                                @elseif($el['type'] === 'link')
                                  <a href="{{ $el['value'] }}" target="_blank">{{ $el['label'] ?? $el['value'] }}</a>
                                @else
                                  {{ Str::limit($el['value'] ?? '', 100) }}
                                @endif
                              </td>
                              <td class="text-center">
                                <form action="{{ route('admin.pagesection.deleteElement', ['key' => 'podcast', 'sIdx' => $sIdx, 'eIdx' => $eIdx]) }}"
                                      method="POST" style="display:inline;"
                                      class="form-delete" data-confirm-message="Hapus elemen ini?{{ $el['type'] === 'image' ? ' Gambar juga akan dihapus dari server.' : '' }}">
                                  @csrf @method('DELETE')
                                  <button class="btn btn-danger btn-xs" title="Hapus elemen">
                                    <i class="fas fa-times"></i>
                                  </button>
                                </form>
                              </td>
                            </tr>
                          @empty
                            <tr><td colspan="4" class="text-center text-muted">Tidak ada elemen.</td></tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              @endforeach

              <!-- Empty search result message -->
              <div id="noSearchResult" class="text-center text-muted py-4" style="display:none;">
                <i class="fas fa-search fa-2x mb-2"></i>
                <p>Tidak ada bagian yang cocok dengan pencarian.</p>
              </div>
            </div>
          @endif
        </div>
      </div>

    </div>
  </section>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('searchSection')?.addEventListener('input', function () {
    const keyword = this.value.toLowerCase().trim();
    const cards   = document.querySelectorAll('.section-card');
    let   visible = 0;

    cards.forEach(card => {
      const name = card.dataset.name || '';
      if (!keyword || name.includes(keyword)) {
        card.style.display = '';
        visible++;
      } else {
        card.style.display = 'none';
      }
    });

    const noResult = document.getElementById('noSearchResult');
    if (noResult) noResult.style.display = visible === 0 ? 'block' : 'none';
  });
</script>
@endpush
