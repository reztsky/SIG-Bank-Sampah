<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk')!='masuk'){
			$url=base_url();
			redirect($url);
		}
		$this->load->model('m_utama');
		$this->load->library('datatables');
	}
	public function load_kelurahan(){
		$model=$this->m_utama;
		$id=$this->input->post('id');
		$coba=$this->input->post('coba');
		$hasil=$model->load_kelurahan($id);
		if($hasil->num_rows()>0){
			echo '<optin value=0>Pilih Kelurahan</option>';
			foreach ($hasil->result() as $row) {
				if($row->id_kelurahan==$coba){
					echo '<option value='.$row->id_kelurahan.' selected="true">'.$row->nama_kelurahan.'</option>';	
				}else echo '<option value='.$row->id_kelurahan.'>'.$row->nama_kelurahan.'</option>';
			}
		}else echo '<optin value=0>Pilih Kelurahan</option>';
	}
	public function index(){
		$model=$this->m_utama;
		$this->load->view('head_admin');
		$this->load->view('admin_index');
		$this->load->view('foot_admin');
	}
	public function tambah_pengepul(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$hasil=$model->load_kecamatan();
		$pengepul=$model->load_pengepul('','');
		$this->load->view('head_admin',array('hasil'=>$kelurahan));
		$this->load->view('form_tambah_pengepul',array('hasil'=>$hasil,'pengepul'=>$pengepul));
		$this->load->view('foot_admin');
	}
	public function tambah_bank(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$hasil=$model->load_kecamatan();
		$bank_sampah=$model->load_bank_sampah('','');
		$this->load->view('head_admin',array('hasil'=>$kelurahan));
		$this->load->view('form_tambah_bank',array('hasil'=>$hasil,'bank_sampah'=>$bank_sampah));
		$this->load->view('foot_admin');
	}
	public function tambah_jenis_sampah(){
		$model=$this->m_utama;
		//$kelurahan=$model->kelurahan();
		//$hasil=$model->load_kecamatan();
		$jenis_sampah=$model->load_jenis_sampah();
		$count_jenis_sampah=$model->count_jenis_sampah();
		//unset($_SESSION['message']);
		$this->load->view('head_admin');
		$this->load->view('form_tambah_jenis_sampah',array('jenis_sampah'=>$jenis_sampah,'count_jenis_sampah'=>$count_jenis_sampah));
		$this->load->view('foot_admin');	
	}
	public function edit_ajax_jenis_sampah(){
		$id_jenis=$_GET['kode'];
		$model=$this->m_utama;
		$model->edit_ajax_jenis_sampah($id_jenis);
	}
	public function rekap_transaksi_masuk_pengepul(){
		$model=$this->m_utama;
		$rekap=$model->rekap_transaksi_masuk_pengepul();
		$jenis_sampah=$model->load_jenis_sampah();
		$this->load->view('head_admin');
		$this->load->view('rekap_transaksi_masuk_pengepul',array('rekap'=>$rekap,'jenis_sampah'=>$jenis_sampah));
		$this->load->view('foot_admin');	
	}
	public function rekap_transaksi_masuk_bank(){
		$model=$this->m_utama;
		$rekap=$model->rekap_transaksi_masuk_bs();
		$jenis_sampah=$model->load_jenis_sampah();
		$this->load->view('head_admin');
		$this->load->view('rekap_transaksi_masuk_bs',array('rekap'=>$rekap,'jenis_sampah'=>$jenis_sampah));
		$this->load->view('foot_admin');
	}
	public function rekap_transaksi_masuk_pengepul_excel(){
		$model=$this->m_utama;
		$rekap=json_decode($_GET['data']);
		$data=$rekap[0];
		$this->load->view('rekap_transaksi_masuk_pengepul_excel',array('rekap'=>$data,'title'=>'Laporan Rekap Transaksi Masuk pengepul'));
	}
	public function rekap_transaksi_masuk_bs_excel(){
		$model=$this->m_utama;
		$rekap=json_decode($_GET['data']);
		$data=$rekap[0];
		$this->load->view('rekap_transaksi_masuk_bs_excel',array('rekap'=>$data,'title'=>'Laporan Rekap Transaksi Masuk Bank Sampah'));
	}
	public function rekap_transaksi_keluar_pengepul(){
		$model=$this->m_utama;
		$rekap=$model->rekap_transaksi_keluar_pengepul();
		$jenis_sampah=$model->load_jenis_sampah();
		$this->load->view('head_admin');
		$this->load->view('rekap_transaksi_keluar_pengepul',array('rekap'=>$rekap,'jenis_sampah'=>$jenis_sampah));
		$this->load->view('foot_admin');
	}
	public function rekap_transaksi_keluar_pengepul_excel(){
		$model=$this->m_utama;
		$rekap=json_decode($_GET['data']);
		$data=$rekap[0];
		$this->load->view('rekap_transaksi_masuk_bs_excel',array('rekap'=>$data,'title'=>'Laporan Rekap Transaksi Masuk Bank Sampah'));
	}
	public function rekap_transaksi_keluar_bs(){
		$model=$this->m_utama;
		$rekap=$model->rekap_transaksi_keluar_bs();
		$jenis_sampah=$model->load_jenis_sampah();
		$this->load->view('head_admin');
		$this->load->view('rekap_transaksi_keluar_bs',array('rekap'=>$rekap,'jenis_sampah'=>$jenis_sampah));
		$this->load->view('foot_admin');
	}
	public function rekap_transaksi_keluar_bs_excel(){
		$model=$this->m_utama;
		$rekap=json_decode($_GET['data']);
		$data=$rekap[0];
		$this->load->view('rekap_transaksi_masuk_bs_excel',array('rekap'=>$data,'title'=>'Laporan Rekap Transaksi Masuk Bank Sampah'));
	}
}