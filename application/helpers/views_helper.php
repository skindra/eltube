<?php
// Menseting flash message (redirect).
function view_video($id)
{
    $CI =& get_instance();
    $eltube = $CI->db->get_where('eltube',['id'=> $id])->row();
    if ($eltube == true) {
        $view = $eltube->views + 1 ;
        return $CI->db->update('eltube',['views' => $view], ['id' => $id]);
    }
}

