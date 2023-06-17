<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 bg-gray-900">
       <a href="<?= base_url('admin/tabungan') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
            <i class="fas fa-arrow-left"></i>
        </a>
      </div> 
      <div class="card-body bg-gray-800">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3 bg-gray-900">
                <h6 class="m-0 font-weight-bold text-white">Identitas Siswa</h6>
              </div>
              <div class="card-body">
                 <table width="100%" class="table" >
                   <tr>
                    <th>NIS</th>
                    <td>:</td>
                    <td><?= $siswa->nisn ?></td>
                   </tr>
                   <tr>
                    <th>Nama Lengkap</th>
                    <td>:</td>
                    <td><?= $siswa->nama_siswa ?></td>
                   </tr>
                   <tr>
                    <th>TTL</th>
                    <td>:</td>
                    <td><?= $siswa->tempat_lahir.', '.$this->lib->date_indo($siswa->tanggal_lahir) ?></td>
                   </tr>
                   <tr>
                    <th>Kelas</th>
                    <td>:</td>
                    <td><?= $siswa->nama_kelas .' - '. $siswa->nama_jurusan ?></td>
                   </tr>
                   <tr>
                    <th>Beasiswa</th>
                    <td>:</td>
                    <td><?= $siswa->beasiswa ? $siswa->beasiswa : '-' ?></td>
                   </tr>
                 </table>
              </div>
            </div>
          </div>
        </div>

         <div class="row">
          <div class="col-lg-12">


             <div class="card shadow mb-4">
              <div class="card-header py-3 bg-gray-900">
                  <div class="row">
                  <div class="col-lg-4">
                    <h6 class="m-0 font-weight-bold text-white">Tabungan Siswa</h6>
                  </div>
                  <div class="col-lg-4 text-center">
                    <h6 class="m-0 font-weight-bold text-white">
                      Saldo Tabungan &nbsp; : &nbsp; <span>Rp. <?= number_format($uang_masuk - $uang_keluar, 0, ',', '.') ?>,-</span>
                    </h6>
                  </div>
                  <div class="col-lg-4 text-right">
                     <a class="btn bg-gradient-success text-white btn-circle btn-sm" data-target="#tambah_tabungan" data-toggle="modal"><i class="fa fa-plus"></i></a> &nbsp;
                     <a class="btn bg-gradient-danger text-white btn-circle btn-sm" data-target="#ambil_tabungan" data-toggle="modal"><i class="fa fa-minus"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                 <table class="table table-striped table-bordered" id="dataTable">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th>Tanggal Transaksi</th>
                      <th>Jumlah Uang</th>
                      <th>Status</th>
                      <th width="1%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $i=1;foreach ($tabungan as $key): ?>
                   <tr>
                     <td class="text-center"><?= $i ?></td>
                     <td><?= $this->lib->date_indo($key->tanggal_tabungan) ?></td>
                     <td>Rp. <?= number_format($key->jumlah_tabungan, 0, ',', '.') ?>,-</td>
                     <td><?= $key->status_tabungan == 1 ? '<spa class="text-success">Menabung</span>' : '<span class="text-warning">Mengambil</span>' ?></td>
                     <td class="text-center">
                       <a href="<?= base_url('admin/tabungan/delete/').md5($key->id_siswa).'/'.md5($key->id_tabungan) ?>" onClick="return confirm('yakin mau hapus transaksi <?= $key->status_tabungan ? 'menabung' : 'pengambilan' ?> Rp. <?= number_format($key->jumlah_tabungan,0,',','.') ?>,- ? \n\nPeringatan : ini akan mempengaruhi uang saldo tabungan !')">
                         <i class="fas fa-trash text-danger"></i>
                       </a>
                     </td>
                   </tr>
                   <?php $i++;endforeach ?>
                  </tbody>
                 </table>
                </div>
              </div>
            </div>
            
          </div>
          </div>

        </div>
      
      <div class="card-footer bg-gray-900 text-right">
      
     </div>
  </div>
</div>






<div class="modal fade" id="tambah_tabungan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gray-900 text-white">
        <h6 class="modal-title" id="exampleModalLabel">Menabung</h6>
        <button class="close x-cancel" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?= form_open('') ?>
      <div class="modal-body"><br>
        <div class="form-group">
          <label for="">Jumlah Uang : </label>
          <input type="number" class="form-control" name="jumlah_uang" id="uang_masuk" required placeholder="Rp. ">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-xs x-cancel" type="button" data-dismiss="modal" id="cancel_masuk">Cancel</button>
        <button class="btn btn-primary btn-xs" name="masuk">Proses</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>


<div class="modal fade" id="ambil_tabungan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gray-900 text-white">
        <h6 class="modal-title" id="exampleModalLabel">Mengambil</h6>
        <button class="close x-cancel" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?= form_open('') ?>
      <div class="modal-body"><br>
        <div class="form-group">
          <label for="">Jumlah Uang : </label>
          <input type="number" class="form-control" name="jumlah_uang" id="uang_keluar" required placeholder="Rp. " max="<?= ($uang_masuk - $uang_keluar) ?>">
        </div><br>
        <small class="text-right">Sisa saldo &nbsp;:&nbsp; <span id="sisa_saldo">Rp. <?= number_format($uang_masuk - $uang_keluar, 0, ',', '.') ?>,-</span></small>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-xs x-cancel" type="button" data-dismiss="modal" id="cancel_keluar">Cancel</button>
        <button class="btn btn-primary btn-xs" name="keluar">Proses</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>



<script>
$(document).ready(function(){
  $('#uang_keluar').keyup(function(){
    var keluar = $(this).val();
    var saldo = <?= $uang_masuk - $uang_keluar ?>;
    if(parseInt(saldo - keluar) >= 0){
      $('#sisa_saldo').removeClass('text-danger').text(convertToRupiah(saldo - keluar));
    }else{
      $('#sisa_saldo').addClass('text-danger').text(convertToRupiah(saldo - keluar));
    }
  })

  $('.x-cancel').click(function(){
    $('#uang_keluar').val('');
    $('#uang_masuk').val('');
    $('#sisa_saldo').removeClass('text-danger').text('Rp. <?= number_format($uang_masuk - $uang_keluar, 0, ',', '.') ?>,-');
  })
})
</script>