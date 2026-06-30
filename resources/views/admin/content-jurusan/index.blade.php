@extends('layouts.admin')

@section('title', 'Kelola Content Jurusan')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Content Jurusan</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Content Jurusan</li>
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
          <h3 class="card-title">Daftar Content Jurusan</h3>
          <a href="{{ route('admin.content-jurusan.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Content
          </a>
        </div>

        <div class="card-body table-responsive">
          @include('admin.components.pagination-controls')
          <table class="table table-bordered table-hover">
            <thead class="bg-light">
              <tr>
                <th width="50">No</th>
                <th>Jurusan</th>
                <th width="140" class="text-center">Jumlah Gambar</th>
                <th width="150" class="text-center">Tanggal Dibuat</th>
                <th width="120" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($contents as $i => $c)
                @php
                  $images = is_string($c->content)
                    ? json_decode($c->content, true)
                    : ($c->content ?? []);
                @endphp
                <tr>
                  <td class="text-center">{{ ($contents->currentPage() - 1) * $contents->perPage() + $i + 1 }}</td>
                  <td>{{ $c->jurusan }}</td>
                  <td class="text-center">
                    <span class="badge badge-info">{{ count($images) }} gambar</span>
                  </td>
                  <td class="text-center">
                    {{ $c->created_at ? $c->created_at->format('d M Y') : '-' }}
                  </td>
                  <td class="text-center">
                    <a href="{{ route('admin.content-jurusan.edit', $c->id) }}"
                       class="btn btn-warning btn-sm"
                       title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.content-jurusan.destroy', $c->id) }}"
                          method="POST"
                          style="display:inline;"
                          onsubmit="return confirm('Hapus content jurusan ini beserta semua gambarnya?')">
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
                  <td colspan="5" class="text-center text-muted">Belum ada data content jurusan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer clearfix">
          <div class="float-right">
            {{ $contents->appends(['per_page' => request('per_page')])->links() }}
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection