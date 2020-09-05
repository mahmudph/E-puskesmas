
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-header">
              <h5>Riwayat Pendaftaran </h5>
            </div>
            <div class="card-body table-responsive p-0" style="min-height:300px; height:auto">
                <?php if(count($jadwal) > 0 ) : ?>
                  <?php foreach($jadwal as $key => $jdw) : ?>
                      <div class="col-md-6">
                          <div class="card card-danger card-outline">
                              <div class="card-body">
                                  <h5 class="card-title">Riwayat Jadwal <?= $jdw['id'] ?></h5>
                                      <p class="card-text">
                                          riwayat jadwal atas nama <strong><?= ucfirst($jdw['nama'])?></strong> untuk datang ke puskesmas <strong><?= ucfirst($jdw['nama_puskesmas'])?></strong> pada tanggal <strong><?= date('Y-m-d', strtotime($jdw['tgl_daftar']))?></strong>
                                      </p>
                                  <a href="<?= base_url('user/riwayat')?>" class="card-link"></a>
                                  <a href="#" class="card-link"></a>
                              </div>
                          </div>
                      </div>
                    <?php endforeach ?>
                  <?php else : ?>
                    <div class="col-md-6 offset-3">
                      <h4 class="text-center" style="padding-top:100px">
                        Riwayat Tidak ditemukan
                      </h4>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>  
  </div>
</div>
