            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.1
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        
        <!-- jQuery UI 1.11.4 -->
        <script src="<?=base_url()?>template/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url()?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="<?=base_url()?>template/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="<?=base_url()?>template/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="<?=base_url()?>template/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?=base_url()?>template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?=base_url()?>template/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?=base_url()?>template/plugins/moment/moment.min.js"></script>
        <script src="<?=base_url()?>template/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?=base_url()?>template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="<?=base_url()?>template/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="<?=base_url()?>template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url()?>template/dist/js/adminlte.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?=base_url()?>template/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?=base_url()?>template/dist/js/demo.js"></script>
        <!-- DataTables -->
        <script src="<?=base_url()?>template/plugins/datatables/jquery.dataTables.js"></script>
        <script src="<?=base_url()?>template/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <!-- datepicker -->
        <script src="<?=base_url()?>template/datepicker/js/bootstrap-datepicker.min.js"></script>

        <script>
            $(function () {
                $('#table-barang').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                });
            });

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
            });
        </script>

    </body>
</html>