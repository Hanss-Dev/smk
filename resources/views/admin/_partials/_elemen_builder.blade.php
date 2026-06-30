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
  <button type="button" class="btn btn-outline-secondary btn-sm mr-1" onclick="addElemen('text')">
    <i class="fas fa-font mr-1"></i>+ Text
  </button>
  <button type="button" class="btn btn-outline-secondary btn-sm mr-1" onclick="addElemen('image')">
    <i class="fas fa-image mr-1"></i>+ Gambar
  </button>
  <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addElemen('link')">
    <i class="fas fa-link mr-1"></i>+ Link
  </button>
</div>

@push('scripts')
<script>
(function () {
  // Hitung index elemen berikutnya
  function nextIndex() {
    return document.querySelectorAll('#elemen-list .elemen-item').length;
  }

  window.addElemen = function (type) {
    const i    = nextIndex();
    const list = document.getElementById('elemen-list');
    let inner  = '';

    if (type === 'text') {
      inner = `
        <input type="hidden" name="elemen_type[${i}]" value="text">
        <textarea name="elemen_value[${i}]" rows="2" class="form-control form-control-sm" placeholder="Isi teks..."></textarea>`;
    } else if (type === 'image') {
      inner = `
        <input type="hidden" name="elemen_type[${i}]" value="image">
        <input type="hidden" name="elemen_existing[${i}]" value="">
        <div class="form-group mb-1">
          <label class="text-xs">Upload Gambar <span class="text-danger">*</span></label>
          <input type="file" name="elemen_file[${i}]" accept="image/*" class="form-control-file form-control-sm">
        </div>
        <div class="form-group mb-0">
          <label class="text-xs">Alt Text</label>
          <input type="text" name="elemen_alt[${i}]" class="form-control form-control-sm" placeholder="Deskripsi gambar">
        </div>`;
    } else if (type === 'link') {
      inner = `
        <input type="hidden" name="elemen_type[${i}]" value="link">
        <div class="form-group mb-1">
          <label class="text-xs">URL</label>
          <input type="text" name="elemen_value[${i}]" class="form-control form-control-sm" placeholder="https://...">
        </div>
        <div class="form-group mb-0">
          <label class="text-xs">Label Link</label>
          <input type="text" name="elemen_label[${i}]" class="form-control form-control-sm" placeholder="Teks yang tampil">
        </div>`;
    }

    const labelMap = { text: 'TEXT', image: 'IMAGE', link: 'LINK' };
    const div = document.createElement('div');
    div.className = 'elemen-item card card-outline card-secondary mb-2';
    div.dataset.index = i;
    div.innerHTML = `
      <div class="card-header py-2 d-flex align-items-center justify-content-between">
        <span class="badge badge-secondary mr-2">${labelMap[type]}</span>
        <span class="elemen-label text-sm text-muted">Elemen baru</span>
        <button type="button" class="btn btn-danger btn-xs ml-auto remove-elemen">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="card-body py-2">${inner}</div>`;

    list.appendChild(div);
    reindex();
  };

  // Hapus elemen dari DOM (bukan dari DB — untuk elemen baru / mode edit tanpa AJAX)
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.remove-elemen');
    if (!btn) return;
    confirmAction('Hapus elemen ini?', function() {
      btn.closest('.elemen-item').remove();
      reindex();
    });
  });

  // Re-index semua name[] supaya urut 0,1,2,...
  function reindex() {
    const items = document.querySelectorAll('#elemen-list .elemen-item');
    items.forEach((item, newIdx) => {
      item.dataset.index = newIdx;
      item.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, `[${newIdx}]`);
      });
    });
  }
})();
</script>
@endpush
