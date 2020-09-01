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
    <div class="container-fluid" id="login-content">
    <div class="row">
      <div class="col-md-5 beener-content ">
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
      <div class="col-md-7 login-form">
        <div class="row">
          <div class="col-md-12 d-none d-md-block">
            <div class="login-form-icon ">
              <img src="<?= base_url('img/hospital_logo.png')?>" alt="logo login" width="80px" height="80px" srcset="">
              <h2 class="caption ">Form Reset Password</h2>
            </div>
          </div>
          <div class="col-md-6 offset-md-3 form-input">
            <h4 class="text-center">Email Anda</h4>
            <?php if(!empty($data['success'])) : ?>
                <div class="alert alert-success alert-sm" role="alert">
                    <ul>
                    <?php foreach ($data['success'] as $success) : ?>
                        <li><?= esc($success) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
            <form action="<?= base_url('auth/reset_password_post')?>" method="post" >
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $data['inputs']['email'] ?>">
              </div>
              <div class="input-group mb-3">
                <input type="submit" class="form-control btn btn-primary" placeholder="Email" value="Reset">
              </div>
              <div class="row register"> 
                <div class="col-md-6 col-xs-6">
                  <a href="<?= base_url('auth/lupa_password') ?>">Lupa Password..?</a>
                </div>
                <div class="col-md-6 col-xs-6">
                  <a href="<?= base_url('auth/register') ?>">Daftar akun</a>
                </div>
              </div>
            </form>
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
          </div>
          
        </div>
      </div>
    </div>
  </div>
</body>
<?= view('partials/footer-jsconfig') ?>
</html>