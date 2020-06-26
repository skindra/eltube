
    <div class="container mt-5">
        <h2>Daftar Operator</h2> 
        <?php
            echo showFlashMessage();
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach ($user as $u ) { ?>
                
                <tr>
                    <td scope="row"><?=$no++;?></td>
                    <td><?=$u->username;?></td>
                    <td>
                        <?php echo $hasil = ($u->role_user == 1) ? 'ADMIN' : 'OPERATOR' ; ?>
                    </td>
                    <td>
                        <a name="ubah" id="ubah" class="btn btn-sm btn-primary" href="<?=base_url('operator/edit/'.$u->id_user);?>" role="button">Ubah</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
    </div> 