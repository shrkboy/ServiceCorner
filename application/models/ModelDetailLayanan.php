<?php
/**
 * Created by PhpStorm.
 * User: mou5e
 * Date: 6/6/2018
 * Time: 1:09 AM
 */

class ModelDetailLayanan extends CI_Model
{
    public function getAll(){
        $query = $this->db->get('data_detail_layanan');
        return $query->result();
    }

    public function getbyId($data){
        $query = $this->db->get_where('data_detail_layanan', array('id_detail' => $data));
        return $query->row();
    }

    public function insertDetail($data){
        $this->db->insert('data_detail_layanan', $data);
    }
}