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

}
