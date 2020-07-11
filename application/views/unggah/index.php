
<div class="container mt-5">
<h3><?=$judul;?></h3>
<?php
    echo showFlashMessage();
?>

    <?=form_open_multipart($action)?>

        <div class="form-group">
            <label for="judul">Judul Video</label>
            <div class="input-group">
                <input class="form-control" type="text" name="judul" placeholder="Masukkan nama"  value="<?=$input->judul;?>">
            </div>
            <?=form_error('judul');?>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
                <div class="input-group">
                    <?=form_dropdown('id_kategori',getDropdownList('kategori',['id_kategori','nama_kategori']),$input->id_kategori,['class'=>'form-control','id'=>'kategori']);?>
                
                    <div class="input-group-append">
                        <button type="button" data-id="kategori" data-toggle="modal" data-target="#tambahkategori" class="btn btn-outline-secondary">Tambah</button>
                    </div>
                </div>
            <?=form_error('id_kategori');?>
        </div>

        <div class="form-group">
            <label for="subkategori">Sub Kategori</label>
            <div class="input-group">
                <?=form_dropdown('id_subkategori',getDropdownList('subkategori',['id_subkategori','nama_subkategori']),$input->id_subkategori,['class'=>'form-control','id'=>'subkategori']);?>
                <div class="input-group-append">
                    <button type="button" data-id="subkategori" data-toggle="modal" data-target="#tambahkategori" class="btn btn-outline-secondary">Tambah</button>
                </div>
            </div>
            <?=form_error('id_subkategori');?>
        </div>

        <div class="form-group">
            <label for="gambar">Gambar</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="gambar" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <small id="emailHelp" class="form-text text-muted">Format Gambar .png,.jpg</small>
            <?= fileFormError('gambar', '<small class="form-text text-danger">', '</small>'); ?>
        </div>
        <?php if (!empty($unggah->gambar)) {?>
            <img width="200px" class="img-thumbnail rounded " src="../../../../video/uploads/<?=$unggah->gambar?>">
        <?php } ?>

        <div class="form-group">
            <label for="video">Video</label>
            <!-- Isi -->
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="Isi" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <small id="emailHelp" class="form-text text-muted">Format Video .mp4.</small>
            <?= fileFormError('Isi', '<small class="form-text text-danger">', '</small>'); ?>
        </div>
        <?php if (!empty($unggah->Isi)) {?>
            <p><?=$unggah->Isi;?></p>
        <?php } ?>
        <button type="submit" class="btn btn-sm btn-info"><?=$button?></button>
        
    </form>
</div>


<div class="modal  fade" id="tambahkategori" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="tambahkategori" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    bsCustomFileInput.init()

    
</script>

