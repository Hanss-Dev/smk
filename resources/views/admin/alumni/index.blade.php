@extends('layouts.admin')

@section('title', 'Kelola Alumni')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Alumni</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Alumni</li>
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
          <h3 class="card-title my-1">Daftar Alumni</h3>
          <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
            <form action="{{ route('admin.alumni.index') }}" method="GET" class="form-inline my-1">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Cari alumni..." value="{{ request('search') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                  @if(request('search'))
                    <a href="{{ route('admin.alumni.index') }}" class="btn btn-default" title="Reset Pencarian">
                      <i class="fas fa-times"></i>
                    </a>
                  @endif
                </div>
              </div>
            </form>
            <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary btn-sm my-1">
              <i class="fas fa-plus"></i> Tambah Alumni
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
                <th>Nama Siswa</th>
                <th>Alumni Jurusan</th>
                <th>Nama Pekerjaan</th>
                <th width="100">Nama Perusahaan</th>
                <th width="120">Tanggal</th>
                <th width="120">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($alumnilist as $i => $n)
                <tr>
                  <td class="text-center">{{ ($alumnilist->currentPage() - 1) * $alumnilist->perPage() + $i + 1 }}</td>
                    <td>
                    @if($n->image)
                      <img class="preview-image" src="{{ asset('uploads/alumni/' . $n->image) }}" style="height:40px; object-fit:cover; border-radius:4px;">
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td>{{ Str::limit($n->nama_alumni, 60) }}</td>
                  <td>{{ Str::limit($n->jurusan_alumni, 60) }}</td>
                  <td>{{ Str::limit($n->nama_pekerjaan, 60) }}</td>
                  <td><small class="text-muted">{{ $n->nama_perusahaan }}</small></td>
                  <td class="text-center">{{ $n->created_at ? $n->created_at->format('d M Y') : '-' }}</td>
                  <td class="text-center">
                    <a href="{{ route('admin.alumni.edit', $n->id) }}" class="btn btn-warning btn-sm" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.alumni.destroy', $n->id) }}" method="POST" style="display:inline;" class="form-delete" data-confirm-message="Hapus alumni ini?">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="8" class="text-center text-muted">Belum ada data alumni.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer clearfix">
          <div class="float-right">
            {{ $alumnilist->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
