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

}
