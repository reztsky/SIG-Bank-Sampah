<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_utama extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_utama');
	}
	public function index()
	{
		$this->load->view('head_index');
		$this->load->view('index');
		$this->load->view('foot_index');
	}
	public function proses_login(){
		$model=$this->m_utama;
		$login=$model->ceklogin($_POST['user'],$_POST['pass']);
		if($login->num_rows()>0){
			$data=$login->row_array();
			if($data['level']=='admin'){
				$this->session->set_userdata('masuk','masuk');
				$this->session->set_userdata('level',$data['level']);
                $this->session->set_userdata('ses_user',$data['username']);
                $this->session->set_userdata('ses_pass',$data['password']);
                redirect('c_admin');
			}else if($data['level']=='kelurahan'){
				$this->session->set_userdata('masuk','masuk');
				$this->session->set_userdata('level',$data['level']);
                $this->session->set_userdata('ses_user',$data['username']);
                $this->session->set_userdata('ses_pass',$data['password']);
                redirect('kelurahan');
			}
		}
	}
	public function logout(){
		$this->session->sess_destroy();
        $url=base_url();
        redirect($url);
	}
	public function peta_index(){
		$this->load->view('head_index');
		$model=$this->m_utama;
		$hasil=$model->load_peta_pengepul();
		$bank=$model->load_peta_bank_sampah();
		$this->load->view('peta_index',array('hasil'=>$hasil,'bank'=>$bank));
		$this->load->view('foot_index');
	}
}
