<?php
class M_admin extends CI_Model
{
    public function get_user()
    {
        return $this->db->get('tbl_user');
    }

    public function get_user_by_kode($id)
    {
        $query =  $this->db->get_where('tbl_user', array('id_user' => $id));
        return $query->row_array();
    }

    public function insert_user($dt)
    {
        return $this->db->insert('tbl_user', $dt);
    }
    public function delete_user($id)
    {
        return $this->db->delete('tbl_user', array('id_user' => $id));
    }
}
