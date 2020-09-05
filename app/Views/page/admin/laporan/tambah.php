<?php 
/* get errors from form validation */
$data = session()->getFlashdata('response');
?>

<style>
#alert-msg {
  display: hidden;
}

</style>
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
        <div class="col-md-12" id="alert-msg">
            <div class="alert alert-info alert-dismisable" >
                <p id="msg"></p>
            </div>
        </div>
        <div class="card" style="min-height:100px; height:auto">
            <div class="card-header">
                <h3 class="card-title">Buat laporan</h3>
                <div class="card-tools">
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                      <form action="" method="post">
                      <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Pilih</th>
                                <th>Nama</th>
                                <th>Nomer Hp</th>
                                <th>Desa</th>
                                <th>Alamat</th>
                                <th>Tgl lahir</th>
                                <th>Tanggal Daftar</th>
                                <th>Tanggal Datang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach($pendaftar as $row) : ?>
                                <?php $i++; ?>
                                <tr class="row-item">
                                    <td class="text-center">
                                        <input class="form-check-input radio_button" type="checkbox" value="<?= $row['id']?>" data_id="<?= $row['id']?>">
                                    </td>
                                    <td><?= $row['nama']?></td>
                                    <td><?= $row['no_hp']?></td>
                                    <td><?= $row['desa']?></td>
                                    <td><?= $row['alamat']?></td>
                                    <td class="text-center"><?= date('Y-m-d', strtotime($row['tgl_lahir'])) ?></td>
                                    <td class="text-center"><?= date('Y-m-d', strtotime($row['tgl_daftar']))?></td>
                                    <td class="text-center"><?= date('Y-m-d', strtotime($row['tgl_digunakan']))?></td>
                                    
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                   
                </div>
                <div class="col-md-12">
                    <a href="#" id="select_all" class="btn btn-info btn-xs">Pilih Semua</a>
                    <a href="#" id="kirim" class="btn btn-info btn-xs pull-right" >Simpan</a>
                      
                </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
  $('#select_all').on('click',function() {
    $(':checkbox').prop('checked', function (i, value) {
      return !value;
    });
  });
});

$('#kirim').on('click', function() {
    let temp = "";
    let data = $(".radio_button:checkbox:checked");
    data.each((k,v) => {
      temp += v.value +',';
      
    });
    let data_form = new FormData();
    data_form.append('id', temp);

    $.ajax({
      type: "POST",
      url: '<?= base_url("admin/laporan_pasien/create/".$id_laporan)?>',
      data: data_form,
      success: function(e) {
        $('#alert-msg').show();
        $('#msg').text(e.msg);
      }, 
      errors: function(e) {
      },
      processData: false,
      contentType: false,
      dataType: 'json'
    });
});

</script>

