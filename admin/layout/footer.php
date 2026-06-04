<footer class="main-footer text-center">
  <strong>&copy; <?= date('Y') ?> SMK Mitra Industri MM2100</strong>
</footer>

</div> <!-- /.wrapper -->

<!-- ================= ADMINLTE JS ================= -->

<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>

<!-- ================= DRAG & DROP IMAGE ================= -->
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
