<?php
class Home_model extends MY_Model
{
    public $table = 'david';
    protected $perPage = 36;

    public function getAllVideo($page = null)
    {
        $offset = $this->calculateRealOffset($page);

        $sql = "select * from david limit $this->perPage offset $offset ";

        return $this->db->query($sql)->result();

    }

    public function logout()
    {
        $data = ['username', 'isLogin'];
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
    }
}
