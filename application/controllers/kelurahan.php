<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan extends CI_Controller {
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
		$hasil=$model->load_kelurahan($id);
		if($hasil->num_rows()>0){
			echo '<option value="0">Pilih Kelurahan</option>';
			foreach ($hasil->result() as $row) {
				echo '<option value="'.$row->id_kelurahan.'">'.$row->nama_kelurahan.'</option>';
			}
		}else echo '<optin value="0">Pilih Kelurahan</option>';
	}
	public function index()
	{
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$this->load->view('head_kelurahan',array('hasil'=>$kelurahan));
		$this->load->view('index_kelurahan');
		$this->load->view('foot_kelurahan');
	}
	public function tambah_pengepul(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$hasil=$model->load_kecamatan();
		$kecamatan=$model->load_kecamatan_base_kelurahan($kelurahan->result()[0]->id_kelurahan);
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		$id_kecamatan=$kecamatan->result()[0]->id_kecamatan;
		$pengepul=$model->load_pengepul($id_kelurahan,$id_kecamatan);
		//unset($_SESSION['message']);
		$this->load->view('head_kelurahan',array('hasil'=>$kelurahan));
		$this->load->view('form_tambah_pengepul',array('hasil'=>$hasil,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan,'pengepul'=>$pengepul));
		$this->load->view('foot_kelurahan');
	}
	public function tambah_bank(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$hasil=$model->load_kecamatan();
		$kecamatan=$model->load_kecamatan_base_kelurahan($kelurahan->result()[0]->id_kelurahan);
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		$id_kecamatan=$kecamatan->result()[0]->id_kecamatan;
		$bank_sampah=$model->load_bank_sampah($id_kelurahan,$id_kecamatan);
		
		$this->load->view('head_kelurahan',array('hasil'=>$kelurahan));
		$this->load->view('form_tambah_bank',array('hasil'=>$hasil,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan,'bank_sampah'=>$bank_sampah));
		$this->load->view('foot_kelurahan');
	}
	public function insert_bank(){
		$model=$this->m_utama;
		$hasil=$model->insert_bank($_POST['nama_penanggung'],$_POST['nama_bank'],$_POST['no_telp'],$_POST['jumlah_nasabah'],$_POST['alamat'],$_POST['kelurahan'],$_POST['kecamatan'],$_POST['latitude'],$_POST['longtitude'],$_POST['keterangan_lokasi']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			redirect('kelurahan/tambah_bank');
		}
	}

	public function insert_pengepul(){
		$model=$this->m_utama;
		if(!isset($_POST['jumlah_pegawai'])){
			$jumlah_pegawai=0;
		}else $jumlah_pegawai=$_POST['jumlah_pegawai'];
		$hasil=$model->insert_pengepul($_POST['nama_penanggung'],$_POST['nama_pengepulan'],$_POST['no_telp'],$jumlah_pegawai,$_POST['alamat'],$_POST['kelurahan'],$_POST['kecamatan'],$_POST['latitude'],$_POST['longtitude'],$_POST['keterangan_lokasi']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			redirect('kelurahan/tambah_pengepul');
		}

	}
	public function transaksi_masuk(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$jenis_sampah=$model->jenis_sampah();
		$pengepul=$model->pengepul($kelurahan);
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		$data=array('jenis_sampah'=>$jenis_sampah,'pengepul'=>$pengepul);
		$transaksi_masuk=$model->load_transaksi_masuk_pengepul($id_kelurahan);
		$this->load->view('head_kelurahan',array('hasil'=>$kelurahan));
		$this->load->view('transaksi_masuk',array('data'=>$data,'transaksi_masuk_pengepul'=>$transaksi_masuk));
		$this->load->view('foot_kelurahan');
	}
	public function insert_transaksi_pengepul(){
		$model=$this->m_utama;
		$hasil=$model->insert_transaksi_pengepul($_POST['tanggal'],$_POST['jenis_sampah'],$_POST['pengepul'],$_POST['berat']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			redirect('kelurahan/transaksi_masuk');
		}else {
			$this->session->set_flashdata('message','<h3>Data Gagal Ditambahkan</h3>');
			redirect('kelurahan/transaksi_masuk');
		}

	}
	public function transaksi_masuk_bs(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$jenis_sampah=$model->jenis_sampah();
		$hasil=$model->load_kecamatan();
		$kecamatan=$model->load_kecamatan_base_kelurahan($kelurahan->result()[0]->id_kelurahan);
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		$id_kecamatan=$kecamatan->result()[0]->id_kecamatan;
		$bank_sampah=$model->load_bank_sampah($id_kelurahan,$id_kecamatan);
		$data=array('jenis_sampah'=>$jenis_sampah,'bank_sampah'=>$bank_sampah);
		$transaksi_masuk_bs=$model->load_transaksi_masuk_bs($id_kelurahan);
		$this->load->view('head_kelurahan',array('hasil'=>$kelurahan));
		$this->load->view('transaksi_masuk_bs',array('data'=>$data,'transaksi_masuk_bs'=>$transaksi_masuk_bs));
		$this->load->view('foot_kelurahan');
	}
	public function insert_transaksi_bs(){
		$model=$this->m_utama;
		$hasil=$model->insert_transaksi_bs($_POST['tanggal'],$_POST['jenis_sampah'],$_POST['bank_sampah'],$_POST['berat']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			redirect('kelurahan/transaksi_masuk_bs');
		}else {
			$this->session->set_flashdata('message','<h3>Data Gagal Ditambahkan</h3>');
			redirect('kelurahan/transaksi_masuk_bs');
		}
	}
	public function transaksi_keluar(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$jenis_sampah=$model->jenis_sampah();
		$pengepul=$model->pengepul($kelurahan);
		$transaksi_keluar_pengepul=$model->load_transaksi_keluar_pengepul($kelurahan->result()[0]->id_kelurahan);
		$data=array('jenis_sampah'=>$jenis_sampah,'pengepul'=>$pengepul);
		$this->load->view('head_kelurahan',array('hasil'=>$kelurahan));
		$this->load->view('transaksi_keluar',array('data'=>$data,'transaksi_keluar'=>$transaksi_keluar_pengepul));
		$this->load->view('foot_kelurahan');
	}
	public function insert_transaksi_keluar_pengepul(){
		$model=$this->m_utama;
		$hasil=$model->insert_transaksi_keluar_pengepul($_POST['tanggal'],$_POST['pengepul'],$_POST['jenis_sampah'],$_POST['berat'],$_POST['tujuan']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			redirect('kelurahan/transaksi_keluar');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Ditambahkan</h3>');
			redirect('kelurahan/transaksi_keluar');
		}
	}
	public function transaksi_keluar_bs(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$jenis_sampah=$model->jenis_sampah();
		$hasil=$model->load_kecamatan();
		$kecamatan=$model->load_kecamatan_base_kelurahan($kelurahan->result()[0]->id_kelurahan);
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		$id_kecamatan=$kecamatan->result()[0]->id_kecamatan;
		$bank_sampah=$model->load_bank_sampah($id_kelurahan,$id_kecamatan);
		$transaksi_keluar_bs=$model->load_transaksi_keluar_bs($id_kelurahan);
		$data=array('jenis_sampah'=>$jenis_sampah);
		$this->load->view('head_kelurahan',array('hasil'=>$kelurahan));
		$this->load->view('transaksi_keluar_bs',array('data'=>$data,'bank_sampah'=>$bank_sampah,'transaksi_keluar_bs'=>$transaksi_keluar_bs));
		$this->load->view('foot_kelurahan');
	}
	public function insert_transaksi_keluar_bs(){
		$model=$this->m_utama;
		$hasil=$model->insert_transaksi_keluar_bs($_POST['tanggal'],$_POST['jenis_sampah'],$_POST['bank_sampah'],$_POST['berat'],$_POST['tujuan']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			redirect('kelurahan/transaksi_keluar_bs');
		}else {
			$this->session->set_flashdata('message','<h3>Data Gagal Ditambahkan</h3>');
			redirect('kelurahan/transaksi_keluar_bs');
		}
	}
}
