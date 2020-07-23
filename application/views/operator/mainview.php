<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/ijo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style-home.css"> -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/styleVideo.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  
    <title><?=$judul?></title>
    <style>
    </style>
  </head>
  <body>

  
    <?php $this->load->view('_template/topbar'); ?>

    <?php $this->load->view($mainView);?>
      
    <?php $this->load->view('_template/footer');?>
    <?php $this->load->view('_template/navbar');?>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?=base_url()?>assets/bootstrap/js/jquery-3.5.1.min.js" ></script>
    <script src="<?=base_url()?>assets/bootstrap/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js" ></script>
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <?php $this->load->view('_template/javascript'); ?>
    <script>
    $(document).ready(function(){
        $( "select#kategori" ).change(function() {
            // console.log($(this).val() );
            let id = $(this).val();
            $.post('<?=base_url('unggah/kategori/')?>'+id, function( data ) {
                $('#subkategori').html(data);
            });
        });


        /* Modal */
        $('#tambahkategori').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = button.data('id')
            var judul = $(this)
            $.post('<?=base_url('unggah/modal/')?>'+modal, function( data ) {
                $(".modal-body").html(data);
                judul.find('.modal-title').text('Tambah ' + modal)
            });
        });

        /* Modal */
        $('#ubahmodalkategori').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = button.data('id')
            var judul = $(this)
            let id = $("#kategori").val();
            console.log('ok'+id);
            // $.post('<?=base_url('kategori/modalubah/')?>'+modal, function( data ) {
            //     $(".modal-body").html(data);
            //     judul.find('.modal-title').text('Tambah ' + modal)
            // });
        });

        $('.hapus-kategori').on('click',function(){
            let id = $("#kategori").val();
            var confirmText = "Are you sure you want to delete ?";
            if(confirm(confirmText)) {
                $.post('<?=base_url('kategori/hapuskategori/')?>'+id, function( data ) {
                    location.reload(); 
                });
            }
            return false;
        });

        $('.hapus-subkategori').on('click',function(){
            let id = $("#subkategori").val();
            var confirmText = "Are you sure you want to delete ?";
            if(confirm(confirmText)) {
                $.post('<?=base_url('kategori/hapussubkategori/')?>'+id, function( data ) {
                    location.reload(); 
                });
            }
            return false;
        });

        

    });


    function openLeftMenu() {
        $("#kolap").show();
    }
    function closeLeftMenu() {
        $("#kolap").fadeOut();
    }
</script>

<script>
        $(document).ready(function() {
            var t = $('#mytable').DataTable( {
                "ajax": '<?php echo base_url('data/data'); ?>',
                "order": [[ 2, 'asc' ]],
            } );
               
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        } );
    </script>
  </body>
</html>