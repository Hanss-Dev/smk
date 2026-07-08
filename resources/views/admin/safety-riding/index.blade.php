@extends('layouts.admin')

@section('title', 'Kelola Safety Riding')

@section('content')
<div class="content-wrapper" data-guide-page="safety-riding-index">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Safety Riding</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Safety Riding</li>
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
          <h3 class="card-title my-1">Daftar Bagian — Safety Riding</h3>
          <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
            <form action="{{ route('admin.safety-riding.index') }}" method="GET" data-guide="index-search" class="form-inline my-1">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Cari bagian..." value="{{ request('search') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                  @if(request('search'))
                    <a href="{{ route('admin.safety-riding.index') }}" class="btn btn-default" title="Reset Pencarian">
                      <i class="fas fa-times"></i>
                    </a>
                  @endif
                </div>
              </div>
            </form>
            <a href="{{ route('admin.safety-riding.create') }}" data-guide="index-add-btn" class="btn btn-primary btn-sm my-1">
              <i class="fas fa-plus"></i> Tambah Bagian
            </a>
          </div>
        </div>

        <div class="card-body table-responsive">
          @include('admin.components.pagination-controls')
          <form action="{{ route('admin.pagesection.bulkDelete', 'safety-riding') }}" method="POST" class="bulk-delete-form">
            @csrf
            @method('DELETE')
            <div class="mb-2 d-flex justify-content-between align-items-center">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input bulk-select-all" id="selectAllSafetyRiding">
                <label class="custom-control-label" for="selectAllSafetyRiding">Pilih semua</label>
              </div>
              <button type="submit" data-guide="index-bulk-delete" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Hapus Pilihan
              </button>
            </div>
            <table class="table table-bordered table-hover" data-guide="index-table">
              <thead class="bg-light">
                <tr>
                  <th width="40"></th>
                  <th width="50">No</th>
                  <th>Nama Bagian</th>
                  <th>Ringkasan Elemen</th>
                  <th width="120">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php $i = ($sections->currentPage() - 1) * $sections->perPage() + 1; @endphp
                @forelse($sections as $sIdx => $section)
                  <tr>
                    <td class="text-center">
                      <input type="checkbox" name="ids[]" value="{{ $sIdx }}" class="bulk-select-row">
                    </td>
                    <td class="text-center">{{ $i++ }}</td>
                    <td>{{ $section['nama'] ?? 'Bagian ' . ($sIdx + 1) }}</td>
                    <td>
                      @php
                        $elemenList = $section['elemen'] ?? [];
                        $types = array_map(function($el) {
                            return strtoupper($el['type'] ?? 'TEXT');
                        }, $elemenList);
                        $typesCount = array_count_values($types);
                        $summary = [];
                        foreach($typesCount as $type => $count) {
                            $summary[] = "$count $type";
                        }
                      @endphp
                      @if(count($elemenList) > 0)
                        <span class="badge badge-info">{{ count($elemenList) }} Elemen</span>
                        <small class="text-muted ml-2">({{ implode(', ', $summary) }})</small>
                      @else
                        <span class="text-muted">-</span>
                      @endif
                    </td>
                    <td class="text-center" @if($sIdx === 0) data-guide="index-row-actions" @endif>
                      <a href="{{ route('admin.safety-riding.edit', ['sIdx' => $sIdx]) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('admin.pagesection.deleteSection', ['key' => 'safety-riding', 'sIdx' => $sIdx]) }}" method="POST" style="display:inline;" class="form-delete" data-confirm-message="Hapus bagian ini beserta semua elemennya?">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada bagian. Klik "Tambah Bagian" untuk mulai.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </form>
        </div>
        <div class="card-footer clearfix">
          <div class="float-right">
            {{ $sections->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
