{{--
  Partial: _elemen_builder.blade.php
  Letakkan di: resources/views/admin/_partials/_elemen_builder.blade.php

  Variabel yang harus di-pass:
    $sectionIndex  (int|null)  — null = create baru, angka = edit section tertentu
    $existingElemen (array)    — elemen yang sudah ada (untuk mode edit)
    $folder         (string)   — 'podcast' | 'lab-komputer' | 'safety-riding'

--}}

@php
  $existingElemen = $existingElemen ?? [];
@endphp

<div id="elemen-list">
  @forelse($existingElemen as $ei => $el)
    <div class="elemen-item card card-outline card-secondary mb-2" data-index="{{ $ei }}">
      <div class="card-header py-2 d-flex align-items-center justify-content-between">
        <span class="badge badge-secondary mr-2">{{ strtoupper($el['type']) }}</span>
        <span class="elemen-label text-sm">
          @if($el['type'] === 'text')   {{ Str::limit($el['value'] ?? '', 60) }}
          @elseif($el['type'] === 'image') {{ $el['alt'] ?? $el['value'] ?? '' }}
          @else {{ $el['label'] ?? $el['value'] ?? '' }}
          @endif
        </span>
        <button type="button" class="btn btn-danger btn-xs ml-auto remove-elemen">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="card-body py-2">
        <input type="hidden" name="elemen_type[{{ $ei }}]" value="{{ $el['type'] }}">

        @if($el['type'] === 'text')
          <textarea name="elemen_value[{{ $ei }}]" rows="2"
            class="form-control form-control-sm">{{ $el['value'] ?? '' }}</textarea>

        @elseif($el['type'] === 'image')
          <input type="hidden" name="elemen_existing[{{ $ei }}]" value="{{ $el['value'] ?? '' }}">
          @if(!empty($el['value']))
            <img src="{{ asset($folder . '/' . $el['value']) }}"
                 class="img-thumbnail mb-2" style="max-height:100px;">
          @endif
          <div class="form-group mb-1">
            <label class="text-xs">Ganti Gambar (opsional)</label>
            <input type="file" name="elemen_file[{{ $ei }}]" accept="image/*" class="form-control-file form-control-sm">
          </div>
          <div class="form-group mb-0">
            <label class="text-xs">Alt Text</label>
            <input type="text" name="elemen_alt[{{ $ei }}]" value="{{ $el['alt'] ?? '' }}"
                   class="form-control form-control-sm" placeholder="Deskripsi gambar">
          </div>

        @elseif($el['type'] === 'link')
          <div class="form-group mb-1">
            <label class="text-xs">URL</label>
            <input type="text" name="elemen_value[{{ $ei }}]" value="{{ $el['value'] ?? '' }}"
                   class="form-control form-control-sm" placeholder="https://...">
          </div>
          <div class="form-group mb-0">
            <label class="text-xs">Label Link</label>
            <input type="text" name="elemen_label[{{ $ei }}]" value="{{ $el['label'] ?? '' }}"
                   class="form-control form-control-sm" placeholder="Teks yang tampil">
          </div>
        @endif
      </div>
    </div>
  @empty
  @endforelse
</div>

<!-- Tombol tambah elemen baru -->
<div class="mt-2 mb-3">
  <button type="button" class="btn btn-outline-secondary btn-sm mr-1" data-add-elemen="text">
    <i class="fas fa-font mr-1"></i>+ Text
  </button>
  <button type="button" class="btn btn-outline-secondary btn-sm mr-1" data-add-elemen="image">
    <i class="fas fa-image mr-1"></i>+ Gambar
  </button>
  <button type="button" class="btn btn-outline-secondary btn-sm" data-add-elemen="link">
    <i class="fas fa-link mr-1"></i>+ Link
  </button>
</div>

