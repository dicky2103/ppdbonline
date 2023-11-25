<div class="main-content">
    <section class="section">
        <section class="section-header">
            <h1>Data Jadwal Event</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="panel_admin">Beranda</a></div>
                <div class="breadcrumb-item">Data Jadwal Event</div>
            </div>
        </section>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Event</th>
                                        <th>Nama Event</th>
                                        <!-- <th>Asesor</th> -->
                                        <th>No Pendaftaran</th>
                                        <th>Asesi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form method="post" action="<?= base_url() ?>/panel_siswa/pilih_jadwal">
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <select class="form-control" name="id_jadwalevent" id="id_jadwalevent">
                                                    <option value="" data-event="" data-asesor="" data-tgl="">-- Pilih Tanggal --</option>
                                                    <?php foreach ($jadwalevent as $item) : ?>
                                                        <option <?= $user->tgl_event == $item->tgl_jadwalevent ? "selected" : "" ?> data-event="<?= $item->nama_jadwalevent ?>" data-asesor="<?= $item->nama_lengkap ?>" data-tgl="<?= $item->tgl_jadwalevent ?>" value="<?= $item->id_jadwalevent ?>">
                                                            <?= date_format(date_create($item->tgl_jadwalevent), "d F Y") ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" name="id_siswa" value="<?= $user->id_siswa ?>">
                                                <input type="hidden" name="nama_event" value="">
                                                <input type="hidden" name="tgl_event" value="">
                                                <!-- <input type="hidden" name="nama_asesor" value=""> -->
                                            </td>
                                            <td><span id="display_event"><?= $user->nama_event; ?></span></td>
                                            
                                            <td><?= $user->no_pendaftaran; ?></td>
                                            <td><?= $user->nama_lengkap; ?></td>
                                            <td>
                                                <button onclick="return confirm('Yakin ingin simpan?')" type="submit" class="btn btn-primary">Simpan</button>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('#id_jadwalevent').on('change', function() {
        let event = $(this).find(':selected').data('event');
        let asesor = $(this).find(':selected').data('asesor');
        let tgl = $(this).find(':selected').data('tgl');

        $('#display_event').text(event);
        $('#display_asesor').text(asesor);

        $('input[name="nama_event"]').val(event);
        $('input[name="tgl_event"]').val(tgl);
        $('input[name="nama_asesor"]').val(asesor);
    });
</script>