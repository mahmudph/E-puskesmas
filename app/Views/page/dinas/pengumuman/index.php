<?php 
/* get errors from form validation */
$data = session()->getFlashdata('response');
?>
<div class="container">
<div class="row">
    <div class="col-12">
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
                <h3 class="card-title">Data Pengumuman Puskesmas</h3>
                <div class="card-tools">
                    <a href="<?= base_url('dinas/pengumuman/tambah')?>" class="btn btn-info btn-sm">Tambah Pengumuman</a>
                </div>
                <div class="card-tools">
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>judul</th>
                                <th>Tanggal </th>
                                <th>Isi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pengumuman as $key => $row) : ?>
                                <tr>
                                    <td><?= $key +1 ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><?= $row['tgl_pengumuman'] ?></td>
                                    <td><?= $row['isi'] ?></td>
                                    <td>
                                        <span>
                                            <a href="<?= base_url('dinas/pengumuman/ubah/'.$row['id'])?>">ubah</a>
                                        </span>
                                        <span>
                                            <a href="<?= base_url('dinas/pengumuman/hapus/'.$row['id'])?>">hapus</a>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
   
                  
