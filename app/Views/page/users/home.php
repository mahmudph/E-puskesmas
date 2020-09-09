<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php foreach($jadwal as $key => $jdw) : ?>
                <div class="col-md-6">
                    <div class="card card-info card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Jadwal <?= $jdw['id'] ?></h5>
                                <p class="card-text">
                                    <strong><?= session()->get('nama')?></strong> Anda Memiliki jadwal atas nama <strong><?= ucfirst($jdw['nama'])?></strong> untuk datang ke puskesmas <strong><?= ucfirst($jdw['nama_puskesmas'])?></strong> pada tanggal <strong><?= date('Y-m-d', strtotime($jdw['tgl_digunakan']))?></strong>
                                </p>
                            <!-- <a href="<?= base_url('user/riwayat')?>" class="card-link">Lihat Riwayat </a> -->
                            <a href="#" class="card-link">
                                Antrian ke- <?= $jdw['no_antrian'] ?? NULL ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- /.row -->
    </div>
</div>