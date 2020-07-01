
<div class="container mt-5">
<h3>Upload Video</h3>
<?php
    echo showFlashMessage();
?>

    <?=form_open_multipart('unggah')?>

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
            </div>
            <?=form_error('id_kategori');?>
        </div>

        <div class="form-group">
            <label for="subkategori">Sub Kategori</label>
            <div class="input-group">
                <select name="id_subkategori" id="subkategori" class="form-control">
                </select>
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
            <?= fileFormError('gambar', '<small class="form-text text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label for="video">Video</label>
            <!-- Isi -->
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="Isi" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <?= fileFormError('Isi', '<small class="form-text text-danger">', '</small>'); ?>
        </div>

        <button type="submit" class="btn btn-sm btn-info"><?=$button?></button>
        
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    bsCustomFileInput.init()
</script>

