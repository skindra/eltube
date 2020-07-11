
        <?=form_open('operator/subkategori',['class'=>""])?>
            <div class="form-group">
                <label class="control-label" for="kategori">Pilih Kategori</label>
                <?=form_dropdown('id_kategori',getDropdownList('kategori',['id_kategori','nama_kategori']),'',['class'=>'form-control','id'=>'subkategori']);?>
            </div>
            <div class="form-group">
                <label for="sub-kategori">Input Subkategori</label>
                <input type="text" class="form-control" name="nama_subkategori" id="sub-kategori" placeholder="Sub Kategori">
            </div>
            <div class="">
                <button type="submit" class="btn btn-outline-success">[Add]</button>
            </div>
        </form>