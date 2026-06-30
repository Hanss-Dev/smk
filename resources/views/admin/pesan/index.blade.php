@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Pesan Masuk</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pesan Masuk</li>
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
          <h3 class="card-title my-1">Daftar Pesan Hubungi Kami</h3>
          <div class="card-tools my-1">
            <form action="{{ route('admin.pesan.index') }}" method="GET" class="form-inline">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Cari pesan..." value="{{ request('search') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                  @if(request('search'))
                    <a href="{{ route('admin.pesan.index') }}" class="btn btn-default" title="Reset Pencarian">
                      <i class="fas fa-times"></i>
                    </a>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="card-body table-responsive">
          @include('admin.components.pagination-controls')
          <table class="table table-bordered table-hover">
            <thead class="bg-light">
              <tr>
                <th width="50">No</th>
                <th>Nama Pengirim</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Cuplikan Pesan</th>
                <th width="100">Status</th>
                <th width="120">Tanggal</th>
                <th width="120">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pesanList as $i => $p)
                <tr class="{{ $p->status === 'unread' ? 'font-weight-bold table-warning' : '' }}">
                  <td class="text-center">{{ ($pesanList->currentPage() - 1) * $pesanList->perPage() + $i + 1 }}</td>
                  <td>{{ $p->nama }}</td>
                  <td>{{ $p->email }}</td>
                  <td>{{ $p->telepon }}</td>
                  <td>{{ Str::limit($p->pesan, 60) }}</td>
                  <td class="text-center">
                    <span class="badge badge-{{ $p->status === 'unread' ? 'danger' : 'success' }}">
                      {{ $p->status === 'unread' ? 'Belum Dibaca' : 'Dibaca' }}
                    </span>
                  </td>
                  <td class="text-center">{{ $p->tanggal }}</td>
                  <td class="text-center">
                    <a href="{{ route('admin.pesan.show', $p->id) }}" class="btn btn-info btn-sm shadow-sm" title="Detail / Baca">
                      <i class="fas fa-envelope-open-text"></i> Baca
                    </a>
                    <button type="button" class="btn btn-primary btn-sm btn-balas shadow-sm" 
                            data-id="{{ $p->id }}" 
                            data-nama="{{ $p->nama }}" 
                            data-email="{{ $p->email }}" 
                            data-telepon="{{ $p->telepon }}"
                            data-pesan="{{ $p->pesan }}"
                            title="Balas">
                      <i class="fas fa-reply"></i> Balas
                    </button>
                    <form action="{{ route('admin.pesan.destroy', $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pesan ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm shadow-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="8" class="text-center text-muted">Belum ada pesan masuk.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer clearfix">
          <div class="float-right">
            {{ $pesanList->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
