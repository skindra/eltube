<?php $this->load->view('_template/header');?>

<body>

<?php
    // Login?
    // $is_login = $this->session->userdata('is_login');

    $perPage = 12;
    $keywords = $this->input->get('keywords');

    if (isset($keywords)) {
        $page = $this->uri->segment(3);
    } else {
        $page = $this->uri->segment(2);
    }

    // No urut data tabel.
    $i = isset($page) ? $page * $perPage - $perPage : 0;
?>
    
    <?php $this->load->view('_template/topbar'); ?>
	
	<div class="tengah">
		<h2 class="text-heading">Baru Upload </h2>
		<ul class='listview' >
			<?php $no=0; foreach ($baru_upload as $v ) {
				echo "<li class='gbr' data-toggle='tooltip' title='$v->judul' ><a href='video?play=$v->id'><img src='../../video/uploads/$v->gambar' ></a>"."<font color='yellow' class='besar'>$v->kategori</font><p class='judul-video'>$v->judul</p></a></li>";
			} ?>
        </ul>
		<h2 class="text-heading">Banyak Dilihat</h2>
		<ul class='listview' >
			<?php $no=0; foreach ($video as $v ) {
				echo "<li class='gbr' data-toggle='tooltip' title='$v->judul' ><a href='video?play=$v->id'><img src='../../video/uploads/$v->gambar' ></a>"."<font color='yellow' class='besar'>$v->kategori</font><p class='judul-video'>$v->judul</p></a></li>";
			} ?>
		</ul>
		<h2 class="text-heading">Video Lainnya</h2>
		<ul class='listview' >
			<?php $no=0; foreach ($viewer as $v ) {
				echo "<li class='gbr' data-toggle='tooltip' title='$v->judul' ><a href='video?play=$v->id'><img src='../../video/uploads/$v->gambar' ></a>"."<font color='yellow' class='besar'>$v->kategori</font><p class='judul-video'>$v->judul</p></a></li>";
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
    <?php $this->load->view('_template/footer');?>
    <?php $this->load->view('_template/navbar');?>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="<?=base_url()?>assets/bootstrap/js/jquery-3.5.1.slim.min.js" ></script> -->
    <script src="<?=base_url()?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js" ></script>

</body>

<?php $this->load->view('_template/javascript'); ?>


</html>