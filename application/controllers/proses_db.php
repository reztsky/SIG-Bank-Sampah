<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_db extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_utama');
		$this->load->library('datatables');
	}
	public function insert_bank(){
		$model=$this->m_utama;
		$hasil=$model->insert_bank($_POST['id_bank_sampah'],$_POST['id_lokasi'],$_POST['nama_penanggung'],$_POST['nama_bank'],$_POST['no_telp'],$_POST['jumlah_nasabah'],$_POST['alamat'],$_POST['kelurahan'],$_POST['kecamatan'],$_POST['latitude'],$_POST['longtitude'],$_POST['keterangan_lokasi']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_bank');
			}else redirect('c_admin/tambah_bank');
			
		}elseif ($hasil==2) {
			$this->session->set_flashdata('message','<h3>Data Gagal Ditambahkan</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_bank');
			}else redirect('c_admin/tambah_bank');
		}elseif ($hasil==3) {
			$this->session->set_flashdata('message','<h3>Data Berhasil Diupdate/Diubah</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_bank');
			}else redirect('c_admin/tambah_bank');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Diupdate/Diubah</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_bank');
			}else redirect('c_admin/tambah_bank');
		}
	}
	public function hapus_bs(){
		$id_bank_sampah=$_GET['kode'];
		$id_lokasi=$_GET['id_lokasi'];
		$model=$this->m_utama;
		$hasil=$model->hapus_bs($id_bank_sampah,$id_lokasi);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil DiHapus</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_bank');
			}else redirect('c_admin/tambah_bank');
			
		}
	}
	public function edit_ajax_bs_kelurahan(){
		$model=$this->m_utama;		
		$model->edit_ajax_bs_kelurahan($_GET['id_bank_sampah']);
	}
	public function insert_pengepul(){
		$model=$this->m_utama;
		if(!isset($_POST['jumlah_pegawai'])){
			$jumlah_pegawai=0;
		}else $jumlah_pegawai=$_POST['jumlah_pegawai'];
		$hasil=$model->insert_pengepul($_POST['id_pengepul'],$_POST['id_lokasi'],$_POST['nama_penanggung'],$_POST['nama_pengepulan'],$_POST['no_telp'],$jumlah_pegawai,$_POST['alamat'],$_POST['kelurahan'],$_POST['kecamatan'],$_POST['latitude'],$_POST['longtitude'],$_POST['keterangan_lokasi']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_pengepul');
			}else redirect('c_admin/tambah_pengepul');
		}elseif ($hasil==2) {
			$this->session->set_flashdata('message','<h3>Data Gagal Ditambahkan</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_pengepul');
			}else redirect('c_admin/tambah_pengepul');
		}elseif ($hasil==3) {
			$this->session->set_flashdata('message','<h3>Data Berhasil Diupdate/Diubah</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_pengepul');
			}else redirect('c_admin/tambah_pengepul');
		}else{
			$$this->session->set_flashdata('message','<h3>Data Gagal Diupdate/Diubah</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_pengepul');
			}else redirect('c_admin/tambah_pengepul');
		}
	}
	public function edit_ajax_pengepul(){
		$model=$this->m_utama;		
		$model->edit_ajax_pengepul($_GET['id_pengepul']);
	}
	public function hapus_peng(){
		$id_pengepul=$_GET['kode'];
		$id_lokasi=$_GET['id_lokasi'];
		$model=$this->m_utama;
		$hasil=$model->hapus_peng($id_pengepul,$id_lokasi);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil DiHapus</h3>');
			if ($this->session->userdata('level')!='admin') {
				redirect('kelurahan/tambah_pengepul');
			}else redirect('c_admin/tambah_pengepul');
			
		}
	}
	public function update_ajax_jenis_sampah(){
		$model=$this->m_utama;
		$hasil=$model->update_ajax_jenis_sampah($_POST['id_jenis'],$_POST['nama_jenis']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Diupdate / Diubah</h3>');
			redirect('c_admin/tambah_jenis_sampah');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Diupdate / Diubah</h3>');
			redirect('c_admin/tambah_jenis_sampah');
		}
	}
	public function insert_jenis_sampah(){
		$model=$this->m_utama;
		$hasil=$model->insert_jenis_sampah($_POST['id_jenis'],$_POST['nama_jenis']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Ditambahkan</h3>');
			redirect('c_admin/tambah_jenis_sampah');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Ditambahkan</h3>');
			redirect('c_admin/tambah_jenis_sampah');
		}
	}
	public function hapus_ajax_jenis_sampah(){
		$id_jenis=$_GET['kode'];
		$model=$this->m_utama;
		$hasil=$model->hapus_ajax_jenis_sampah($id_jenis);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Diupdate / Diubah</h3>');
			redirect('c_admin/tambah_jenis_sampah');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Diupdate / Diubah</h3>');
			redirect('c_admin/tambah_jenis_sampah');
		}
	}
	
	public function edit_ajax_ts_masuk(){
		$id_transaksi=$_GET['kode'];
		$model=$this->m_utama;
		$model->edit_ajax_ts_masuk($id_transaksi);
	}
	public function update_ajax_ts_masuk(){
		$model=$this->m_utama;
		$hasil=$model->update_ajax_ts_masuk($_POST['id_transaksi'],$_POST['tanggal'],$_POST['jenis_sampah'],$_POST['pengepul'],$_POST['berat']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Diubah / Diupdate</h3>');
			redirect('kelurahan/transaksi_masuk');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Diubah / Diupdate</h3>');
			redirect('kelurahan/transaksi_masuk');
		}
	}
	public function hapus_ajax_ts_masuk(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		//print_r($id_kelurahan);
		$hasil=$model->hapus_ajax_ts_masuk($_GET['kode'],$id_kelurahan); 
		
		$no=1;
		foreach($hasil->result() as $row){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$row->tanggal.'</td>
			<td>'.$row->nama_pengepulan.'</td>
			<td>'.$row->nama_jenis.'</td>
			<td>'.$row->berat.'</td>
			<td>
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit_modal" onclick=edit("'.$row->id_transaksi.'")><i class="glyphicon glyphicon-pencil"></i></button>
    			<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_modal" onclick=modal_hapus("'.$row->id_transaksi.'")><i class="glyphicon glyphicon-trash"></i></button>
			</td>
		</tr>';
		$no++; 
		}
	}
	public function edit_ajax_ts_masuk_bs(){
		$id_transaksi=$_GET['kode'];
		$model=$this->m_utama;
		$model->edit_ajax_ts_masuk_bs($id_transaksi);
	}
	public function update_ajax_ts_masuk_bs(){
		$model=$this->m_utama;
		$hasil=$model->update_ajax_ts_masuk_bs($_POST['id_transaksi'],$_POST['tanggal'],$_POST['jenis_sampah'],$_POST['bank_sampah'],$_POST['berat']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Diubah / Diupdate</h3>');
			redirect('kelurahan/transaksi_masuk_bs');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Diubah / Diupdate</h3>');
			redirect('kelurahan/transaksi_masuk_bs');
		}
	}
	public function hapus_ajax_ts_masuk_bs(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		//print_r($id_kelurahan);
		$hasil=$model->hapus_ajax_ts_masuk_bs($_GET['kode'],$id_kelurahan); 
		
		$no=1;
		foreach($hasil->result() as $row){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$row->tanggal.'</td>
			<td>'.$row->nama_bank.'</td>
			<td>'.$row->nama_jenis.'</td>
			<td>'.$row->berat.'</td>
			<td>
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit_modal" onclick=edit("'.$row->id_transaksi.'")><i class="glyphicon glyphicon-pencil"></i></button>
    			<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_modal" onclick=modal_hapus("'.$row->id_transaksi.'")><i class="glyphicon glyphicon-trash"></i></button>
			</td>
		</tr>';
		$no++; 
		}
	}
	public function edit_ajax_ts_keluar(){
		$id_transaksi=$_GET['kode'];
		$model=$this->m_utama;
		$model->edit_ajax_ts_keluar($id_transaksi);		
	}
	public function update_ajax_ts_keluar(){
		$model=$this->m_utama;
		$hasil=$model->update_ajax_ts_keluar($_POST['id_transaksi'],$_POST['tanggal'],$_POST['jenis_sampah'],$_POST['pengepul'],$_POST['berat'],$_POST['tujuan']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Diubah / Diupdate</h3>');
			redirect('kelurahan/transaksi_keluar');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Diubah / Diupdate</h3>');
			redirect('kelurahan/transaksi_keluar');
		}
	}
	public function hapus_ajax_ts_keluar(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		//print_r($id_kelurahan);
		$hasil=$model->hapus_ajax_ts_keluar($_GET['kode'],$id_kelurahan); 
		
		$no=1;
		foreach($hasil->result() as $row){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$row->tanggal.'</td>
			<td>'.$row->nama_pengepulan.'</td>
			<td>'.$row->nama_jenis.'</td>
			<td>'.$row->berat.'</td>
			<td>'.$row->tujuan_setor.'</td>
			<td>
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit_modal" onclick=edit("'.$row->id_transaksi.'")><i class="glyphicon glyphicon-pencil"></i></button>
    			<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_modal" onclick=modal_hapus("'.$row->id_transaksi.'")><i class="glyphicon glyphicon-trash"></i></button>
			</td>
		</tr>';
		$no++; 
		}
	}
	public function edit_ajax_ts_keluar_bs(){
		$id_transaksi=$_GET['kode'];
		$model=$this->m_utama;
		$model->edit_ajax_ts_keluar_bs($id_transaksi);		
	}
	public function update_ajax_ts_keluar_bs(){
		$model=$this->m_utama;
		$hasil=$model->update_ajax_ts_keluar_bs($_POST['id_transaksi'],$_POST['tanggal'],$_POST['jenis_sampah'],$_POST['bank_sampah'],$_POST['berat'],$_POST['tujuan']);
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil Diubah / Diupdate</h3>');
			redirect('kelurahan/transaksi_keluar_bs');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Diubah / Diupdate</h3>');
			redirect('kelurahan/transaksi_keluar_bs');
		}
	}
	public function hapus_ajax_ts_keluar_bs(){
		$model=$this->m_utama;
		$kelurahan=$model->kelurahan();
		print_r($_GET['kode']);
		$id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
		//print_r($id_kelurahan);
		$hasil=$model->hapus_ajax_ts_keluar_bs($_GET['kode'],$id_kelurahan); 
		if($hasil==1){
			$this->session->set_flashdata('message','<h3>Data Berhasil DiHapus / DiDelete</h3>');
			redirect('kelurahan/transaksi_keluar_bs');
		}else{
			$this->session->set_flashdata('message','<h3>Data Gagal Dihapus / Didilete</h3>');
			redirect('kelurahan/transaksi_keluar_bs');
		}
	}
	public function rekap_ts_masuk_table_pengepul(){
		$periode=$_POST['periode'];
    	$tanggal_dari=$_POST['tanggal_dari'];
    	$tanggal_akhir=$_POST['tanggal_akhir'];
    	$jenis_sampah=$_POST['jenis_sampah'];
    	$model=$this->m_utama;
    	$rekap_table_admin=$model->rekap_table_admin($periode,$tanggal_dari,$tanggal_akhir,$jenis_sampah);
	}
	public function rekap_ts_keluar_table_pengepul(){
		$periode=$_POST['periode'];
    	$tanggal_dari=$_POST['tanggal_dari'];
    	$tanggal_akhir=$_POST['tanggal_akhir'];
    	$jenis_sampah=$_POST['jenis_sampah'];
    	$model=$this->m_utama;
    	$rekap_table_admin=$model->rekap_ts_keluar_table_pengepul($periode,$tanggal_dari,$tanggal_akhir,$jenis_sampah);
	}
	public function rekap_ts_masuk_table_bs(){
		$periode=$_POST['periode'];
    	$tanggal_dari=$_POST['tanggal_dari'];
    	$tanggal_akhir=$_POST['tanggal_akhir'];
    	$jenis_sampah=$_POST['jenis_sampah'];
    	$model=$this->m_utama;
    	$rekap_table_admin=$model->rekap_ts_masuk_table_bs($periode,$tanggal_dari,$tanggal_akhir,$jenis_sampah);
	}
	public function rekap_ts_keluar_table_bs(){
		$periode=$_POST['periode'];
    	$tanggal_dari=$_POST['tanggal_dari'];
    	$tanggal_akhir=$_POST['tanggal_akhir'];
    	$jenis_sampah=$_POST['jenis_sampah'];
    	$model=$this->m_utama;
    	$rekap_table_admin=$model->rekap_ts_keluar_table_bs($periode,$tanggal_dari,$tanggal_akhir,$jenis_sampah);
	}
}
