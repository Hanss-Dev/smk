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
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Daftar Popup</h3>
          <a href="{{ route('admin.popup.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Popup
          </a>
        </div>

        <div class="card-body table-responsive">
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
                  <td class="text-center">{{ $i + 1 }}</td>
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
      </div>

    </div>
  </section>
</div>
@endsection
