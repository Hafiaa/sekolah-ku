<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-900">
             <a href="<?= base_url('admin/siswa/index') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                  <i class="fas fa-arrow-left"></i>
              </a>
            </div>
            <?= form_open_multipart('', "class='form-horizontal'") ?>
            <div class="card-body">
              <div class="form-group">
                <b for="nisn">*NIS</b>
                <input type="number" name="nisn" class="form-control" value="<?= set_value('nisn') ?>">
                <small class="text-danger"><?= form_error('nisn') ?></small>
              </div>

              <div class="form-group">
                <b for="nama_siswa">*Nama Siswa</b>
                <input type="text" name="nama_siswa" class="form-control" value="<?= set_value('nama_siswa') ?>">
                <small class="text-danger"><?= form_error('nama_siswa') ?></small>
              </div>

               <div class="form-group">
                <b for="id_kelas">*Kelas</b>
                <select name="id_kelas" class="form-control">
                  <option value="">-- pilih --</option>
                  <?php foreach ($kelas as $key): ?>
                  <?php if ($key->id_kelas != 4): ?>
                  <option value="<?= $key->id_kelas ?>" <?= set_value('id_kelas') ? set_value('id_kelas') == $key->id_kelas ? 'selected' : '' : '' ?>><?= $key->nama_kelas ?></option>
                  <?php endif ?>
                  <?php endforeach ?>
                </select>
                <small class="text-danger"><?= form_error('id_kelas') ?></small>
              </div>

              <div class="form-group">
                <b for="id_jurusan">*Jurusan</b>
                <select name="id_jurusan" class="form-control">
                  <option value="">-- pilih --</option>
                  <?php foreach ($jurusan as $key): ?>
                  <option value="<?= $key->id_jurusan ?>" <?= set_value('id_jurusan') ? set_value('id_jurusan') == $key->id_jurusan ? 'selected' : '' : '' ?>><?= $key->nama_jurusan ?></option>
                  <?php endforeach ?>
                </select>
                <small class="text-danger"><?= form_error('id_jurusan') ?></small>
              </div>

              <div class="form-group">
                <b for="tempat_lahir">*Tempat Lahir</b>
                <input type="text" name="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir') ?>">
                <small class="text-danger"><?= form_error('tempat_lahir') ?></small>
              </div>

              <div class="form-group">
                <b for="tanggal_lahir">*Tanggal Lahir</b>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir') ?>">
                <small class="text-danger"><?= form_error('tanggal_lahir') ?></small>
              </div><br>

              <div class="form-group">
                <b for="beasiswa">*Beasiswa</b> : 
                <input type="radio" name="beasiswa" value="prestasi" <?= set_value('beasiswa') == 'prestasi' ? 'checked' : '' ?>> Prestasi &nbsp;&nbsp;
                <input type="radio" name="beasiswa" value="yatim piatu" <?= set_value('beasiswa') == 'yatim piatu' ? 'checked' : '' ?>> Yatim Piatu &nbsp;&nbsp;
                <input type="radio" name="beasiswa" value="lainnya" <?= set_value('beasiswa') == 'lainnya' ? 'checked' : '' ?>> Lainnya &nbsp;&nbsp;
                <input type="radio" name="beasiswa" value="" <?= set_value('beasiswa') == '' ? 'checked' : '' ?>> Tidak ada &nbsp;&nbsp;
                <br><br>
              </div>
              
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <b for="persen_spp">*Potong Spp %</b>
                    <input type="number" name="persen_spp" class="form-control" value="<?= set_value('persen_spp') ? set_value('persen_spp') : 0 ?>" required>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <b for="persen_baju_seragam">*Potong Baju Seragam %</b>
                    <input type="number" name="persen_baju_seragam" class="form-control" value="<?= set_value('persen_baju_seragam') ? set_value('persen_spp') : 0 ?>" required>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <b for="persen_biaya_lain">*Potong Biaya Lainnya %</b>
                    <input type="number" name="persen_biaya_lain" class="form-control" value="<?= set_value('persen_biaya_lain') ? set_value('persen_biaya_lain') : 0 ?>" required>
                  </div>
                </div>
              </div>

            </div>
            <div class="card-footer bg-gray-900 text-right">
              <button type="submit" class="btn bg-gradient-success text-white btn-sm"><i class="fa fa-save"></i> Simpan</button>
              <button type="reset" class="btn bg-gradient-danger text-white btn-sm"><i class="fa fa-"></i> Reset</button>
            </div>
            <?= form_close(); ?>
        </div>
	</div>
</div>