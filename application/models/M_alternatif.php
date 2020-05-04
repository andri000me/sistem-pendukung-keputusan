<?php
class M_alternatif extends CI_Model
{
    public function get_kode_alternatif()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode_alternatif,4)) AS kd_max FROM tbl_alternatif");
        $kd="";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return "A".$kd;
    }
    public function getAll()
    {
        $alternatif = array();
        $query = $this->db->get('tbl_alternatif');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $alternatif[] = $row;
            }
        }
        return $alternatif;
    }
    public function get_kriteria()
    {
        $query = "
        SELECT * FROM tbl_kriteria 
            LEFT JOIN tbl_sub_kriteria ON tbl_kriteria.`kode_kriteria` = tbl_sub_kriteria.`kode_kriteria`
        ";
        $this->db->get($query);
    }

    public function get_alternatif_by_kode($kode)
    {
        $query =  $this->db->get_where('tbl_alternatif', array('kode_alternatif' => $kode));
        return $query->row_array();
    }
    
    public function getNilaiById($kode)
    {
        $query = $this->db->query(
            "SELECT
                a.kode_alternatif, 
                a.alternatif, 
                k.kode_kriteria, 
                n.nilai 
            FROM tbl_alternatif a, tbl_nilai_alternatif n, tbl_kriteria k, tbl_sub_kriteria sk 
            WHERE a.kode_alternatif = n.kode_alternatif AND k.kode_kriteria = n.kode_kriteria and k.kode_kriteria = sk.kode_kriteria and a.kode_alternatif = '$kode' GROUP by k.kode_kriteria "
        );
        
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function get_alternatif()
    {
        return $this->db->get('tbl_alternatif');
    }

    public function get_kriteria1()
    {
        return $this->db->get('tbl_kriteria');
    }

    public function get_subkriteria($a)
    {
        $sql = "tbl_sub_kriteria where kode_kriteria = '$a'";
        return $this->db->get($sql)->result_array();
    }

    public function getById($kodekri)
    {
        $this->db->where('kode_kriteria',$kodekri);
        $query = $this->db->get('tbl_sub_kriteria');

        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $subkriteria[] = $row;
            }
            return $subkriteria;
        }
    }

    public function insert_alternatif($dt)
    {
        return $this->db->insert('tbl_alternatif', $dt);
    }

    public function insert_nilai_alternatif($dtNilai)
    {
        return $this->db->insert('tbl_nilai_alternatif', $dtNilai);
    }

    public function delete_alternatif($kode)
    {
        return $this->db->delete('tbl_alternatif', array('kode_alternatif' => $kode));
    }

    public function delete_nilai_alternatif($kode)
    {
        return $this->db->delete('tbl_nilai_alternatif', array('kode_alternatif' => $kode));
    }

    public function get_nilai_alternatif_by_kode($kode)
    {
        return  $this->db->query(
                    "SELECT 
                        a.kode_alternatif, 
                        a.alternatif, 
                        k.kode_kriteria,
                        k.kriteria, 
	                    sk.keterangan,
                        n.nilai 
                    FROM tbl_alternatif a, tbl_nilai_alternatif n, tbl_kriteria k, tbl_sub_kriteria sk 
                    WHERE 
                        a.kode_alternatif = n.kode_alternatif AND 
                        k.kode_kriteria = n.kode_kriteria AND 
                        k.kode_kriteria = sk.kode_kriteria AND
                        n.kode_kriteria = sk.kode_kriteria AND
                        n.nilai = sk.nilai AND 
                        a.kode_alternatif = '$kode' GROUP BY k.kode_kriteria "
                );


    }

    public function get_nilai_alternatif($kode)
    {
        return $this->db->query(
            "SELECT 
            a.kode_alternatif,
            a.alternatif,
            k.kriteria,
            n.nilai
            FROM tbl_alternatif a, tbl_nilai_alternatif n, tbl_kriteria k, tbl_sub_kriteria sk 
            WHERE a.kode_alternatif = n.kode_alternatif
            AND k.kode_kriteria = n.kode_kriteria
            AND k.kode_kriteria = sk.kode_kriteria
            AND a.kode_alternatif = '$kode' 
                P BY k.kode_kriteria ");
    }

    public function getNilaiAlt()
    {
        $query = $this->db->query(
            'select u.kode_alternatif, u.alternatif, k.kode_kriteria, k.kriteria ,n.nilai from tbl_alternatif u, tbl_nilai_alternatif n, tbl_kriteria k where u.kode_alternatif = n.kode_alternatif AND k.kode_kriteria = n.kode_kriteria '
        );
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function edit_alternatif($dt, $kodeAlternatif)
    {
        return $this->db
            ->where('kode_alternatif', $kodeAlternatif)
            ->update('tbl_alternatif', $dt);
    }

    public function edit_nilai_alternatif($dtNilai, $kodeAlternatif, $kodeKriteria)
    {
        return $this->db
            ->where('kode_alternatif', $kodeAlternatif)
            ->where('kode_kriteria', $kodeKriteria)
            ->update('tbl_nilai_alternatif', $dtNilai);
    }

    public function delete_all_alternatif()
    {
        return $this->db->query("DELETE FROM tbl_alternatif");
    }
}