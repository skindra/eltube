<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/ijo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    
    <title><?=$judul?></title>
    <style>
    </style>
  </head>
  <body>

  
    <div class="atas">
        <div class="logo"><a href="<?=base_url()?>"><img src="<?=base_url();?>assets/logo.png"></a></div>
        <ul class="kananatas">
			<?php if($this->session->userdata('is_login') == true){
                echo "<li><a class='ka' href='upload.php'>UNGGAH</a></li>
                <li><a class='ka ki' href='hapus.php'>HAPUS</a></li>
                <li><a class='ka ki' href='edit.php'>EDIT</a></li>";
                if ($this->session->userdata('level') == 1) {
                    echo "<li><a class='ka ki' href='".base_url('Operator')."'>USER</a></li>";
                }
                echo "<li><a class='ka ki' href='".base_url('login/logout')."'>LOGOUT</a></li>";
			}else{
				echo "<li><a class='ka' href='".base_url('login')."'>ADMIN</a></li>";
			}
			?>
			
		</ul>
    </div>

    <?php $this->load->view($mainView);?>
      

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?=base_url()?>assets/bootstrap/js/jquery-3.5.1.slim.min.js" ></script>
    <script src="<?=base_url()?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js" ></script>
  </body>
</html>