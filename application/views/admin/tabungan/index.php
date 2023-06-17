<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
         <form method="GET" action="">
         <div class="row">
           <div class="col-lg-11">
            <input type="number" name="nis" class="form-control" required placeholder="Masukkan NIS siswa" value="<?= @$_GET['nis'] ?>">
           </div>
           <div class="col-lg-1">
             <button class="btn bg-gray-800 text-white" type="submit"><i class="fa fa-search"></i> </button>
           </div>
         </div>
        </form>
        </div>
        <div class="card-body">
          
          <?php if (@$error || @$siswa): ?>  
          
          <h4 class="text-center" id="loading"><i class="fa fa-spinner fa-spin"></i> Loading..</h4>
          <div class="table-responsive" style="display: none;" id="data-siswa">
          
            <?php if (isset($error)): ?>
              <div class="alert alert-danger" data-dismiss="alert">Maaf data siswa <?= 'dengan NIS <b>'.$_GET['nis'].'</b>' ?> tidak di temukan !</div>
            <?php endif ?>
            <?php if (isset($siswa)): ?>
              

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
                  <div class="justify-content-center">
                    <table style="width: 100%; color: #fff;">
                      <tr>
                        <td>Saldo Tabungan Pribadi</td>
                        <td> &nbsp; : &nbsp; </td>
                        <td>Rp. <?= number_format($uang_masuk_tabungan_pribadi - $uang_keluar_tabungan_pribadi, 0, ',', '.' ) ?>,-</td>
                      </tr>
                    </table>
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
                      <th>Tabungan</th>
                      <th>Status</th>
                      <th>Operator</th>
                      <th width="1%" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $i=1;foreach ($tabungan as $key): ?>
                   <tr>
                     <td class="text-center"><?= $i ?></td>
                     <td><?= $this->lib->date_indo($key->tanggal_tabungan) ?></td>
                     <td>Rp. <?= number_format($key->jumlah_tabungan, 0, ',', '.') ?>,-</td>
                     <td><?= $key->status_tabungan == 2 ? 'Tabungan Siswa' : 'Tabungan Pribadi'?></td>
                     <td><?= $key->status_tabungan == 1 ? '<spa class="text-success">Menabung</span>' : '<span class="text-warning">Mengambil</span>' ?></td>
                     <td><?= $key->operator ?></td>
                     <td class="text-center">
                       <a href="<?= base_url('admin/tabungan/delete/').md5($key->id_siswa).'/'.md5($key->id_tabungan).'?nis='.$siswa->nisn ?>" onClick="return confirm('yakin mau hapus transaksi <?= $key->status_tabungan ? 'menabung' : 'pengambilan' ?> Rp. <?= number_format($key->jumlah_tabungan,0,',','.') ?>,- ? \n\nPeringatan : ini akan mempengaruhi uang saldo tabungan !')">
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
        <?php endif; ?>

        </div>
        <?php endif; ?>
        </div>
        <div class="card-footer bg-gray-900">
          
        </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    setTimeout(function(){
      $('#loading').hide('', function(){
        $('#data-siswa').slideDown('slow');
      })
    }, 1000);
  })
</script>


<div class="modal fade" id="tambah_tabungan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gray-900 text-white">
        <h6 class="modal-title" id="exampleModalLabel">Menabung</h6>
        <button class="close x-cancel" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">×</span>
        </button>
      </div>
      <?= form_open('admin/tabungan/form/'.md5($siswa->id_siswa).'?nis='.$siswa->nisn) ?>
      <div class="modal-body"><br>
        <div class="form-group">
          <label for="">Jumlah Uang : </label>
          <input type="number" class="form-control" name="jumlah_uang" id="uang_masuk_tabungan_pribadi" required placeholder="Rp. ">
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
          <span aria-hidden="true" style="color: white;">×</span>
        </button>
      </div>
      <?= form_open('admin/tabungan/form/'.md5($siswa->id_siswa).'?nis='.$siswa->nisn) ?>
      <div class="modal-body"><br>
        <div class="form-group">
          <label for="">Tabungan : </label>
          <select name="status_tabungan" id="status_tabungan" required class="form-control">
            <option value="">-- pilih --</option>
            <option value="0">Tabungan Pribadi</option>
            <option value="2">Tabungan Siswa</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Jumlah Uang : </label>
          <input type="number" class="form-control" name="jumlah_uang" id="uang_keluar" required placeholder="Rp.">
        </div><br>
        <small class="text-right">Sisa saldo &nbsp;:&nbsp; <span id="sisa_saldo">Rp. 0,-</span></small>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-xs x-cancel" type="button" data-dismiss="modal" id="cancel_keluar">Cancel</button>
        <button class="btn btn-primary btn-xs" name="keluar" disabled="">Proses</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
<!-- </div> -->



<script>
$(document).ready(function(){
  
  function saldo(){
     var status_tabungan = $('#status_tabungan').val();
     var uang_keluar     = $('#uang_keluar').val();
     var sisa_saldo      = $('#sisa_saldo');
     var sisa_sisa_saldo = 0;
     if(status_tabungan == 2){
      sisa_sisa_saldo = parseInt('<?= $uang_masuk_tabungan_siswa - $uang_keluar_tabungan_siswa ?>') - uang_keluar;
      sisa_saldo.html(convertToRupiah(sisa_sisa_saldo));
     }else if(status_tabungan == '0'){
      sisa_sisa_saldo = parseInt('<?= $uang_masuk_tabungan_pribadi - $uang_keluar_tabungan_pribadi ?>') - uang_keluar;
      sisa_saldo.html(convertToRupiah(sisa_sisa_saldo));
     }else{
      sisa_saldo.html('Rp. 0,-');
      $('#uang_keluar').val('');
     }
     if(uang_keluar && status_tabungan && sisa_sisa_saldo >= 0){
      $('button[name="keluar"]').removeAttr('disabled');
     }else{
      $('button[name="keluar"]').attr('disabled', 'true');
     }
  }

  $('#status_tabungan').change(function(){
     saldo();
  })

  $('#uang_keluar').keyup(function(){
     saldo();
  })

  $('.x-cancel').click(function(){
    $('#status_tabungan').html(`
        <option value="">-- pilih tabungan --</option>
        <option value="0">Tabungan Pribadi</option>
        <option value="2">Tabungan Siswa</option>
    `);
    $('#uang_keluar').val('');
    $('#uang_masuk_tabungan_pribadi').val('');
    $('#sisa_saldo').removeClass('text-danger').text('Rp. 0,-');
  })
})
</script>