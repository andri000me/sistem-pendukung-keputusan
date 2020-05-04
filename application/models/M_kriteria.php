<?php
class M_kriteria extends CI_Model
{

    public function get_kode_kriteria()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode_kriteria,4)) AS kd_max FROM tbl_kriteria");
        $kd="";
        // $tmp = ((int)$q) +1;
        // $kd = sprintf("%04s", $tmp);
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return "K".$kd;
    }

    public function get_kriteria()
    {
        return $this->db->get('tbl_kriteria');
    }

    public function getAll()
    {
        $query = $this->get_kriteria();
        if($query->num_rows() > 0){
            foreach ( $query->result() as $row) {
                $kriterias[] = $row;
            }
            return $kriterias;
        }
    }

    public function insert_kriteria($dt)
    {
        return $this->db->insert('tbl_kriteria', $dt);
    }

    public function insert_sub_kriteria($dt)
    {
        return $this->db->insert('tbl_sub_kriteria', $dt);
    }

    public function delete_kriteria($kode)
    {
        return $this->db->delete('tbl_kriteria', array('kode_kriteria' => $kode));
    }

    public function delete_sub_kriteria($kode)
    {
        return $this->db->delete('tbl_sub_kriteria', array('kode_kriteria' => $kode));
    }

    public function get_kriteria_by_kode($kode)
    {
        $query =  $this->db->get_where('tbl_kriteria', array('kode_kriteria' => $kode ));
        return $query->row_array();
    }

    public function get_sub_kriteria_by_kode($kode)
    {
        return $query =  $this->db->get_where('tbl_sub_kriteria', array('kode_kriteria' => $kode ));
        
    }

    public function edit_kriteria($kodeKriteria, $dt)
    {
        return $this->db
                ->where('kode_kriteria', $kodeKriteria)
                ->update('tbl_kriteria', $dt);
    }

    public function edit_sub_kriteria($dt, $kodeKriteria)
    {
        $q = $this->db->delete('tbl_sub_kriteria', array('kode_kriteria' => $kodeKriteria));
        if($q){
            return $this->db->insert('tbl_sub_kriteria', $dt);
        }
        
    }

    public function getBobotKriteria()
    {
        $query = $this->db->query('select kriteria, bobot from tbl_kriteria');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $bobot[] = $row;
            }
            return $bobot;
        }
    }
}