<?php
/**
 * Created by PhpStorm.
 * User: mou5e
 * Date: 6/6/2018
 * Time: 4:28 AM
 */

class Kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('m_grafik');
        $this->load->model('ModelPelanggan');
        $this->load->model('ModelLayanan');
        $this->load->model('ModelSparepart');
        $this->load->model('ModelMaster');
    }

    public function index()
    {
        $user_id=$this->session->userdata('id_kasir');
        $user_role=$this->session->userdata('username');
        $role = $this->session->userdata('role');
        if ($user_id && $user_role){
            $x['data']=$this->m_grafik->get_data_stok();
            $x['layanan']=$this->m_grafik->get_detail_layanan();
            $x['countPel'] = $this->ModelPelanggan->countData();
            $x['countLay'] = $this->ModelLayanan->countData();
            $x['profit'] = $this->ModelMaster->getProfit();
            $x['partsale'] = $this->ModelSparepart->countSale();
            $x['user_role'] = $this->session->userdata('role');
            $x['master'] = $this->ModelMaster->getMergePelanggan();
            //print_r($x);
            if ($role == 'admin'){
                $this->load->view("Dashboard.php", $x);
            }
            else {
                $this->load->view("Transaksi.php", $x);
            }

        }
        else{
            redirect(base_url());
        }
    }

    function transaksi(){
        $x['data']=$this->m_grafik->get_data_stok();
        $x['layanan']=$this->m_grafik->get_detail_layanan();
        $x['countPel'] = $this->ModelPelanggan->countData();
        $x['countLay'] = $this->ModelLayanan->countData();
        $x['profit'] = $this->ModelMaster->getProfit();
        $x['partsale'] = $this->ModelSparepart->countSale();
        $x['user_role'] = $this->session->userdata('role');
        $x['master'] = $this->ModelMaster->getMergePelanggan();
        $user_id=$this->session->userdata('id_kasir');
        $user_role=$this->session->userdata('username');
        if ($user_id && $user_role){
            $this->load->view("Transaksi.php", $x);
        }
        else{
            redirect(base_url());
        }
    }

    function login(){
        $this->load->model('ModelKasir');
        $user_login=array(
            'username'=>$this->input->post('username'),
            'user_password'=>md5($this->input->post('password'))
        );

        $data=$this->ModelKasir->login($user_login['username'],$user_login['user_password']);
        if($data)
        {
            $this->session->set_flashdata('success_msg', 'Login Success');

            $this->session->set_userdata('id_kasir', $data['id_kasir']);
            $this->session->set_userdata('username', $data['username']);
            $this->session->set_userdata('role', $data['role']);

            echo $this->session->flashdata('success_msg');

            redirect(base_url('kasir'));
        }
        else{
            $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
            //redirect(base_url().'home');
            echo $this->session->flashdata('error_msg');
            echo $this->input->post('password');
            print_r($user_login);
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }
}