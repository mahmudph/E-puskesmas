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
                <h3 class="card-title">Data Laporan Puskesmas</h3>
                <div class="card-tools" >
                      <a href="<?= base_url('dinas/laporan')?>" class="btn btn-danger btn-xs">kembali</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <!-- statistik laporan detail  -->
                    <div class="row">
                      <div class="col-md-6">
                        <p>
                          <span>Detail Laporan </span><br>
                          <code>Dikirim dan Dibuat Oleh Puskesmas <?= $laporan['nama_puskesmas']?></code>
                        </p>
                      </div>
                      <div class="col-md-6">
                        <p>
                          <span>Pengirim <strong><?= ucfirst($laporan['nama_puskesmas'])?></strong></span>
                          <span>Pada Tanggal <strong><?= date('Y-m-d', strtotime($laporan['tgl_laporan'])) ?> </strong></span><br>
                          <span>Jumlah Pelaporan Pasien <strong><?= number_format($laporan['jmlh'])?> Orang</strong> <span>
                        </p>
                      </div>
                      <div class="col-md-6">
                        <p>
                          <span>
                            <a target="_blank" href="<?=base_url('dinas/laporan/generate_data/'.$laporan['id'])?>" class="btn btn-info btn-xs">Liat Laporan di Google Sheet</a>
                          </span>
                        </p>
                      
                      </div>
                      <div class="col-md-6">
                        <p>
                            <span>
                            <a title='<?= $laporan['status_baca'] == 0 ? "verifikasi laporan": 'sudah diverifikasi' ?>' href="<?= $laporan['status_baca'] == 0 ? base_url('dinas/laporan/verifikasi/'.$laporan['id']) : '#ferivikasi'?>" class="btn btn-success btn-xs">verifikasi</a>
                            </span>
                          </p>
                      </div>
                    </div>
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tangal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Desa</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<script>


function getData(url) {
    $.get(url, function(data, status) {
            let response = [];
            $.each(data, function(i, item) {
                response.push(
                    `<tr>
                        <td> ${i + 1}</td>
                        <td> ${item.nama}</td>
                        <td> ${item.email}</td>
                        <td class="text-center"> ${new Date(item.tgl_lahir).toLocaleDateString()}</td>
                        <td> ${item.jenis_kelamin === 'p' ? 'Perempuan' :'Laki-laki'}</td>
                        <td class="text-center">${new Date(item.tgl_daftar).toLocaleDateString()}</td>
                        <td> ${item.desa} </td>
                        <td class="text-center">
                          <span class="btn ${item.tgl_digunakan != null ? 'btn-success' : 'btn-warning'} btn-xs"> ${item.tgl_digunakan != null ? 'datang' : 'tidak datang'}</span>
                        </td>
                    </tr>`
                );
            });
            $('#data').append(response.join(''));
    });
}

$(document).ready(function() {
    $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    let url = '<?= base_url('dinas/laporan/get_pasien_pendaftaran/'.$laporan['id']) ?>';
    getData(url);
});
</script>
                  
                  
