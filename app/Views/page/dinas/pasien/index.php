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
                <h3 class="card-title">Data Antrian Pasien</h3>
                    
                <div class="card-tools">
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tgl_daftar</th>
                                <th>Tanggal_digunakan</th>
                                <th>Status </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pasien as $key => $row) : ?>
                                <tr>
                                    <td><?= $key ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['tgl_daftar'] ?></td>
                                    <td><?= $row['tgl_digunakan'] ?></td>
                                    <td class="btn btn-sm <?= $row['status'] == 1 ? "btn-info" : 'btn-success' ?>"><?= $row['status'] == 1 ? "Dalam Antrian" : 'Selesai' ?></td>
                                    <td>
                                        <span>
                                            <a href="<?= base_url('dinas/pasien/ubah/'.$row['id'])?>">ubah</a>
                                        </span>
                                        <span>
                                            <a href="<?= base_url('dinas/pasien/hapus/'.$row['id'])?>">hapus</a>
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
<script>
$(document).ready(function() {
    $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
       
});

</script>
                  
                  
