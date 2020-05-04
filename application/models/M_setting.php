<?php
class M_setting extends CI_Model
{
    public function get_user($id)
    {
        $query =  $this->db->get_where('tbl_user', array('id_user' => $id));
        return $query->row_array();
    }

    public function edit_password($id_user, $passwordlama, $pass)
    {
        $query =  $this->db->get_where('tbl_user', array('id_user' => $id_user))->row_array();
        if (password_verify($passwordlama, $query['password']))
        {
            return $this->db
                ->set('password', $pass)
                ->where('id_user', $id_user)
                ->update('tbl_user');
        }
        else {
            return false;
        }
    }

    public function edit_profile($username, $dt)
    {
        return $this->db
            ->where('username', $username)
            ->update('tbl_user', $dt);
    }
}
