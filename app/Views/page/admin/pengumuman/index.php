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
                <h3 class="card-title">Data Pengumuman</h3>
                <div class="card-tools">
                      <p><strong><?= $total ?> Data Pengumuman</strong></p>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="min-height:300px; heihgt:auto">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th >Tanggal Pengumuman</th>
                                <th  class="text-left">Keterangan </th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if(count($pengumuman) > 0 ) : ?>
                              <?php  $i = 0;foreach($pengumuman as $row) : ?>
                                  <?php $i++; ?>
                                  <tr>
                                      <td><?=  $i ?></td>
                                      <td><?= $row['judul']?></td>
                                      <td><?= date('Y-m-d', strtotime($row['tgl_pengumuman'])) ?></td>
                                      <td><?= $row['isi']?></td>
                                      <td class="text-center"></td>
                                  </tr>
                              <?php endforeach ?>
                          <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
