      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span style="color: #000;">
              Copyright &copy; Nakula Sehat <?= date('Y'); ?>
            </span>
          </div>
        </div>
      </footer>
      <!--  style="background-color: #4495f1!important; color: #ffffff" -->
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin Keluar ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <!-- <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div> -->
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= site_url('Login/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  
  <script src="<?= base_url(); ?>agenda/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url(); ?>agenda/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url(); ?>agenda/admin/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url(); ?>agenda/admin/vendor/chart.js/Chart.min.js"></script>
  <script src="<?= base_url(); ?>agenda/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>agenda/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url(); ?>agenda/admin/js/demo/chart-area-demo.js"></script>
  <script src="<?= base_url(); ?>agenda/admin/js/demo/chart-pie-demo.js"></script>
  <script src="<?= base_url(); ?>agenda/admin/js/demo/datatables-demo.js"></script>
  <script src="<?= base_url(); ?>agenda/admin/select2/select2.min.js"></script>
  <script src="<?= base_url(); ?>agenda/owlcarousel/owl.carousel.min.js"></script>
  

</body>

</html>