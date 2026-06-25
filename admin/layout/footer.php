<footer class="main-footer text-center">
  <strong>&copy; <?= date('Y') ?> SMK Mitra Industri MM2100</strong>
</footer>

</div>

<script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="../assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/adminlte/dist/js/adminlte.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
const dz = document.getElementById('dropzone');

if (dz) {
  const input   = document.getElementById('fileInput');
  const preview = document.getElementById('previewImage');

  dz.addEventListener('click', () => input.click());

  dz.addEventListener('dragover', e => {
    e.preventDefault();
    dz.classList.add('dragover');
  });

  dz.addEventListener('dragleave', () => {
    dz.classList.remove('dragover');
  });

  dz.addEventListener('drop', e => {
    e.preventDefault();
    dz.classList.remove('dragover');
    input.files = e.dataTransfer.files;
    showPreview();
  });

  input.addEventListener('change', showPreview);

  function showPreview() {
    const file = input.files[0];
    if (!file) return;

    preview.src = URL.createObjectURL(file);
    preview.classList.remove('d-none');
  }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</body>
</html>
