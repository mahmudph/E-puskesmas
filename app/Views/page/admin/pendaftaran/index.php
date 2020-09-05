<?php 
/* get errors from form validation */
$data = session()->getFlashdata('response');
?>

<script>
function getData(id) {
    $('#add_puskesmas').attr('action', "<?=base_url('dinas/puskesmas/simpan_edited_puskesmas')?>")
    $.get(`<?= base_url('dinas/puskesmas/edit_puskesmas')?>/${id}`, (data, status) => {
        if(status == 'success') {
            console.log(data);
            // $('#nama_puskes').val(data[0].nama_puskesmas);
            $('#nama_puskes').attr('value', data[0].nama_puskesmas)

            $('#alamat_puskes').text(data[0].alamat_puskesmas);
            $('#status').attr('value',data[0].status);
            $('#token_aktifasi').attr('value',data[0].token_aktifasi);
            $('#id_puskes').attr('value',data[0].id);
            $('#id_admin_puskes').attr('data-select2-id', data[0].id);

            $('#modal-lg').addClass('show');
            $('#modal-lg').css('display', 'block');
        }
    });
}

   function fungsiTutupModal() {
        $('#modal-lg').remove('show');
        $('#modal-lg').css('display', 'none');
    }
</script>

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
                <h3 class="card-title">Data Pendaftaran</h3>
        
                <div class="card-tools">
                      <p><strong><?= $total ?> Data Pendaftaran</strong></p>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomer Hp</th>
                                <th>Desa</th>
                                <th>Alamat</th>
                                <th>Tgl lahir</th>
                                <th>Tanggal Daftar</th>
                                <th>Tanggal Datang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach($pendaftar as $row) : ?>
                                <?php $i++; ?>
                                <tr>
                                    <td><?=  $i ?></td>
                                    <td><?= $row['nama']?></td>
                                    <td><?= $row['no_hp']?></td>
                                    <td><?= $row['desa']?></td>
                                    <td><?= $row['alamat']?></td>
                                    <td class="text-center"><?= date('Y-m-d', strtotime($row['tgl_lahir'])) ?></td>
                                    <td class="text-center"><?= date('Y-m-d', strtotime($row['tgl_daftar']))?></td>
                                    <td class="text-center"><?= date('Y-m-d', strtotime($row['tgl_digunakan']))?></td>
                                    <td>
                                        <a title="hapus item" href="<?= base_url("admin/pendaftaran/delete/".$row['id'])?>" class="btn btn-danger btn-xs">
                                            <span><i class="fa fa-trash"></i></span>
                                        </a>
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
