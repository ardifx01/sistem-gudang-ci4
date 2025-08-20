<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="#">Gudang App</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/chart.js/Chart.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/sparklines/sparkline.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/dist/js/adminlte.js'); ?>"></script>
<script src="<?= base_url('adminlte/dist/js/demo.js'); ?>"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url('adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/jszip/jszip.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>


<?= $this->renderSection('scripts') ?>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
  $(function () {
    $("#example2").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>