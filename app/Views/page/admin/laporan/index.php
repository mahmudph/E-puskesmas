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
                <h3 class="card-title">Data laporan</h3>
                <div class="card-tools">
                      <a href="<?= base_url('admin/laporan_pasien/tambah')?>" class="btn btn-info btn-xs">Buat Laporan</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Laporan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach($laporans as $row) : ?>
                                <?php $i++; ?>
                                <tr>
                                    <td><?=  $i ?></td>
                                    <td><?= date('Y-m-d', strtotime($row['tgl_laporan'])) ?></td>
                                    <td>
                                        <a href=""class="btn btn-xs <?= $row['status_baca'] == 1 ? 'btn-success' : 'btn-danger' ?>"><?= $row['status_baca'] == 1 ? 'terpenuhi' : 'tertolak' ?></a>
                                    </td>
                                    <td>
                                        <a title="update item" href="<?= base_url("admin/laporan_pasien/edit/".$row['id'])?>" class="btn btn-warning btn-xs">
                                            <span><i class="fa fa-edit"></i></span>
                                        </a>
                                        <a title="hapus item" href="<?= base_url("admin/laporan_pasien/delete/".$row['id'])?>" class="btn btn-danger btn-xs">
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


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  let id = $('#id_setting').val();
  $('#open-modal').click(function() {
    $.get('<?= base_url("admin/laporan_pasien/ubah/")?>' + '/' + id, function(data, status) {
      if(status == 'success') {
        console.log(data);
        $('#jmlh_antrian').val(data.laporan_pasien.jmlh_antrian);
        $('#modalku').modal('show');
      }
    });
  })


  $('#simpan').click(function() {
    let jmlah = $('#jmlh_antrian').val();
    let id = $('#id_setting').val();
    let url = '<?= base_url("admin/laporan_pasien/update/")?>' + '/' + id;
    let data = new FormData();
    data.append("jmlh_antrian", jmlah);
    data.append("id_puskes", id);
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(e) {
        console.log(e);
        $('#exampleModal').modal('hide');
        location.reload();
      }, 
      errors: function(e) {
        console.log(e);
      },
      processData: false,
      contentType: false,
      dataType: 'json'
    });
  });
});

</script>