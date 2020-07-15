<?php $this->load->view('_template/header');?>

<body>

<?php
    // Login?
    // $is_login = $this->session->userdata('is_login');

    $perPage = 36;
    $keywords = $this->input->get('keywords');

    if (isset($keywords)) {
        $page = $this->uri->segment(4);
    } else {
        $page = $this->uri->segment(3);
    }

    // No urut data tabel.
    $i = isset($page) ? $page * $perPage - $perPage : 0;
?>
    
	<?php $this->load->view('_template/topbar'); ?>

    
	<div class="tengah">
        <form class="form-inline" style="margin-left: 54px">
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option selected>Choose...</option>
                <option value="1">Terbaru</option>
                <option value="2">Banyak dilihat</option>
                <option value="3">Terfavorit</option>
            </select>

            <button type="submit" class="btn btn-primary my-1">Pilih</button>
        </form>
		<ul class='listview' >
			<?php $no=0; foreach ($video as $v ) {
				echo "<li class='gbr' data-toggle='tooltip' title='$v->judul' ><a href='video?play=$v->id'><img src='../../../video/uploads/$v->gambar' ></a>"."<font color='yellow' class='besar'>$v->kategori</font><p class='judul-video'>$v->judul</p></a></li>";
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

<script type="text/javascript">
$(".container").click(function() {
	$(".menu_kiri_bg").fadeIn(100);
	$(".menu_kiri").animate({left : "-0"});
});
$(".menu_kiri_bg").click(function() {
	$(".menu_kiri_bg").fadeOut(20);
	$(".menu_kiri").animate({left : "-100%"});
});

function tentang_buka() {
	$(".tentang_klik").show();
	$(".tentang").show();
}
function tentang_tutup() {
	$(".tentang_klik").hide();
	$(".tentang").hide();
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}
	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();
		$next.slideToggle();
		$this.parent().toggleClass('open');
		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	
	var accordion = new Accordion($('#accordion'), false);
});
</script>


</html>