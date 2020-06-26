
    <div class="container mt-5">
        <h2>Ubah Operator</h2>

        <form action="<?=base_url($action);?>" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            
            <div class="input-group">
                <input class="form-control" type="text" name="username" placeholder="Masukkan Username"  value="<?=$input->username;?>">
                <div class="input-group-append">
                    <span class="input-group-text" id="Username">
                        @
                    </span>
                </div>
            </div>
            <?=form_error('username');?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            
            <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Password</span>
                    </div>
                    <input class="form-control" type="password" value="<?=$input->password;?>" name="password" placeholder="" aria-label="">
            </div>
            <?=form_error('password');?>
        </div>
        <div class="form-group">
            <label for="password">Ulangi Password</label>
            
            <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">#</span>
                    </div>
                    <input name="ulangipassword" class="form-control" type="password" value=""placeholder="" aria-label="">
            </div>
            <?=form_error('ulangipassword');?>
        </div>

        <button type="submit" class="btn btn-sm btn-info">Ubah</button>
        
        </form>
    </div>