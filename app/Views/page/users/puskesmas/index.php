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
                <h3 class="card-title">Data Puskesmas Yang Tersedia</h3>
                <div class="card-tools">
                    <?= form_open('user/puskesmas', ['method'=> 'get']) ?>
                        <div class="input-group-sm input-group" style="width: 150px;">
                            <input
                                type="text"
                                name="q"
                                class="form-control float-right"
                                placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                        </div>
                    <?= form_close()?>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Puskesmas</th>
                                <th>Alamat Puskesmas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach($puskes as $row) : ?>
                                <?php $i++; ?>
                                <tr>
                                    <td><?=  $i ?></td>
                                    <td><?= $row->nama_puskesmas?></td>
                                    <td>
                                        <span class="tag-success"><?= $row->alamat_puskesmas?></span>
                                    </td>
                                    <td>
                                        <a title="Daftar Online" href="<?= base_url("user/puskesmas/daftar/$row->id")?>" class="btn btn-info btn-xs">
                                            <span><i class="fa fa-bell"></i></span>
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
<div class="modal fade show" id="modal-lg"  aria-modal="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Puskesmas</h4>
            <button type="button" onclick="fungsiTutupModal()" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?= form_open('dinas/puskesmas/simpan_puskesmas',['id' => 'add_puskesmas']) ?>
                            <div class="form-group">
                                <?= form_input(["name" =>'id_puskes', 'id' => 'id_puskes', 'type'=> 'hidden', 'value' => ''])?>
                                <?= form_label('Nama Puskemas', 'nama_puskes')?>
                                <?= form_input(['name' => 'nama_puskes', 'id' => 'nama_puskes','class' => 'form-control', 'placeholder' => 'nama puskemas'])?>
                            </div>
                            
                            <div class="form-group">
                                <?= form_label('Alamat Puskemas', 'alamat_pusksemas')?>
                                <?= form_textarea(['name' => 'alamat_puskes','id' => 'alamat_puskes', 'class' => 'form-control', 'placeholder' => 'Alamat puskemas', 'rows' => 3])?>
                            </div>
                            <div class="form-group">
                                <?= form_label('Token Aktifasi', 'token_aktifasi')?>
                                <?= form_input(['name' => 'token_aktifasi','id' => 'token_aktifasi',  'class' => 'form-control', 'placeholder' => 'Token aktifasi '])?>
                            </div>
                            <div class="form-group">
                                <?= form_label('Admin Puskesmas', 'id_admin_puskes')?>
                                <select name="id_admin_puskes" id="id_admin_puskes" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <?php foreach($users as $user) : ?>
                                        <option data-select2-id="<?= $user->id ?>" value="<?= $user->id ?>"><?= $user->nama ?></option>
                                    <?php endforeach ?>
                                </select>
                              <span class="select2 select2-container select2-container--bootstrap4 select2-container--above select2-container--focus"
                                dir="ltr"
                                data-select2-id="1"
                                style="width: 100%;">
                            </span>
                            </div>
                        <?= form_close()?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" onclick="fungsiTutupModal()" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" form="add_puskesmas" onclick="fungsiTutupModal()" >Simpan data</button>
        </div>
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
                  
                  
