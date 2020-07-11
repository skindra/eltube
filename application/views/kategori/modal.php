<?php if ($aksi == 'kategori') { ?>
    <?=form_open('kategori/edit/'.$id,['class'=>"form-inline"])?>
            <label class="my-1 mr-2" for="kategori">Ubah Kategori</label>
            <div class="input-group">
                <input type="text" class="form-control" name="kategori">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-success">[Ubah]</button>
                </div>
            </div>
        </form>
<?php } else {
    # code...
}
 ?>