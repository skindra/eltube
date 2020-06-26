<?php
class Login_model extends MY_Model
{
    public $table = 'user';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|min_length[3]'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[3]'
            ],
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            'username' => '',
            'password' => ''
        ];
    }

    public function login($input)
    {
        $user = $this->db->where('username', $input->username)
                        ->limit(1)
                        ->get($this->table)
                        ->row();

        if ($user) {
            // rasmuslerdorf
            if (password_verify($input->password, $user->password)) {

                $this->session->set_userdata('nama' , $user->username);
                $this->session->set_userdata('level' , $user->role_user);
                $this->session->set_userdata('is_login' , true);
                return true;

            } else {
               return false;
            }
        }

        return false;
    }

    public function logout()
    {
        $data = ['nama', 'level','is_login'];
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
    }
}
