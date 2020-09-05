<style>
.id_puskesmas {
  display:none;
}
</style>
<?php 
/* get errors from form validation */
$data = session()->getFlashdata('response');
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="errors-handler">
          <?php if(!empty($data['errors'])) : ?>
              <div class="alert alert-danger alert-sm alert-dismissible" role="alert">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <ul>
                  <?php foreach ($data['errors'] as $error) : ?>
                      <li><?= esc($error) ?></li>
                  <?php endforeach ?>
                  </ul>
              </div>
          <?php elseif(!empty($data['success'])) : ?>
              <div class="alert alert-success alert-sm alert-dismissible" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <ul>
                  <?php foreach ($data['success'] as $success) : ?>
                      <li><?= esc($success) ?></li>
                  <?php endforeach ?>
                  </ul>
              </div>
          <?php endif ?>
        </div>
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
            </div>
            <div class="card-body table-responsive p-0">
                <form action="<?= base_url('user/puskesmas/daftar_online')?>" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                      <label for="judul">Nama Puskesmas </label>
                      <input type="text"  readonly class="form-control" value="<?= $puskesmas['nama_puskesmas']?>" placeholder="Nama puskesmas">
                      <input type="hidden" name="id_puskesmas" id="id_puskesmas" value="<?= $puskesmas['id']?>">
                      <input type="hidden" name="id_user" id="id_user" value="<?= session()->get('user_id')?>">
                    </div>
                  </div>
                <div class="form-group">
                    <div class="col-md-12">
                      <label for="judul">Nama Pendaftar*</label>
                      <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Pendaftar">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="no_hp">Nomer Hp</label>
                      <input type="text" name="no_hp" id="nama" class="form-control" placeholder="Nomer Hp">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="jadwal_datang">Jadwal Datang</label>
                      <input type="date" name="jadwal_datang" id="tgl_datang" class="form-control" placeholder="Jadwal Datang">
                    </div>
                  </div>
                    <div class="form-group">
                        <label for="isi">Keterangan*</label>
                        <textarea class="form-control" name="keterangan" id="isi" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-info btn-sm pull-right">Kirim</button>
                        <a href="<?= base_url('/user/puskesmas')?>" class="btn btn-danger btn-sm">Kembali</a>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>  
  </div>
</div>
