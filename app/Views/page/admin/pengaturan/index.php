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
                <h3 class="card-title">Pengaturan Jumlah Antrian</h3>
                <div class="card-tools">
                      <input type="hidden" name="id_setting" id="id_setting" class="form-control" value="<?= $pengaturan->id ?>">
                      <button class="btn btn-info btn-xs" id="ubah">Ubah Jumlah Antrian</button>
                </div>
                <div class="card-body table-responsive p-0" style="min-height:300px; heihgt:auto; margin-top:50px">
                    <table class="table table-hover text-nowrap table-striped table-hovered">
                        <tbody >
                          <tr>
                            <th>Filed</th>
                            <th>Value</th>
                          </tr>
                          <tr>
                            <td>Nama Puskesmas</td>
                            <td><strong> <?= ucfirst($puskesmas->nama_puskesmas) ?></strong></td>
                          </tr>
                          <tr>
                            <td>Email Puskesmas</td>
                            <td><strong> <?= ucfirst($puskesmas->email_puskesmas) ?></strong></td>
                          </tr>
                          <tr>
                            <td>Admin Puskesmas</td>
                            <td><strong><?= ucfirst($puskesmas->nama)?></strong></td>
                          </tr>
                          <tr>
                            <td>Jumlah Pendaftaran (Hari)</td>
                            <td><strong><?= ucfirst($pengaturan->jmlh_antrian)?> Pendaftar / Hari</strong></td>
                          </tr>
                          <tr>
                            <td>Alamat Puskesmas</td>
                            <td><?= $puskesmas->alamat_puskesmas?></td>
                          </tr>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Jumlah Antrian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/setting/update')?>" method="post">
            <div class="form-group">
              <div class="col-md-12">
                <label for="jmlh_antrian">Jumlah Antrian </label>
                <input type="number" name="jmlh_antrian" id="jmlh_antrian" class="form-control">
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" id="simpan" class="btn btn-primary">simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  let id = $('#id_setting').val();
  $('#ubah').click(function() {
    $.get('<?= base_url("admin/pengaturan/ubah/")?>' + '/' + id, function(data, status) {
      if(status == 'success') {
        console.log(data);
        $('#jmlh_antrian').val(data.pengaturan.jmlh_antrian);
        $('#exampleModal').modal('show');
      }
    });
  })


  $('#simpan').click(function() {
    let jmlah = $('#jmlh_antrian').val();
    let id = $('#id_setting').val();
    let url = '<?= base_url("admin/pengaturan/update/")?>' + '/' + id;
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