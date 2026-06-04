<div class="form-group">
  <label><?= $label ?? 'Gambar' ?></label>

  <div class="ega-dropzone" id="dropzone">
    <input type="file"
           name="<?= $name ?? 'image' ?>"
           id="fileInput"
           accept="image/*"
           hidden>

    <div class="ega-dropzone-inner">
      <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
      <p>Drag & drop gambar di sini<br>atau klik untuk pilih</p>
    </div>

    <img id="previewImage"
         class="img-fluid rounded d-none mt-3"
         style="max-height:220px">
  </div>

  <?php if (!empty($oldImage)): ?>
    <small class="text-muted d-block mt-2">
      Gambar saat ini:
    </small>
    <img src="<?= $oldImage ?>"
         class="img-thumbnail mt-1"
         style="max-height:120px">
  <?php endif; ?>
</div>
