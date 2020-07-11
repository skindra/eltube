<div class="container mt-5">
<br>
<br>
<h3><?=$judul;?></h3>
<br>
<?php
    echo showFlashMessage();
?>

<?=form_open('kategori/ubahkategori',['class'=>"form-inline" ]);?>
    <div class="form-group mb-2">
        <label for="" class="control-label">Pilih Kategori</label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <?=form_dropdown('id_kategori',getDropdownList('kategori',['id_kategori','nama_kategori']),'',['class'=>'form-control','id'=>'kategori']);?>
    </div>
    <div class="form-group mx-sm-2 mb-2">
        <input type="text" class="form-control" id="ubahkategoribaru" name="nama_kategori" placeholder="Ketik Ubah Kategori">
        <?=form_error('nama_kategori');?>
    </div>

    <div class="btn-group mb-2">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pilih
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item text-info" type="submit">Ubah</button>
            <a href="#"  class="hapus-kategori dropdown-item text-danger">Hapus</a>
        </div>
    </div>
</form>
    <?=form_open('kategori/ubahsubkategori',['class'=>"form-inline" ]);?>
        <div class="form-group mb-2">
            <label for="" class="control-label">Pilih Sub Kategori</label>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <?=form_dropdown('id_subkategori',getDropdownList('subkategori',['id_subkategori','nama_subkategori']),'',['class'=>'form-control','id'=>'subkategori']);?>
        </div>
        <div class="form-group mx-sm-2 mb-2">
            <input type="text" class="form-control" id="ubahsubkategoribaru" name="nama_subkategori" placeholder="Ketik Ubah Sub Kategori">
            <?=form_error('nama_subkategori');?>
        </div>
        <div class="btn-group mb-2">
            <button type="button" class="btn btn-outline-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pilih
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <button class="dropdown-item text-info" type="submit">Ubah</button>
                <a href="#"  class="hapus-subkategori dropdown-item text-danger">Hapus</a>
            </div>
        </div>
    </form>



<div class="modal  fade" id="ubahmodalkategori" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
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


