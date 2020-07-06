<br>
<br>
<br>


<div class="tengah">

    <div class="w3-teal">
        <button class="w3-teal w3-left" onclick="openLeftMenu()"><img src="<?=base_url('assets')?>/bar2.png"></button>
    </div>

    <div class="w3-sidebar w3-animate-left" style="display:none" id="kolap">
        <button class="klose" onclick="closeLeftMenu()"><b>&times;</b></button>
        <div><img src="../../video/img/<?=$play->barcode?>" ></div>
        
    </div>
    <div class='marg'>
        <?php 
        
        echo "<div class='gbr'><video controls autoplay id='myvideo' ><source src='../../video/uploads/".$play->Isi."' type='video/mp4'>
            </video><p>".$play->judul."</p></a>
            </div>";

        ?>
    </div>
    <div class="samping">
        <ul>
            <?php
                $mp3=$this->db->query("SELECT * FROM `eltube` WHERE `id_kategori` = '$play->id_kategori' ORDER BY id DESC limit 8")->result_array();
                $no = 0;
                foreach ($mp3 as $play1 ) {
                    echo "
                        <li class='gbr'><a href='video?play1=".$play1['id']."' class='vit'><img src='../../video/uploads/".   $play1['gambar']."' >"."<p>".$play1['judul']."</p></a>
                            <font color='yellow' class='besar'>".$play1['id_kategori']."</font>
                        </li>";
                }
            ?>
        </ul>
    </div>
</div>