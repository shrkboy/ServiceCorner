<?php
/**
 * Created by PhpStorm.
 * User: mou5e
 * Date: 6/26/2018
 * Time: 1:05 PM
 */

class PartStok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->model('ModelSparepart');
        $user_id=$this->session->userdata('id_kasir');
        $user_role=$this->session->userdata('username');

        $data['data'] = $this->ModelSparepart->getAll();
        $data['user_role'] = $this->session->userdata('role');
        if ($user_id && $user_role){
            $this->load->view('datasparepart', $data);
        }
    }

    public function stok($id_stok){
        $user_id=$this->session->userdata('id_kasir');
        $user_role=$this->session->userdata('username');
        if ($user_id && $user_role) {
            $this->load->model('ModelSparepart');

            //$id_master = '46';
            $data['data'] = $this->ModelSparepart->getbyId($id_stok);

            if ($id_stok) {
                $this->load->view('stok', $data);
            } else {
                redirect(base_url('partstok'));
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    public function updateStok(){
        $user_id=$this->session->userdata('id_kasir');
        $user_role=$this->session->userdata('username');
        if ($user_id && $user_role) {
            $this->load->model('ModelSparepart');

            $data=array(
                'id_part'=>$this->input->post('id_part'),
                'nama'=>$this->input->post('nama'),
                'harga'=>$this->input->post('harga'),
                'stok'=> $this->input->post('stok')
            );
            $this->ModelSparepart->addStok($data);
            redirect(base_url('partstok'));

        }
        else
        {
            redirect(base_url());
        }
    }

    public function addSparepart(){
        $user_id=$this->session->userdata('id_kasir');
        $user_role=$this->session->userdata('username');
        if ($user_id && $user_role) {
            $this->load->model('ModelSparepart');

            $data=array(
                'id_part'=>$this->input->post('id_part'),
                'nama'=>$this->input->post('nama'),
                'harga'=>$this->input->post('harga'),
                'stok'=> $this->input->post('stok')
            );
            $this->ModelSparepart->insertSparepart($data);

            print_r($data);
            redirect(base_url('partstok'));

        }
        else
        {
            redirect(base_url());
        }
    }

}