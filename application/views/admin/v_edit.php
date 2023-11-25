<div class="header">
     <div class="title">
          <h3>Edit Pengguna</h3>
     </div>
</div>

<form action="process_form.php" method="POST" id="edit-pengguna">
     <?php foreach ($v_siswa->result_array() as $i) : ?>
     <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" value="<?php echo $i['nama_lengkap']; ?>">
     </div>
     <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label>
          <label><input type="radio" name="jenis_kelamin" value="Lelaki"<?php echo ($i['jk'] == 'Lelaki' ? ' checked' : ''); ?>> Lelaki</label>
          <label><input type="radio" name="jenis_kelamin" value="Perempuan"<?php echo ($i['jk'] == 'Perempuan' ? ' checked' : ''); ?>> Perempuan</label>
     </div>
     <?php endforeach; ?>
     <div class="action">
          <button type="submit" form="edit-pengguna" class="btn btn-default">Simpan</button>
     </div>
</form>
