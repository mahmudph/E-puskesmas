<style>
.id_puskesmas {
  display:none;
}

</style>
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="<?= base_url('dinas/pengumuman')?>" class="btn btn-danger btn-sm">Kembali</a>
            </div>
            <div class="card-tools">
            </div>
            <div class="card-body table-responsive p-0">
                <form action="<?= base_url('dinas/pengumuman/create')?>" method="post">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="judul">Judul pengumuman*</label>
                      <input type="text" name="judul" class="form-control" id="judul" placeholder="judul pengumuman">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label for="judul">Pilih Penerima Pengumuman*</label>
                      <select name="kirim_id" id="kirim_id" class="form-control">
                        <option value="">pilih penerima pengumuman</option>
                        <option value="seluruh">Semua Puskesmas</option>
                        <option value="sebagian">Spesifik Puskesmas</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12 id_puskesmas">
                      <label for="id_puskesmas">Pilih Penrima Pengumuman *</label>
                      <select  name="id_puskesmas" id="id_puskesmas" class="form-control">
                        <option value="">pilih puskesmas</option>
                        <?php foreach($puskesmas as $puskes) : ?>
                          <option value="<?= $puskes['id']?>"><?= $puskes['nama_puskesmas']?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="isi">Isi Pengumuman*</label>
                        <textarea class="form-control" name="isi" id="isi" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-info btn-sm pull-right">Kirim</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>  
  </div>
</div>

<script>
$('#kirim_id').change(function() {
  if($(this).val() =='sebagian') {
    $('.id_puskesmas').show();
  }
});
</script>