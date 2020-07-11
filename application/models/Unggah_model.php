<?php
class Unggah_model extends MY_Model
{
    public $table = 'eltube';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'judul',
                'label' => 'Judul Video',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'id_kategori',
                'label' => 'Kategori',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'id_subkategori',
                'label' => 'Sub Kategori',
                'rules' => 'trim|required'
            ],
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            'judul'          => '',
            'id_kategori'    => '',
            'id_subkategori' => '',
        ];
    }

    public function simpan($input)
    {
        

            $data = array(
                'id'             => $input->id,
                'judul'          => $input->judul,
                'id_kategori'    => $input->id_kategori,
                'id_subkategori' => $input->id_subkategori,
                'Isi'            => $input->Isi,
                'gambar'         => $input->gambar,
                'barcode'        => $input->barcode,

            );

            
            $this->db->insert('eltube',$data);
            return true;

    }
    public function simpanUpload($input)
    {
        
        $no = $this->db->query("select id from eltube order by id DESC LIMIT 1")->row_array();
        $nn = $no['id']+1;;
        $input->id_eltube = $nn;
        $data = 'Some file data';
        // Memanggil Qrcode;
        $Qr = $this->qrCode($input);
        if ( ! $Qr)
        {
                return false;
        }
        else
        {

            $data = array(
                'id'             => $nn,
                'judul'          => $input->judul,
                'id_kategori'    => $input->id_kategori,
                'id_subkategori' => $input->id_subkategori,
                'Isi'            => $input->Isi,
                'gambar'         => $input->gambar,
                'barcode'        => $input->uniq.".png",

            );

            
            $this->db->insert('eltube',$data);
            return true;
        }

    }

    
    
    /* Upload Gambar */
    function upload_gambar($fieldname)
    {
        $config_g = [
            'upload_path'      => '../video/uploads/',
            'allowed_types'    => 'jpg|png|jpeg',    // Hanya *.jpg saja
            'max_size'         => 20024,     // 100MB
            // 'max_width'        => 0,
            // 'max_height'       => 0,
            'overwrite'        => true,
            'file_ext_tolower' => true,
        ];

        
        $this->load->library('upload', $config_g);
        $this->upload->initialize($config_g);
        if ($this->upload->do_upload($fieldname)) {
            // Upload OK, return uploaded file info.
            return $this->upload->data();
        } else {
            // Add error to $_error_array
            $this->form_validation->add_to_error_array($fieldname, $this->upload->display_errors('', ''));
            return false;
        }
    }
    /* Upload Video */
    function upload_video($fieldname)
    {
        $config = [
            'upload_path'      => '../video/uploads/',
            'allowed_types'    => 'mp4|3gp',    // Hanya *.mp4 saja
            'max_size'         => 200024,     // 200MB
            // 'max_width'        => 0,
            // 'max_height'       => 0,
            // 'overwrite'        => true,
            // 'file_ext_tolower' => true,
        ];

        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload($fieldname)) {
            // Upload OK, return uploaded file info.
            return $this->upload->data();
        } else {
            // Add error to $_error_array
            $this->form_validation->add_to_error_array($fieldname, $this->upload->display_errors('', ''));
            return false;
        }
    }
    
    function qrCode($input){
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = 'upload/barcode/'; //string, the default is application/cache/
        $config['errorlog']     = 'upload/barcode/'; //string, the default is application/logs/
        $config['imagedir']     = "./upload/barcode/"; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$input->uniq.'.png'; //buat name dari qr code sesuai dengan nim
        $nim = 'http://bookless.id/video/video?play='.$input->id_eltube; //string keluar dari qrcode;
        $params['data'] = $nim; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params);
        // PEMBERIAN lOGO
        $logopath = 'assets/logo.png';
        //tempat qrcode
        $filepath = "/var/www/html/eltube/upload/barcode/".$image_name;
        $QR = imagecreatefrompng($filepath);

        // START TO DRAW THE IMAGE ON THE QR CODE
        $logo = imagecreatefromstring(file_get_contents($logopath));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);

        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);

        // Scale logo to fit in the QR Code
        $logo_qr_width = $QR_width/3;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;

        imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

        // Save QR code again, but with logo on it
        return imagepng($QR,$filepath);

        // End DRAWING LOGO IN QR CODE

    }

    
    function gen_qr($data){
        // outputs image directly into browser, as PNG stream 
        QRcode::png(urlencode($data), false, QR_ECLEVEL_M, 19, 1);
   }

}
