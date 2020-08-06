<!DOCTYPE html>
<html lang="en">
<head>
  <?= view('partials/head') ?>
</head>
<?php 

/* get errors from form validation */
$data = session()->getFlashdata('response');
?>
<body>
    <div class="container-fluid" id="login-content" >
    <div class="row">
      <div class="col-md-5 beener-content">
        <div class="banner-welcom">
          <img src="<?= base_url('img/icon.jpeg') ?>" alt="Benner Banyuasin" class="img-rounded img-responsive" width="150px" heiht="150px">
        </div>
        <div class="caption-login text-center d-none d-sm-block">
          <h4>SELAMAT DATANG DI</h4>
          <h4>E-PUSKESMAS</h4>
        </div>
        <div class="alamat-caption d-none d-sm-block">
            <h3>Dinas Kesehatan Kabupaten Banyuasin</h3>
        </div>
        <div class="contact text-center d-none d-sm-block">
          <div class="row">
            <div class="col-md-4">
              <p>119</p>
            </div>
            <div class="col-md-8">
              <a href="">
                <span class="fa fa-instagram"> </span> @dinkesbanyuasin
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 login-form" style="overflow: scroll">
        <div class="row">
          <div class="col-md-12 d-none d-md-block">
            <div class="login-form-icon ">
              <img src="<?= base_url('img/hospital_logo.png')?>" alt="logo login" width="80px" height="80px" srcset="">
              <h2 class="caption ">Form Pendaftaran Pengguna Baru</h2>
            </div>
            <div class="back-to-login" style="padding-top: 20px">
              <?= anchor(base_url('auth/login'), 'Login form',  ['class' => 'btn btn-warning btn-sm', 'title' => 'login'])?>
            </div>
          </div>
          <div class="col-md-10 offset-md-1 form-input" style="margin-top:30px">
          <div class="errors-handler">
            <?php if(!empty($data['errors'])) : ?>
                <div class="alert alert-danger alert-sm" role="alert">
                    <ul>
                    <?php foreach ($data['errors'] as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
          </div>
              <?= form_open('auth/proses_register')?>
                <div class="form-group">
                  <?= form_label('Nama pengguna', 'nama') ?>
                  <?= form_input(['name' => 'nama', 'class' => 'form-control', 'value' => $data['inputs']['nama']]) ?>
                </div>
                <div class="form-group">
                  <?= form_label('Email Pengguna', 'email') ?>
                  <?= form_input(['name' => 'email', 'class' => 'form-control', 'value' => $data['inputs']['email']]) ?>
                </div>
                <div class="form-group">
                <?= form_label('Jenis kelamin', '') ?><br>
                  <div class="form-check form-check-inline">
                    <?= form_radio(['name' => 'jenis_kelamin', 'class' => 'form-check-input','value' =>'pria', 'checked' => $data['inputs']['jenis_kelamin'] === 'pria' ? true: false]) ?>
                    <?= form_label('pria', 'jenis kelamin') ?>
                  </div>
                  <div class="form-check form-check-inline">
                    <?= form_radio(['name' => 'jenis_kelamin', 'class' => 'form-check-input', 'value' => 'wanita', 'checked' => $data['inputs']['jenis_kelamin'] === 'wanita' ? true: false]) ?>
                    <?= form_label('wanita', 'jenis kelamin') ?>
                  </div>
                </div>
                <div class="form-group">
                  <?= form_label('Tanggal lahir', 'tgl_lahir') ?>
                  <?= form_input(['name' => 'tgl_lahir','type' => 'date', 'class' => 'form-control', 'value' => $data['inputs']['tgl_lahir']]) ?>
                </div>
                <div class="form-group">
                  <?= form_label('Alamat tinggal', 'alamat') ?>
                  <?= form_textarea(['name' => 'alamat', 'class' => 'form-control', 'rows' => 3, 'value' => $data['inputs']['alamat']]) ?>
                </div>
                <div class="form-group">
                  <?= form_label('Password', 'password') ?>
                  <?= form_input(['name' => 'password','type'=>'password', 'class' => 'form-control', 'value' => $data['inputs']['password']]) ?>
                </div>
                <div class="form-group">
                  <?= form_label('Konfirmasi password', 'confirm_password') ?>
                  <?= form_input(['name' => 'confirm_password','type'=>'password', 'class' => 'form-control', 'value' => $data['inputs']['confirm_password']]) ?>
                </div>
                <div class="form-group">
                  <?= form_submit(['class' => 'btn btn-info pull-right form-control', 'value' => 'Daftar']) ?>
                </div>
              <?= form_close() ?>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</body>
<?= view('partials/footer-jsconfig') ?>
</html>

