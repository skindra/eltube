
	<div class="atas">
		<a href="../mobi" rel="external" class="home"><img src="<?=base_url('assets/')?>images/home.png"></a>
		<div class="container" onclick="">
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
		</div>
		<div class="logo"><a href="<?=base_url();?>"><img src="<?=base_url('assets/')?>logo.png"></a></div>
		<div id='search-box'>
			<form action='<?php echo base_url('pencarian/cari')?>' id='search-form' method='get' target='_top'>
				<input id='search-text' onfocus="this.value=''" name='judul' value="<?=$_GET['judul']??''?>" placeholder='Pencarian Video Disini...' type='text'/>
				<button id='search-button' type='submit'><span>Search</span></button>
			</form>
		</div>
		<!--<div class="search">
			<input type="text" name="search"><img src="img/cari.png">
		</div> -->
		<ul class="kananatas">
			<?php if($this->session->userdata('is_login') == true){
                echo "<li><a class='ka' href='".base_url('unggah')."'>UNGGAH</a></li>";
                echo "<li><a class='ka' href='".base_url('data')."'>DATA</a></li>";
                echo "<li><a class='ka' href='".base_url('kategori')."'>KATEGORI</a></li>";
                if ($this->session->userdata('level') == 1) {
                    echo "<li><a class='ka ki' href='".base_url('Operator')."'>USER</a></li>";
                }
                echo "<li><a class='ka ki' href='".base_url('login/logout')."'>LOGOUT</a></li>";
			}else{
				echo "<li><a class='ka' href='".base_url('login')."'>ADMIN</a></li>";
			}
			?>
			
		</ul>
		<!--<p><a href="#" onclick="tentang_buka()">Tentang </a> &nbsp; | &nbsp; &copy; 2017 ELFAN Video v1.0.0</p>-->
	</div>