
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="<?= base_url('admin/pendaftaran')?>" class="btn btn-danger btn-sm">Kembali</a>
            </div>
            <div class="card-tools">
            </div>
            <div class="card-body table-responsive p-0">
                <form action="<?= base_url('admin/pendaftaran/update')?>" method="post">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="nama">Nama Pendaftar</label>
                      <input type="hidden" name="id"value="<?php echo $pendaftar->id ?>">
                      <input disabled type="text" name="nama" class="form-control" value="<?= $pendaftar->nama ?>" id="judul" placeholder="Nama pendaftar">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="no_hp">No Hp Pendaftar</label>
                      <input type="text" name="no_hp" disabled class="form-control" value="<?= $pendaftar->no_hp ?>" id="judul" placeholder="No hp ">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="tgl_daftar">Tanggal Daftar</label>
                      <input type="text" disabled name="tgl_daftar" class="form-control" value="<?= $pendaftar->nama ?>" id="judul" placeholder="Tanggal daftar">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="tgl_hadir">Tanggal Hadir</label>
                      <input disabled type="text" name="tgl_hadir" class="form-control" value="<?= $pendaftar->tgl_digunakan ?>" id="judul" placeholder="Tanggal Hadir">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="dianosis">Diagnosis</label>
                      <input type="text" name="diagnosis" class="form-control" value="<?= $pendaftar->diagnosis ?>" id="dianosis" placeholder="Diagnosis">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="jenis_obat">Jenis Obat Diberikan</label>
                      <textarea name="obat" id="" cols="30" rows="5" class="form-control"><?= $pendaftar->obat?></textarea>
                    </div>
                  </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-info btn-sm pull-right">Kirim</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>  
  </div>
</div>
