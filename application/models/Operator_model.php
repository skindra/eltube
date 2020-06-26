<?php
class Operator_model extends MY_Model
{
    public $table = 'user';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|max_length[10]|min_length[2]'
            ],
            [
                'field' => 'ulangipassword',
                'label' => 'Ulangi Password',
                'rules' => 'trim|required|matches[password]'
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
        $input->password = md5($input->password);

        $user = $this->db->where('username', $input->username)
                         ->where('password',$input->password)
                         ->where('status','on')
                         ->limit(1)
                         ->get($this->table)
                         ->row();

        if ($user) {
            $data = [
                'username' => $user->username,
                'isLogin'  => true,
            ];
            $this->nativesession->set('username' , $user->username);
            $this->nativesession->set('level' , $user->level);
            $this->nativesession->set('isLogin' , true);
            return true;
        }

        return false;
    }

    public function logout()
    {
        $data = ['username', 'isLogin'];
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
    }
}
