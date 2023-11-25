<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
</div>

<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> Design By <a href="https://andri.in/">Andri </a> <div class="bullet"></div>Programmed By <a href="https://github.com/dicky2103/">Dicky Azhari Hernuwan</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="assets/assets_stisla/js/stisla.js"></script>
  <script src="assets/assets_stisla/js/page/bootstrap-modal.js"></script>

  <!-- JS Libraies -->
  <script src="assets/assets_stisla/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
  <script src="assets/assets_stisla/node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="assets/assets_stisla/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="assets/assets_stisla/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="assets/assets_stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="assets/assets_stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Template JS File -->
  <script src="assets/assets_stisla/js/scripts.js"></script>
  <script src="assets/assets_stisla/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/assets_stisla/js/page/index-0.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;
        $('li a[href="'+ url +'"]').parent().addClass('active');
        $('li a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
    });
</script> 
  <script type="text/javascript">
        const flashData = $('.flash-data').data('flashdata');
        const flashDataDaftar = $('.flash-data-daftar').data('flashdata');
        const flashDataProfil = $('.flash-data-profil').data('flashdata');

        if (flashDataProfil) {
        Swal.fire({
            title: 'Data Admin',
            text: 'Berhasil ' + flashData,
            icon: 'success'
          })
        }

        if (flashDataDaftar) {
        Swal.fire({
            title: flashDataDaftar,
            icon: 'success'
          })
        }

        if (flashData) {
        Swal.fire({
            title: 'Berhasil',
            text: flashData,
            icon: 'success'
          })
        }

        $('.tombol-hapus').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Data akan dihapus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus data!',
          cancelButtonText: 'Batal!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        })
        });

          $('.tombol-verifikasi').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Data akan Terverifikasi!",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Verifikasi!',
          cancelButtonText: 'Batal!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        })
        });

        $('.tombol-lulus').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan Lulus!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lulus!',
            cancelButtonText: 'Batal!'
          }).then((result) => {
            if (result.isConfirmed) {
              document.location.href = href;
            }
          })
        });


        $('.tombol-batal-verifikasi').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Data akan batal Terverifikasi!",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Batal Verifikasi!',
          cancelButtonText: 'Cancel!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        })
        });

        $('.tombol-tidak-lulus').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Asesi akan Tidak Lulus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Yakin!',
          cancelButtonText: 'Batal!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        })
        });

        $('.tombol-lulus').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Asesi Akan Lulus!",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Yakin!',
          cancelButtonText: 'Batal!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        })
        });

        $('.tombol-batal').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Status Asesi Sekarang Akan Dibatalkan!",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Batalkan!',
          cancelButtonText: 'Cancel!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        })
        });

        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
          return true;
        }

        $(document).ready(function() {
        $('#example').DataTable();
        } );
      </script>
</body>
</html>