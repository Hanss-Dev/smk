@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Detail Pesan</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pesan.index') }}">Pesan Masuk</a></li>
            <li class="breadcrumb-item active">Detail</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card card-primary card-outline shadow-sm">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-envelope mr-1"></i> Detail Pesan Dari: {{ $pesan->nama }}</h3>
            </div>

            <div class="card-body">
              <table class="table table-bordered">
                <tr>
                  <th width="180" class="bg-light">Nama Pengirim</th>
                  <td>{{ $pesan->nama }}</td>
                </tr>
                <tr>
                  <th class="bg-light">Alamat Email</th>
                  <td><a href="mailto:{{ $pesan->email }}">{{ $pesan->email }}</a></td>
                </tr>
                <tr>
                  <th class="bg-light">Nomor Telepon</th>
                  <td>{{ $pesan->telepon }}</td>
                </tr>
                <tr>
                  <th class="bg-light">Tanggal Kirim</th>
                  <td>{{ $pesan->tanggal }}</td>
                </tr>
                <tr>
                  <th class="bg-light">Status</th>
                  <td>
                    <span class="badge badge-{{ $pesan->status === 'unread' ? 'danger' : 'success' }}">
                      {{ $pesan->status === 'unread' ? 'Belum Dibaca' : 'Dibaca' }}
                    </span>
                  </td>
                </tr>
                <tr>
                  <th class="bg-light">Isi Pesan</th>
                  <td style="white-space: pre-line; line-height:1.6;">{{ $pesan->pesan }}</td>
                </tr>
              </table>
            </div>

            <div class="card-footer d-flex justify-content-between">
              <a href="{{ route('admin.pesan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesan
              </a>
              <div>
                <button type="button" class="btn btn-primary btn-balas mr-2 shadow-sm"
                        data-id="{{ $pesan->id }}"
                        data-nama="{{ $pesan->nama }}"
                        data-email="{{ $pesan->email }}"
                        data-telepon="{{ $pesan->telepon }}"
                        data-pesan="{{ $pesan->pesan }}">
                  <i class="fas fa-reply mr-1"></i> Balas Pesan
                </button>
                <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" style="display:inline;" class="form-delete" data-confirm-message="Hapus pesan ini?">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger shadow-sm"><i class="fas fa-trash"></i> Hapus Pesan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
