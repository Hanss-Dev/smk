@extends('layouts.admin')

@section('title', 'Kelola Popup')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Popup</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Popup</li>
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
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
          <h3 class="card-title my-1">Daftar Popup</h3>
          <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
            <form action="{{ route('admin.popup.index') }}" method="GET" class="form-inline my-1">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Cari popup..." value="{{ request('search') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                  @if(request('search'))
                    <a href="{{ route('admin.popup.index') }}" class="btn btn-default" title="Reset Pencarian">
                      <i class="fas fa-times"></i>
                    </a>
                  @endif
                </div>
              </div>
            </form>
            <a href="{{ route('admin.popup.create') }}" class="btn btn-primary btn-sm my-1">
              <i class="fas fa-plus"></i> Tambah Popup
            </a>
          </div>
        </div>

        <div class="card-body table-responsive">
          @include('admin.components.pagination-controls')
          <table class="table table-bordered table-hover">
            <thead class="bg-light">
              <tr>
                <th width="50">No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Konten</th>
                <th width="100">Status</th>
                <th width="120">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($popups as $i => $p)
                <tr>
                  <td class="text-center">{{ ($popups->currentPage() - 1) * $popups->perPage() + $i + 1 }}</td>
                  <td>
                    @if($p->image)
                      <img src="{{ asset('uploads/popup/' . $p->image) }}" style="height:50px; object-fit:cover; border-radius:4px;">
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td>{{ $p->title }}</td>
                  <td>{{ Str::limit($p->content, 80) }}</td>
                  <td class="text-center">
                    <span class="badge badge-{{ $p->is_active ? 'success' : 'secondary' }}">
                      {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                  </td>
                  <td class="text-center">
                    <a href="{{ route('admin.popup.edit', $p->id) }}" class="btn btn-warning btn-sm" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.popup.destroy', $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus popup ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="text-center text-muted">Belum ada popup.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer clearfix">
          <div class="float-right">
            {{ $popups->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
