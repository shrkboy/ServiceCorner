<?php
/**
 * Created by PhpStorm.
 * User: mou5e
 * Date: 6/6/2018
 * Time: 12:09 AM
 */

class ModelKasir extends CI_Model
{
    public function getAll(){
        $query = $this->db->get('data_kasir');
        return $query->result();
    }

    public function getbyId($data){
        $query = $this->db->get_where('data_kasir', array('id_kasir' => $data));
        return $query->row();
    }

    public function login($id,$pass){

        $query = $this->db->get_where('data_kasir', array('id_kasir' => $id, 'hash_password' => $pass));

        if($query->result())
        {
            return $query->row();
        }
        else{
            return false;
        }
    }

    public function insertKasi($data){
        $this->db->insert('data_kasir', $data);
    }
}