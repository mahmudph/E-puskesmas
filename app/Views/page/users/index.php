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
                <div class="card-tools" style="width:200px !important">
                            <div class="div col-md-12" style="margin-top:10px">
                              <select name="id_tahun" id="id_tahun" class="form-control">
                                  <option value="">Pilih Tahun</option>
                                  <?php for($i=2015; $i < 2025; $i++) :  ?>
                                    <?php if(date('Y') == $i) : ?>
                                        <option selected value="<?= $i ?>"><?= $i ?></option>
                                    <?php else: ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endif ?>
                                  <?php endfor ?>
                              </select>
                           </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Puskesmas</th>
                                <th>Tgl pengumpulan</th>
                                <th>Status</th>
                                <th>Aksi</th>
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


function getData(url, tahun, bulan) {
    $.get(url, function(data, status) {
            let response = [];
            $.each(data, function(i, item) {
                response.push(
                    `<tr>
                        <td> ${i + 1}</td>
                        <td> ${item.nama_puskesmas}</td>
                        <td>${new Date(item.tgl_laporan).toLocaleDateString()}</td>
                        <td><span class="btn ${item.status_baca == 0 ? 'btn-danger' : 'btn-success'} btn-xs"> ${item.status_baca == 1 ? 'terpenuhi' : 'belum terpenuhi'}</span></td>
                        <td>
                            <a href='/dinas/laporan/detail/${item.id}'>detail</a>
                        </td>
                    </tr>`
                );
            });
            $('#data').append(response.join(''));
    });
}

$('#id_tahun').on('change', function() {
    let tahun = $(this).val() ?? null; 
    let bulan = $('#id_bulan').val() ?? NULL;
    $('#data').empty();

    let url = '<?= base_url('/dinas/laporan/get_data')?>';

    url = tahun ? url + '?tahun=' + tahun : url;
    url = bulan ? url +'&bulan=' + bulan : url;
    
    getData(url,'','');
});


/*triger when bulan berganti */
$('#id_bulan').on('change', function() {
    $('#data').empty();
    let tahun = $('#id_tahun').val();
    let bulan = $('#id_bulan').val();
    
    let url = '<?= base_url('/dinas/laporan/get_data')?>';

    url = tahun ? url + '?tahun=' + tahun : url;
    url = bulan ? url +'&bulan=' + bulan : url;
    
    getData(url, tahun, bulan);
});

$(document).ready(function() {
    $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    let url = '<?= base_url('dinas/laporan/get_data/') ?>';
    getData(url,null, null);
});
</script>
                  
                  
