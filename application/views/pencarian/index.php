<br>
<br>
<br>



<div class="tengah">
		<ul class='listview' >
			<?php $no=0; foreach ($video as $v ) {
				echo "<li class='gbr' data-toggle='tooltip' title='$v->judul' ><a href='video?play=$v->id'><img src='../../../video/uploads/$v->gambar' ></a>"."<font color='yellow' class='besar' style='left: 41px;'>$v->kategori</font><p class='judul-video'>$v->judul</p></a></li>";
			} ?>
        </ul>
		<!-- <nav >
			<ul class="pagination">
				<li class="page-item disabled">
				<a class="page-link" href="#" tabindex="-1">Previous</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item active">
				<a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
				</li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
				<a class="page-link" href="#">Next</a>
				</li>
			</ul>
        </nav> -->
        
        <?php if ($pagination): ?>
            <div class="d-flex justify-content-center">
                <?= $pagination ?>
            </div>
        <?php else: ?>
            &nbsp;
        <?php endif ?>
        
    </div>