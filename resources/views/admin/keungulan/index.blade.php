@extends('layouts.admin')

@section('title', 'Kelola Keunggulan')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Keunggulan</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Keunggulan</li>
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
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h3 class="card-title mb-0">Daftar Keunggulan</h3>
            <div class="d-flex align-items-center" style="gap: .5rem;">
              {{-- Search --}}
              <form action="{{ route('admin.keungulan.index') }}" method="GET" class="d-flex" style="gap:.4rem;">
                @if(request('per_page'))
                  <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                @endif
                <div class="input-group input-group-sm" style="width:240px;">
                  <input type="text" name="search" class="form-control"
                         placeholder="Cari nama keunggulan..."
                         value="{{ $search ?? '' }}">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    @if($search)
                      <a href="{{ route('admin.keungulan.index') }}" class="btn btn-outline-danger">
                        <i class="fas fa-times"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </form>
              <a href="{{ route('admin.keungulan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah
              </a>
            </div>
          </div>
        </div>

        <div class="card-body table-responsive">
          @include('admin.components.pagination-controls')

          <table class="table table-bordered table-hover">
            <thead class="bg-light">
              <tr>
                <th width="50">No</th>
                <th width="100">Gambar</th>
                <th>Nama Keunggulan</th>
                <th>Alt Text</th>
                <th width="90" class="text-center">Status</th>
                <th width="120" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($keunggulan as $i => $item)
                <tr>
                  <td class="text-center">
                    {{ ($keunggulan->currentPage() - 1) * $keunggulan->perPage() + $i + 1 }}
                  </td>
                  <td class="text-center">
                    @if($item->image)
                      <img src="{{ asset('uploads/keungulan/' . $item->image) }}"
                           alt="{{ $item->alt ?? $item->nama_keunggulan }}"
                           style="height:44px; width:64px; object-fit:cover; border-radius:4px; border:1px solid #dee2e6;">
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td>{{ Str::limit($item->nama_keunggulan, 80) }}</td>
                  <td><small class="text-muted">{{ Str::limit($item->alt, 60) ?: '-' }}</small></td>
                  <td class="text-center">
                    @if($item->is_active)
                      <span class="badge badge-success">Aktif</span>
                    @else
                      <span class="badge badge-secondary">Nonaktif</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="{{ route('admin.keungulan.edit', $item->id) }}"
                       class="btn btn-warning btn-sm" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.keungulan.destroy', $item->id) }}" method="POST"
                          style="display:inline;"
                          onsubmit="return confirm('Hapus keunggulan ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" title="Hapus">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-4">
                    @if($search)
                      Tidak ada keunggulan yang cocok dengan pencarian <strong>"{{ $search }}"</strong>.
                    @else
                      Belum ada data keunggulan.
                    @endif
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="card-footer clearfix">
          <div class="float-right">
            {{ $keunggulan->appends(request()->except('page'))->links() }}
          </div>
          <div class="float-left text-muted" style="font-size:.875rem; line-height:2.2;">
            Total: {{ $keunggulan->total() }} data
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
