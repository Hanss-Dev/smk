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
        <div class="card-header">
          <h3 class="card-title">Daftar Pesan Hubungi Kami</h3>
        </div>

        <div class="card-body table-responsive">
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
                  <td class="text-center">{{ $i + 1 }}</td>
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
                    <a href="{{ route('admin.pesan.show', $p->id) }}" class="btn btn-info btn-sm" title="Detail / Baca">
                      <i class="fas fa-envelope-open-text"></i> Baca
                    </a>
                    <form action="{{ route('admin.pesan.destroy', $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pesan ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="8" class="text-center text-muted">Belum ada pesan masuk.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
