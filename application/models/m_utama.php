<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_utama extends CI_Model {

	public function ceklogin($user,$pass){
		$sql="SELECT * FROM USER WHERE USERNAME='$user' AND PASSWORD='$pass'";
        $rs=$this->db->query($sql);
        return $rs;
	}
   function kelurahan(){
    $ses_user=$this->session->userdata('ses_user');
    $sql="SELECT SUBSTRING(username, 4, LENgth(username)-3) as id from user  where username='$ses_user'";
    $rs=$this->db->query($sql);
    if($rs){
        $id=$rs->result()[0]->id;
        $sql="select nama_kelurahan,id_kelurahan from kelurahan where id_kelurahan='$id'";
        $hasil=$this->db->query($sql);
        	if($hasil){
            	return $hasil;
        	}
    	}
    }
    function load_kelurahan($id){
        $sql="SELECT * FROM KELURAHAN WHERE ID_KECAMATAN=$id";
        $rs=$this->db->query($sql);
        if($rs){
            return $rs;
        }
    }
    function load_kecamatan_base_kelurahan($id){
        $sql="SELECT * FROM KELURAHAN WHERE ID_KELURAHAN=$id";  
        $rs=$this->db->query($sql);
        if($rs){
            $kec="SELECT * FROM KECAMATAN WHERE ID_KECAMATAN=".$rs->result()[0]->id_kecamatan."";
            $kecamatan=$this->db->query($kec);
            if($kecamatan){
                return $kecamatan;
            }
        }
    }
    function load_kecamatan(){
        $sql="SELECT * FROM KECAMATAN";
        $rs=$this->db->query($sql);
        return $rs;
    }
    function insert_pengepul($id_pengepul,$id_lokasi,$penanggung_jawab,$nama_pengepulan,$no_telp,$jumlah_pegawai,$alamat,$kelurahan,$kecamatan,$latitude,$longtitude,$keterangan_lokasi){
        $sql="SELECT * FROM DATA_PENGEPUL,DATA_LOKASI WHERE DATA_LOKASI.id_lokasi='".$id_lokasi."' and DATA_PENGEPUL.id_pengepul='".$id_pengepul."' GROUP BY DATA_PENGEPUL.id_pengepul";
        $cekDataPeng=$this->db->query($sql);
        if($cekDataPeng->num_rows()>0){
            $update_peng="UPDATE DATA_PENGEPUL SET nama_pengepulan='".$nama_pengepulan."',jumlah_pegawai='".$jumlah_pegawai."',penanggung_jawab='".$penanggung_jawab."' WHERE id_pengepul='".$id_pengepul."'";
            $rs=$this->db->query($update_peng);
            if($rs){
                $update_lokasi="UPDATE DATA_LOKASI SET alamat_jalan='".$alamat."',kelurahan='".$kelurahan."',kecamatan='".$kecamatan."',latitude='".$latitude."',longtitude='".$longtitude."',keterangan_lokasi='".$keterangan_lokasi."' WHERE id_lokasi='".$id_lokasi."'";
                $rs=$this->db->query($update_lokasi);
                if($rs){
                    return 3;
                }else return 4;
            }
        }else{
        	$id="PNG";
            $sql="SELECT COUNT(id_pengepul) as hasil FROM DATA_PENGEPUL";
            $rs=$this->db->query($sql);
            if($rs->result()[0]->hasil>0){
                $sql_max_id_peng="SELECT CAST(TRIM('PNG' FROM MAX(id_pengepul)) AS INT) AS ID FROM DATA_PENGEPUL";
                $max_id_peng=$this->db->query($sql_max_id_peng);
                $hasil=$max_id_peng->result()[0]->ID;
                if((int)$hasil<10){
                    $id=$id."000000".((int)$hasil+1);
                }else if((int)$hasil<100){
                    $id=$id."00000".((int)$hasil+1);
                }elseif ((int)$hasil<1000) {
                    $id=$id."0000".((int)$hasil+1);
                }elseif ((int)$hasil<10000) {
                    $id=$id."000".((int)$hasil+1);
                }else {
                    $id=$id."00".((int)$hasil+1);
                }  
            }else{
                $hasil=$rs->result()[0]->hasil;
                if((int)$hasil<10){
                    $id=$id."000000".((int)$hasil+1);
                }else if((int)$hasil<100){
                    $id=$id."00000".((int)$hasil+1);
                }elseif ((int)$hasil<1000) {
                    $id=$id."0000".((int)$hasil+1);
                }elseif ((int)$hasil<10000) {
                    $id=$id."000".((int)$hasil+1);
                }else {
                    $id=$id."00".((int)$hasil+1);
                }    
            }
            
            $id_lokasi="LOK";
            $sql="SELECT COUNT(id_lokasi) as hasil FROM DATA_LOKASI";
            $rs=$this->db->query($sql);
            if($rs->result()[0]->hasil>0){
                $sql_max_id_lok="SELECT CAST(TRIM('LOK' FROM MAX(id_lokasi)) AS INT) AS ID FROM DATA_LOKASI";
                $max_id_lok=$this->db->query($sql_max_id_lok);
                $hasil=$max_id_lok->result()[0]->ID;
                if((int)$hasil<10){
                    $id_lokasi=$id_lokasi."000000".((int)$hasil+1);
                }else if((int)$hasil<100){
                    $$id_lokasi=$id_lokasi."00000".((int)$hasil+1);
                }elseif ((int)$hasil<1000) {
                    $id_lokasi=$id_lokasi."0000".((int)$hasil+1);
                }elseif ((int)$hasil<10000) {
                    $id_lokasi=$id_lokasi."000".((int)$hasil+1);
                }else {
                    $id_lokasi=$id_lokasi."00".((int)$hasil+1);
                }
            }else{
                $hasil=$rs->result()[0]->hasil;
                if((int)$hasil<10){
                    $id_lokasi=$id_lokasi."000000".((int)$hasil+1);
                }else if((int)$hasil<100){
                    $$id_lokasi=$id_lokasi."00000".((int)$hasil+1);
                }elseif ((int)$hasil<1000) {
                    $id_lokasi=$id_lokasi."0000".((int)$hasil+1);
                }elseif ((int)$hasil<10000) {
                    $id_lokasi=$id_lokasi."000".((int)$hasil+1);
                }else {
                    $id_lokasi=$id_lokasi."00".((int)$hasil+1);
                }
            }

            $insert_alamat="INSERT INTO DATA_LOKASI VALUES('$id_lokasi','$alamat','$kelurahan','$kecamatan','$latitude','$longtitude','$keterangan_lokasi')";
            $rs=$this->db->query($insert_alamat);
            if($rs){
            	$insert="INSERT INTO DATA_PENGEPUL VALUES('$id','$penanggung_jawab','$nama_pengepulan','$no_telp','$id_lokasi','$jumlah_pegawai')";
            	$insert=$this->db->query($insert);
            	if($insert){
            		return 1;
            	}else return 2;
            }
        }
    }
    function load_pengepul($id_kelurahan,$id_kecamatan){
         if($this->session->userdata('level')=="admin"){
            $sql="SELECT * FROM DATA_PENGEPUL dp,DATA_LOKASI dl,kelurahan kel,KECAMATAN kec WHERE dp.id_lokasi=dl.id_lokasi and dl.kelurahan=kel.id_kelurahan and dl.kecamatan=kec.id_kecamatan";
            $rs=$this->db->query($sql);
            if($rs){
                return $rs;
            }
        }else{
            $sql="SELECT * FROM DATA_PENGEPUL dp,DATA_LOKASI dl,kelurahan kel,KECAMATAN kec WHERE dp.id_lokasi=dl.id_lokasi and dl.kelurahan=kel.id_kelurahan and dl.kecamatan=kec.id_kecamatan and kel.id_kelurahan=$id_kelurahan and kec.id_kecamatan=$id_kecamatan";
            $rs=$this->db->query($sql);
            if($rs){
                return $rs;
            }
        }
    }
    function edit_ajax_pengepul($id_pengepul){
        //echo $id_bank_sampah;
        $sql="SELECT * FROM DATA_PENGEPUL,DATA_LOKASI WHERE DATA_PENGEPUL.id_lokasi=DATA_LOKASI.id_lokasi and id_pengepul='".$id_pengepul."' GROUP BY data_pengepul.id_pengepul";
        $rs=$this->db->query($sql);
        if ($rs) {
            $rs_json=json_encode($rs->result());
            echo $rs_json;
            return $rs_json;
        }
    }
    function hapus_peng($id_pengepul,$id_lokasi){
        $sql_peng="DELETE FROM DATA_PENGEPUL WHERE id_pengepul='".$id_pengepul."'";
        $rs_peng=$this->db->query($sql_peng);
        if($rs_peng){
            $sql_dl="DELETE FROM DATA_LOKASI WHERE id_lokasi='".$id_lokasi."'";
            $rs_dl=$this->db->query($sql_dl);
            if($rs_dl){
                return 1;
            }
        }
    }
    function insert_bank($id_bank_sampah,$id_lokasi,$penanggung_jawab,$nama_bank,$no_telp,$jumlah_nasabah,$alamat,$kelurahan,$kecamatan,$latitude,$longtitude,$keterangan_lokasi){
        $sql="SELECT * FROM BANK_SAMPAH,DATA_LOKASI WHERE DATA_LOKASI.id_lokasi='".$id_lokasi."' and BANK_SAMPAH.id_bank_sampah='".$id_bank_sampah."' GROUP BY bank_sampah.id_bank_sampah";
        $cekDataBS=$this->db->query($sql);
        //print_r($cekDataBS->result());
        if($cekDataBS->num_rows()>0){
            $update_bs="UPDATE BANK_SAMPAH SET nama_bank='".$nama_bank."',jumlah_nasabah='".$jumlah_nasabah."',penanggung_jawab='".$penanggung_jawab."' WHERE id_bank_sampah='".$id_bank_sampah."'";
            $rs=$this->db->query($update_bs);
            if($rs){
                $update_lokasi="UPDATE DATA_LOKASI SET alamat_jalan='".$alamat."',kelurahan='".$kelurahan."',kecamatan='".$kecamatan."',latitude='".$latitude."',longtitude='".$longtitude."',keterangan_lokasi='".$keterangan_lokasi."' WHERE id_lokasi='".$id_lokasi."'";
                $rs=$this->db->query($update_lokasi);
                if($rs){
                    return 3;
                }else return 4;
            }
        }else {
            
        	$id_bank="BNK";
        	$sql="SELECT COUNT(id_bank_sampah) as hasil FROM BANK_SAMPAH";
            $rs=$this->db->query($sql);
            if($rs->result()[0]->hasil>0){
                $sql_max_id_bs="SELECT CAST(TRIM('BNK' FROM MAX(id_bank_sampah)) AS INT) AS ID FROM BANK_SAMPAH";
                $max_id_bs=$this->db->query($sql_max_id_bs);
                $hasil=$max_id_bs->result()[0]->ID;
                if((int)$hasil<10){
                    $id_bank=$id_bank."000000".((int)$hasil+1);
                }else if((int)$hasil<100){
                    $id_bank=$id_bank."00000".((int)$hasil+1);
                }elseif ((int)$hasil<1000) {
                    $id_bank=$id_bank."0000".((int)$hasil+1);
                }elseif ((int)$hasil<10000) {
                    $id_bank=$id_bank."000".((int)$hasil+1);
                }else {
                    $id_bank=$id_bank."00".((int)$hasil+1);
                } 
            }else{
                $hasil=$rs->result()[0]->hasil;
                if((int)$hasil<10){
                    $id_bank=$id_bank."000000".((int)$hasil+1);
                }else if((int)$hasil<100){
                    $id_bank=$id_bank."00000".((int)$hasil+1);
                }elseif ((int)$hasil<1000) {
                    $id_bank=$id_bank."0000".((int)$hasil+1);
                }elseif ((int)$hasil<10000) {
                    $id_bank=$id_bank."000".((int)$hasil+1);
                }else {
                    $id_bank=$id_bank."00".((int)$hasil+1);
                } 
            }
            

        	$id_lokasi="LOK";
            $sql="SELECT COUNT(id_lokasi) as hasil FROM DATA_LOKASI";
            $rs=$this->db->query($sql);
            if($rs->result()[0]->hasil>0){
                $sql_max_id_lok="SELECT CAST(TRIM('LOK' FROM MAX(id_lokasi)) AS INT) AS ID FROM DATA_LOKASI";
                $max_id_lok=$this->db->query($sql_max_id_lok);
                $hasil=$max_id_lok->result()[0]->ID;
                if((int)$hasil<10){
                    $id_lokasi=$id_lokasi."000000".((int)$hasil+1);
                }else if((int)$hasil<100){
                    $$id_lokasi=$id_lokasi."00000".((int)$hasil+1);
                }elseif ((int)$hasil<1000) {
                    $id_lokasi=$id_lokasi."0000".((int)$hasil+1);
                }elseif ((int)$hasil<10000) {
                    $id_lokasi=$id_lokasi."000".((int)$hasil+1);
                }else {
                    $id_lokasi=$id_lokasi."00".((int)$hasil+1);
                }
            }else{
                $hasil=$rs->result()[0]->hasil;
                if((int)$hasil<10){
                    $id_lokasi=$id_lokasi."000000".((int)$hasil+1);
                }else if((int)$hasil<100){
                    $$id_lokasi=$id_lokasi."00000".((int)$hasil+1);
                }elseif ((int)$hasil<1000) {
                    $id_lokasi=$id_lokasi."0000".((int)$hasil+1);
                }elseif ((int)$hasil<10000) {
                    $id_lokasi=$id_lokasi."000".((int)$hasil+1);
                }else {
                    $id_lokasi=$id_lokasi."00".((int)$hasil+1);
                }
            }

            $insert_alamat="INSERT INTO DATA_LOKASI VALUES('$id_lokasi','$alamat',$kelurahan,$kecamatan,'$latitude','$longtitude','$keterangan_lokasi')";
            $alamat=$this->db->query($insert_alamat);
            if($alamat){
            	$insert_bank="INSERT INTO BANK_SAMPAH VALUES('$id_bank','$nama_bank',$jumlah_nasabah,'$no_telp','$penanggung_jawab','$id_lokasi')";
            	$bank=$this->db->query($insert_bank);
            	if($bank){
            		return 1;
            	}else return 2;
            }
        }
    }
    function load_bank_sampah($id_kelurahan,$id_kecamatan){
        if($this->session->userdata('level')=="admin"){
            $sql="SELECT * FROM BANK_SAMPAH bs,DATA_LOKASI dl,kelurahan kel,KECAMATAN kec WHERE bs.id_lokasi=dl.id_lokasi and dl.kelurahan=kel.id_kelurahan and dl.kecamatan=kec.id_kecamatan";
            $rs=$this->db->query($sql);
            if($rs){
                return $rs;
            }
        }else{
            $sql="SELECT * FROM BANK_SAMPAH bs,DATA_LOKASI dl,kelurahan kel,KECAMATAN kec WHERE bs.id_lokasi=dl.id_lokasi and dl.kelurahan=kel.id_kelurahan and dl.kecamatan=kec.id_kecamatan and kel.id_kelurahan=$id_kelurahan and kec.id_kecamatan=$id_kecamatan";
            $rs=$this->db->query($sql);
            if($rs){
                return $rs;
            }
        }
    }
    function edit_ajax_bs_kelurahan($id_bank_sampah){
        //echo $id_bank_sampah;
        $sql="SELECT * FROM BANK_SAMPAH,DATA_LOKASI WHERE BANK_SAMPAH.id_lokasi=DATA_LOKASI.id_lokasi and id_bank_sampah='".$id_bank_sampah."' GROUP BY bank_sampah.id_bank_sampah";
        $rs=$this->db->query($sql);
        if ($rs) {
            //print_r($rs->result());
            $rs_json=json_encode($rs->result());
            echo $rs_json;
            return $rs_json;
        }
    }
    function hapus_bs($id_bank_sampah,$id_lokasi){
        $sql_bs="DELETE FROM BANK_SAMPAH WHERE id_bank_sampah='".$id_bank_sampah."'";
        $rs_bs=$this->db->query($sql_bs);
        if($rs_bs){
            $sql_dl="DELETE FROM DATA_LOKASI WHERE id_lokasi='".$id_lokasi."'";
            $rs_dl=$this->db->query($sql_dl);
            if($rs_dl){
                return 1;
            }
        }
    }
    function jenis_sampah(){
    	$sql="SELECT * FROM JENIS_SAMPAH";
    	$rs=$this->db->query($sql);
    	if($rs){
    		return $rs;
    	}
    }
    function pengepul($kelurahan){
    	$id_kel=$kelurahan->result()[0]->id_kelurahan;
    	$sql="SELECT dp.nama_pengepulan,dp.penanggung_jawab,dp.id_pengepul FROM DATA_PENGEPUL dp,DATA_LOKASI dl,KELURAHAN kl WHERE dp.id_lokasi=dl.id_lokasi and dl.kelurahan=kl.id_kelurahan and dl.kelurahan=$id_kel";
    	$rs=$this->db->query($sql);
    	if($rs){
    		return $rs;;
    	}
    }
    
    function load_peta_pengepul(){
        $sql="SELECT * FROM DATA_PENGEPUL DP,DATA_LOKASI DL WHERE DP.ID_LOKASI=DL.ID_LOKASI";
        $rs=$this->db->query($sql);
        if($rs){
            return $rs;
        }
    }
    function load_peta_bank_sampah(){
        $sql="SELECT * FROM BANK_SAMPAH BS,DATA_LOKASI DL WHERE BS.ID_LOKASI=DL.ID_LOKASI";
        $rs=$this->db->query($sql);
        if($rs){
            return $rs;
        }   
    }
    function insert_transaksi_pengepul($tanggal,$jenis_sampah,$pengepul,$berat){
        $id_trans="TRS";
        $sql="SELECT COUNT(id_transaksi) as hasil FROM TRANSAKSI_MASUK";
        $rs=$this->db->query($sql);
        $hasil=$rs->result()[0]->hasil;
        
        if((int)$hasil<10){
            $id_trans=$id_trans."000000".((int)$hasil+1);
        }else if((int)$hasil<100){
            $id_trans=$id_trans."00000".((int)$hasil+1);
        }elseif ((int)$hasil<1000) {
            $id_trans=$id_trans."0000".((int)$hasil+1);
        }elseif ((int)$hasil<10000) {
            $id_trans=$id_trans."000".((int)$hasil+1);
        }else {
            $id_trans=$id_trans."00".((int)$hasil+1);
        }
        $sql="INSERT INTO TRANSAKSI_MASUK VALUES('$id_trans','$tanggal','$pengepul',$berat)";
        $insert_trans_peng=$this->db->query($sql);
        if($insert_trans_peng){
            $sql="INSERT INTO RELASI_TRANSAKSI_MASUK VALUES('$id_trans','$jenis_sampah')";
            $relasi_trans_masuk_peng=$this->db->query($sql);
            if($relasi_trans_masuk_peng){
                return 1;
            }
        }
    }
    function load_transaksi_masuk_pengepul($id_kelurahan){
        $sql="SELECT TRANSAKSI_MASUK.id_transaksi,TRANSAKSI_MASUK.tanggal,DATA_PENGEPUL.nama_pengepulan,JENIS_SAMPAH.nama_jenis,TRANSAKSI_MASUK.berat FROM TRANSAKSI_MASUK,DATA_PENGEPUL,JENIS_SAMPAH,RELASI_TRANSAKSI_MASUK,DATA_LOKASI WHERE TRANSAKSI_MASUK.DARI=DATA_PENGEPUL.ID_PENGEPUL AND RELASI_TRANSAKSI_MASUK.JENIS_SAMPAH=JENIS_SAMPAH.ID_JENIS AND DATA_LOKASI.id_lokasi=DATA_PENGEPUL.id_lokasi and data_lokasi.kelurahan='".$id_kelurahan."' AND TRANSAKSI_MASUK.id_transaksi=RELASI_TRANSAKSI_MASUK.id_transaksi GROUP BY transaksi_masuk.id_transaksi ORDER BY TRANSAKSI_MASUK.id_transaksi desc";
        $rs=$this->db->query($sql);
        if($rs){
            return($rs);
        }
    }
    function get_riwayat_ts(){
        $sql="SELECT TSM.ID_TRANSAKSI,TSM.TANGGAL,DP.NAMA_PENGEPULAN,JS.NAMA_JENIS,TSM.BERAT FROM TRANSAKSI_MASUK TSM,DATA_PENGEPUL DP,JENIS_SAMPAH JS,RELASI_TRANSAKSI_MASUK RTM WHERE TSM.DARI=DP.ID_PENGEPUL AND RTM.JENIS_SAMPAH=JS.ID_JENIS AND RTM.ID_TRANSAKSI=TSM.ID_TRANSAKSI";
        $rs=$this->db->query($sql);
        if($rs){
            return $rs;
        }
    }
    function edit_ajax_ts_masuk($id_transaksi){
        $sql="SELECT DP.ID_PENGEPUL,JS.ID_JENIS,TSM.ID_TRANSAKSI,TSM.TANGGAL,DP.NAMA_PENGEPULAN,JS.NAMA_JENIS,TSM.BERAT FROM TRANSAKSI_MASUK TSM,DATA_PENGEPUL DP,JENIS_SAMPAH JS,RELASI_TRANSAKSI_MASUK RTM WHERE TSM.DARI=DP.ID_PENGEPUL AND RTM.JENIS_SAMPAH=JS.ID_JENIS AND RTM.ID_TRANSAKSI=TSM.ID_TRANSAKSI AND TSM.ID_TRANSAKSI='".$id_transaksi."'";
        $rs=$this->db->query($sql);
        if($rs){
            foreach($rs->result() as $row){
                echo '<form action="'.base_url().'index.php/proses_db/update_ajax_ts_masuk" method="POST" enctype="multipart/form-data">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="panel panel-default">
                      <div class="panel-body form-horizontal payment-form">
                            <div class="form-group">
                                <label for="date" class="col-sm-3 control-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="date" name="tanggal" value="'.$row->TANGGAL.'">
                                    <input type="hidden" value="'.$row->ID_TRANSAKSI.'" name="id_transaksi">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="lokasi" class="col-sm-3 control-label">Pilih Pengepul</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="pengepul" name="pengepul">';
                                            $kelurahan=$this->kelurahan();
                                            $pengepul=$this->pengepul($kelurahan);
                                            foreach ($pengepul->result() as $pengepul) {
                                                if($row->ID_PENGEPUL==$pengepul->id_pengepul){
                                                    echo '<option value="'.$pengepul->id_pengepul.'" selected>'.$pengepul->nama_pengepulan.'</option>';    
                                                }else {
                                                    echo '<option value="'.$pengepul->id_pengepul.'">'.$pengepul->nama_pengepulan.'</option>';
                                                }
                                            }
                                echo '</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="col-sm-3 control-label">Jenis Sampah</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_sampah" name="jenis_sampah">';
                                            $jenis_sampah=$this->jenis_sampah();
                                            foreach ($jenis_sampah->result() as $js_sampah) {
                                                if($row->ID_JENIS==$js_sampah->id_jenis){
                                                    echo '<option value="'.$js_sampah->id_jenis.'" selected>'.$js_sampah->nama_jenis.'</option>';    
                                                }else{
                                                    echo '<option value="'.$js_sampah->id_jenis.'">'.$js_sampah->nama_jenis.'</option>';    
                                                }
                                            }
                                    echo '</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Berat :</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="berat" name="berat" required="" value="'.$row->BERAT.'">
                                        <span class="input-group-addon" id="basic-addon1">Kg</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="float: right;">Update Data</button>
                        </div>
                    </div>            
                </div> <!-- / panel preview -->
                </form>';
            }
        }
    }
    function update_ajax_ts_masuk($id_transaksi,$tanggal,$jenis_sampah,$pengepul,$berat){
        $sql="UPDATE TRANSAKSI_MASUK SET TANGGAL='".$tanggal."', DARI='".$pengepul."', BERAT=".$berat." WHERE ID_TRANSAKSI='".$id_transaksi."'";
        $rs=$this->db->query($sql);
        if($rs){
            $sql="UPDATE RELASI_TRANSAKSI_MASUK SET JENIS_SAMPAH='".$jenis_sampah."' WHERE ID_TRANSAKSI='".$id_transaksi."'";
            $update=$this->db->query($sql);
            if($update){
                return 1;
            }
        }
    }
    function hapus_ajax_ts_masuk($id,$id_kelurahan){
        $sql="DELETE FROM RELASI_TRANSAKSI_MASUK where id_transaksi='".$id."'";
        $hapus1=$this->db->query($sql);
        if($hapus1){
            $sql="DELETE from transaksi_masuk where id_transaksi='".$id."'";
            $hapus2=$this->db->query($sql);
            if ($hapus2) {
                $hasil=$this->load_transaksi_masuk_pengepul($id_kelurahan);
                return $hasil;
            }
        }
    }
    function insert_transaksi_bs($tanggal,$jenis_sampah,$bank_sampah,$berat){
        $id_trans="TRS";
        $sql="SELECT COUNT(id_transaksi) as hasil FROM TRANSAKSI_MASUK";
        $rs=$this->db->query($sql);
        $hasil=$rs->result()[0]->hasil;
        
        if((int)$hasil<10){
            $id_trans=$id_trans."000000".((int)$hasil+1);
        }else if((int)$hasil<100){
            $id_trans=$id_trans."00000".((int)$hasil+1);
        }elseif ((int)$hasil<1000) {
            $id_trans=$id_trans."0000".((int)$hasil+1);
        }elseif ((int)$hasil<10000) {
            $id_trans=$id_trans."000".((int)$hasil+1);
        }else {
            $id_trans=$id_trans."00".((int)$hasil+1);
        }
        $sql="INSERT INTO TRANSAKSI_MASUK VALUES('$id_trans','$tanggal','$bank_sampah',$berat)";
        $insert_trans_peng=$this->db->query($sql);
        if($insert_trans_peng){
            $sql="INSERT INTO RELASI_TRANSAKSI_MASUK VALUES('$id_trans','$jenis_sampah')";
            $relasi_trans_masuk_peng=$this->db->query($sql);
            if($relasi_trans_masuk_peng){
                return 1;
            }
        }
    }
    function load_transaksi_masuk_bs($id_kelurahan){
         $sql="SELECT TRANSAKSI_MASUK.id_transaksi,TRANSAKSI_MASUK.tanggal,BANK_SAMPAH.nama_bank,JENIS_SAMPAH.nama_jenis,TRANSAKSI_MASUK.berat FROM TRANSAKSI_MASUK,BANK_SAMPAH,JENIS_SAMPAH,RELASI_TRANSAKSI_MASUK,DATA_LOKASI WHERE TRANSAKSI_MASUK.DARI=BANK_SAMPAH.id_bank_sampah AND RELASI_TRANSAKSI_MASUK.JENIS_SAMPAH=JENIS_SAMPAH.ID_JENIS AND DATA_LOKASI.id_lokasi=BANK_SAMPAH.id_lokasi and data_lokasi.kelurahan='".$id_kelurahan."' AND TRANSAKSI_MASUK.id_transaksi=RELASI_TRANSAKSI_MASUK.id_transaksi GROUP BY transaksi_masuk.id_transaksi ORDER BY TRANSAKSI_MASUK.id_transaksi desc";
        $rs=$this->db->query($sql);
        if($rs){
            return($rs);
        }
    }
    function edit_ajax_ts_masuk_bs($id_transaksi){
        $sql="SELECT BS.id_bank_sampah,JS.ID_JENIS,TSM.ID_TRANSAKSI,TSM.TANGGAL,BS.NAMA_BANK,JS.NAMA_JENIS,TSM.BERAT FROM TRANSAKSI_MASUK TSM,BANK_SAMPAH BS,JENIS_SAMPAH JS,RELASI_TRANSAKSI_MASUK RTM WHERE TSM.DARI=BS.id_bank_sampah AND RTM.JENIS_SAMPAH=JS.ID_JENIS AND RTM.ID_TRANSAKSI=TSM.ID_TRANSAKSI AND TSM.ID_TRANSAKSI='".$id_transaksi."'";
        $rs=$this->db->query($sql);
        if($rs){
            foreach($rs->result() as $row){
                echo '<form action="'.base_url().'index.php/proses_db/update_ajax_ts_masuk_bs" method="POST" enctype="multipart/form-data">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="panel panel-default">
                      <div class="panel-body form-horizontal payment-form">
                            <div class="form-group">
                                <label for="date" class="col-sm-3 control-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="date" name="tanggal" value="'.$row->TANGGAL.'">
                                    <input type="hidden" value="'.$row->ID_TRANSAKSI.'" name="id_transaksi">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="bank_sampah" class="col-sm-3 control-label">Pilih Pengepul</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="bank_sampah" name="bank_sampah">';
                                            $kelurahan=$this->kelurahan();
                                            $kecamatan=$this->load_kecamatan_base_kelurahan($kelurahan->result()[0]->id_kelurahan);
                                            $id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
                                            $id_kecamatan=$kecamatan->result()[0]->id_kecamatan;
                                            $bank_sampah=$this->load_bank_sampah($id_kelurahan,$id_kecamatan);
                                            foreach ($bank_sampah->result() as $bank_sampah) {
                                                if($row->ID_PENGEPUL==$bank_sampah->id_bank_sampah){
                                                    echo '<option value="'.$bank_sampah->id_bank_sampah.'" selected>'.$bank_sampah->nama_bank.'</option>';    
                                                }else {
                                                    echo '<option value="'.$bank_sampah->id_bank_sampah.'">'.$bank_sampah->nama_bank.'</option>';
                                                }
                                            }
                                echo '</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="col-sm-3 control-label">Jenis Sampah</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_sampah" name="jenis_sampah">';
                                            $jenis_sampah=$this->jenis_sampah();
                                            foreach ($jenis_sampah->result() as $js_sampah) {
                                                if($row->ID_JENIS==$js_sampah->id_jenis){
                                                    echo '<option value="'.$js_sampah->id_jenis.'" selected>'.$js_sampah->nama_jenis.'</option>';    
                                                }else{
                                                    echo '<option value="'.$js_sampah->id_jenis.'">'.$js_sampah->nama_jenis.'</option>';    
                                                }
                                            }
                                    echo '</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Berat :</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="berat" name="berat" required="" value="'.$row->BERAT.'">
                                        <span class="input-group-addon" id="basic-addon1">Kg</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="float: right;">Update Data</button>
                        </div>
                    </div>            
                </div> <!-- / panel preview -->
                </form>';
            }
        }
    }
    function update_ajax_ts_masuk_bs($id_transaksi,$tanggal,$jenis_sampah,$bank_sampah,$berat){
        $sql="UPDATE TRANSAKSI_MASUK SET TANGGAL='".$tanggal."', DARI='".$bank_sampah."', BERAT=".$berat." WHERE ID_TRANSAKSI='".$id_transaksi."'";
        $rs=$this->db->query($sql);
        if($rs){
            $sql="UPDATE RELASI_TRANSAKSI_MASUK SET JENIS_SAMPAH='".$jenis_sampah."' WHERE ID_TRANSAKSI='".$id_transaksi."'";
            $update=$this->db->query($sql);
            if($update){
                return 1;
            }
        }
    }
    function hapus_ajax_ts_masuk_bs($id,$id_kelurahan){
        $sql="DELETE FROM RELASI_TRANSAKSI_MASUK where id_transaksi='".$id."'";
        $hapus1=$this->db->query($sql);
        if($hapus1){
            $sql="DELETE from transaksi_masuk where id_transaksi='".$id."'";
            $hapus2=$this->db->query($sql);
            if ($hapus2) {
                $hasil=$this->load_transaksi_masuk_bs($id_kelurahan);
                return $hasil;
            }
        }
    }
    function insert_transaksi_keluar_pengepul($tanggal,$pengepul,$jenis_sampah,$berat,$tujuan){
        $id_trans="TRS";
        $sql="SELECT COUNT(id_transaksi) as hasil FROM TRANSAKSI_KELUAR";
        $rs=$this->db->query($sql);
        $hasil=$rs->result()[0]->hasil;
        
        if((int)$hasil<10){
            $id_trans=$id_trans."000000".((int)$hasil+1);
        }else if((int)$hasil<100){
            $id_trans=$id_trans."00000".((int)$hasil+1);
        }elseif ((int)$hasil<1000) {
            $id_trans=$id_trans."0000".((int)$hasil+1);
        }elseif ((int)$hasil<10000) {
            $id_trans=$id_trans."000".((int)$hasil+1);
        }else {
            $id_trans=$id_trans."00".((int)$hasil+1);
        }
        $sql="INSERT INTO TRANSAKSI_KELUAR VALUES('$id_trans','$pengepul','$tanggal',$berat,'$tujuan')";
        $insert_trans_kel_peng=$this->db->query($sql);
        if($insert_trans_kel_peng){
            $sql="INSERT INTO RELASI_TRANSAKSI_KELUAR VALUES('$id_trans','$jenis_sampah')";
            $relasi_transaksi_keluar=$this->db->query($sql);
            if($relasi_transaksi_keluar){
                return 1;
            }
        }
    }
    function load_transaksi_keluar_pengepul($id_kelurahan){
        $sql="SELECT TRANSAKSI_KELUAR.id_transaksi,TRANSAKSI_KELUAR.dari,TRANSAKSI_KELUAR.tanggal,DATA_PENGEPUL.nama_pengepulan,JENIS_SAMPAH.nama_jenis,TRANSAKSI_KELUAR.berat,TRANSAKSI_KELUAR.tujuan_setor FROM TRANSAKSI_KELUAR,DATA_PENGEPUL,JENIS_SAMPAH,RELASI_TRANSAKSI_KELUAR,DATA_LOKASI WHERE TRANSAKSI_KELUAR.DARI=DATA_PENGEPUL.id_pengepul AND RELASI_TRANSAKSI_KELUAR.ID_JENIS=JENIS_SAMPAH.ID_JENIS AND DATA_LOKASI.id_lokasi=DATA_PENGEPUL.id_lokasi and data_lokasi.kelurahan='".$id_kelurahan."' AND TRANSAKSI_KELUAR.id_transaksi=RELASI_TRANSAKSI_KELUAR.id_transaksi GROUP BY TRANSAKSI_KELUAR.id_transaksi ORDER BY TRANSAKSI_KELUAR.id_transaksi desc";
        $rs=$this->db->query($sql);
        if($rs){
            return($rs);
        }
    }
    function edit_ajax_ts_keluar($id_transaksi){
        $sql="SELECT DP.id_pengepul,JS.ID_JENIS,TSK.ID_TRANSAKSI,TSK.TANGGAL,DP.NAMA_PENGEPULAN,JS.NAMA_JENIS,TSK.BERAT,TSK.tujuan_setor FROM TRANSAKSI_keluar TSK,DATA_PENGEPUL DP,JENIS_SAMPAH JS,RELASI_TRANSAKSI_KELUAR RTK WHERE TSK.DARI=DP.id_pengepul AND RTK.ID_JENIS=JS.ID_JENIS AND RTK.ID_TRANSAKSI=TSK.ID_TRANSAKSI AND TSK.ID_TRANSAKSI='".$id_transaksi."'";
        $rs=$this->db->query($sql);
        if($rs){
            foreach($rs->result() as $row){
                echo '<form action="'.base_url().'index.php/proses_db/update_ajax_ts_keluar" method="POST" enctype="multipart/form-data">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="panel panel-default">
                      <div class="panel-body form-horizontal payment-form">
                            <div class="form-group">
                                <label for="date" class="col-sm-3 control-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="date" name="tanggal" value="'.$row->TANGGAL.'">
                                    <input type="hidden" value="'.$row->ID_TRANSAKSI.'" name="id_transaksi">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="pengepul" class="col-sm-3 control-label">Pilih Pengepul</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="pengepul" name="pengepul">';
                                            $kelurahan=$this->kelurahan();
                                            $pengepul=$this->pengepul($kelurahan);
                                            foreach ($pengepul->result() as $pengepul) {
                                                if($row->id_pengepul==$pengepul->id_pengepul){
                                                    echo '<option value="'.$pengepul->id_pengepul.'" selected>'.$pengepul->nama_pengepulan.'</option>';    
                                                }else {
                                                    echo '<option value="'.$pengepul->id_pengepul.'">'.$pengepul->nama_pengepulan.'</option>';
                                                }
                                            }
                                echo '</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="col-sm-3 control-label">Jenis Sampah</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_sampah" name="jenis_sampah">';
                                            $jenis_sampah=$this->jenis_sampah();
                                            foreach ($jenis_sampah->result() as $js_sampah) {
                                                if($row->ID_JENIS==$js_sampah->id_jenis){
                                                    echo '<option value="'.$js_sampah->id_jenis.'" selected>'.$js_sampah->nama_jenis.'</option>';    
                                                }else{
                                                    echo '<option value="'.$js_sampah->id_jenis.'">'.$js_sampah->nama_jenis.'</option>';    
                                                }
                                            }
                                    echo '</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="berat" class="col-sm-3 control-label">Berat :</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="berat" name="berat" required="" value="'.$row->BERAT.'">
                                        <span class="input-group-addon" id="basic-addon1">Kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="" class="col-sm-3 control-label">Tujuan Setor :</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <textarea class="form-control" id="tujuan" name="tujuan" value="">'.$row->tujuan_setor.'</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="float: right;">Update Data</button>
                        </div>
                    </div>            
                </div> <!-- / panel preview -->
                </form>';
            }
        }
    }
    function update_ajax_ts_keluar($id_transaksi,$tanggal,$jenis_sampah,$pengepul,$berat,$tujuan_setor){
        $sql="UPDATE TRANSAKSI_KELUAR SET TANGGAL='".$tanggal."', DARI='".$pengepul."', BERAT=".$berat.",tujuan_setor='".$tujuan_setor."' WHERE ID_TRANSAKSI='".$id_transaksi."'";
        $rs=$this->db->query($sql);
        if($rs){
            $sql="UPDATE RELASI_TRANSAKSI_KELUAR SET id_jenis='".$jenis_sampah."' WHERE ID_TRANSAKSI='".$id_transaksi."'";
            $update=$this->db->query($sql);
            if($update){
                return 1;
            }
        }
    }
    function hapus_ajax_ts_keluar($id_transaksi,$id_kelurahan){
        $sql="DELETE FROM RELASI_TRANSAKSI_KELUAR where id_transaksi='".$id_transaksi."'";
        $hapus1=$this->db->query($sql);
        if($hapus1){
            $sql="DELETE from transaksi_keluar where id_transaksi='".$id_transaksi."'";
            $hapus2=$this->db->query($sql);
            if ($hapus2) {
                $hasil=$this->load_transaksi_keluar_pengepul($id_kelurahan);
                //print_r($hasil->result());
                return $hasil;
            }
        }
    }
    function load_transaksi_keluar_bs($id_kelurahan){
         $sql="SELECT TRANSAKSI_KELUAR.id_transaksi,TRANSAKSI_KELUAR.dari,TRANSAKSI_KELUAR.tanggal,BANK_SAMPAH.nama_bank,JENIS_SAMPAH.nama_jenis,TRANSAKSI_KELUAR.berat,TRANSAKSI_KELUAR.tujuan_setor FROM TRANSAKSI_KELUAR,BANK_SAMPAH,JENIS_SAMPAH,RELASI_TRANSAKSI_KELUAR,DATA_LOKASI WHERE TRANSAKSI_KELUAR.DARI=BANK_SAMPAH.id_bank_sampah AND RELASI_TRANSAKSI_KELUAR.id_jenis=JENIS_SAMPAH.ID_JENIS AND DATA_LOKASI.id_lokasi=BANK_SAMPAH.id_lokasi and data_lokasi.kelurahan='".$id_kelurahan."' AND TRANSAKSI_KELUAR.id_transaksi=RELASI_TRANSAKSI_KELUAR.id_transaksi GROUP BY transaksi_keluar.id_transaksi ORDER BY TRANSAKSI_KELUAR.id_transaksi desc";
        $rs=$this->db->query($sql);
        if($rs){
            return($rs);
        }
    }
    function insert_transaksi_keluar_bs($tanggal,$jenis_sampah,$bank_sampah,$berat,$tujuan_setor){
        $id_trans="TRS";
        $sql="SELECT COUNT(id_transaksi) as hasil FROM TRANSAKSI_KELUAR";
        $rs=$this->db->query($sql);
        $hasil=$rs->result()[0]->hasil;
        
        if((int)$hasil<10){
            $id_trans=$id_trans."000000".((int)$hasil+1);
        }else if((int)$hasil<100){
            $id_trans=$id_trans."00000".((int)$hasil+1);
        }elseif ((int)$hasil<1000) {
            $id_trans=$id_trans."0000".((int)$hasil+1);
        }elseif ((int)$hasil<10000) {
            $id_trans=$id_trans."000".((int)$hasil+1);
        }else {
            $id_trans=$id_trans."00".((int)$hasil+1);
        }
        $sql="INSERT INTO TRANSAKSI_KELUAR VALUES('$id_trans','$bank_sampah','$tanggal',$berat,'$tujuan_setor')";
        $insert_trans_peng=$this->db->query($sql);
        if($insert_trans_peng){
            $sql="INSERT INTO RELASI_TRANSAKSI_KELUAR VALUES('$id_trans','$jenis_sampah')";
            $relasi_trans_masuk_peng=$this->db->query($sql);
            if($relasi_trans_masuk_peng){
                return 1;
            }
        }
    }
    function edit_ajax_ts_keluar_bs($id_transaksi){
        $sql="SELECT BS.id_bank_sampah,JS.ID_JENIS,TSK.ID_TRANSAKSI,TSK.TANGGAL,BS.NAMA_BANK,JS.NAMA_JENIS,TSK.BERAT,TSK.tujuan_setor FROM TRANSAKSI_keluar TSK,BANK_SAMPAH BS,JENIS_SAMPAH JS,RELASI_TRANSAKSI_KELUAR RTK WHERE TSK.DARI=BS.id_bank_sampah AND RTK.ID_JENIS=JS.ID_JENIS AND RTK.ID_TRANSAKSI=TSK.ID_TRANSAKSI AND TSK.ID_TRANSAKSI='".$id_transaksi."'";
        $rs=$this->db->query($sql);
        if($rs){
            foreach($rs->result() as $row){
                echo '<form action="'.base_url().'index.php/proses_db/update_ajax_ts_keluar_bs" method="POST" enctype="multipart/form-data">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="panel panel-default">
                      <div class="panel-body form-horizontal payment-form">
                            <div class="form-group">
                                <label for="date" class="col-sm-3 control-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="date" name="tanggal" value="'.$row->TANGGAL.'">
                                    <input type="hidden" value="'.$row->ID_TRANSAKSI.'" name="id_transaksi">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="bank_sampah" class="col-sm-3 control-label">Pilih Pengepul</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="bank_sampah" name="bank_sampah">';
                                            $kelurahan=$this->kelurahan();
                                            $kecamatan=$this->load_kecamatan_base_kelurahan($kelurahan->result()[0]->id_kelurahan);
                                            $id_kelurahan=$kelurahan->result()[0]->id_kelurahan;
                                            $id_kecamatan=$kecamatan->result()[0]->id_kecamatan;
                                            $bank_sampah=$this->load_bank_sampah($id_kelurahan,$id_kecamatan);
                                            foreach ($bank_sampah->result() as $bank_sampah) {
                                                if($row->ID_PENGEPUL==$bank_sampah->id_bank_sampah){
                                                    echo '<option value="'.$bank_sampah->id_bank_sampah.'" selected>'.$bank_sampah->nama_bank.'</option>';    
                                                }else {
                                                    echo '<option value="'.$bank_sampah->id_bank_sampah.'">'.$bank_sampah->nama_bank.'</option>';
                                                }
                                            }
                                echo '</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="col-sm-3 control-label">Jenis Sampah</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_sampah" name="jenis_sampah">';
                                            $jenis_sampah=$this->jenis_sampah();
                                            foreach ($jenis_sampah->result() as $js_sampah) {
                                                if($row->ID_JENIS==$js_sampah->id_jenis){
                                                    echo '<option value="'.$js_sampah->id_jenis.'" selected>'.$js_sampah->nama_jenis.'</option>';    
                                                }else{
                                                    echo '<option value="'.$js_sampah->id_jenis.'">'.$js_sampah->nama_jenis.'</option>';    
                                                }
                                            }
                                    echo '</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="berat" class="col-sm-3 control-label">Berat :</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="berat" name="berat" required="" value="'.$row->BERAT.'">
                                        <span class="input-group-addon" id="basic-addon1">Kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="" class="col-sm-3 control-label">Tujuan Setor :</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <textarea class="form-control" id="tujuan" name="tujuan" value="">'.$row->tujuan_setor.'</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="float: right;">Update Data</button>
                        </div>
                    </div>            
                </div> <!-- / panel preview -->
                </form>';
            }
        }
    }
    function update_ajax_ts_keluar_bs($id_transaksi,$tanggal,$jenis_sampah,$bank_sampah,$berat,$tujuan_setor){
        $sql="UPDATE TRANSAKSI_KELUAR SET TANGGAL='".$tanggal."', DARI='".$bank_sampah."', BERAT=".$berat.",tujuan_setor='".$tujuan_setor."' WHERE ID_TRANSAKSI='".$id_transaksi."'";
        $rs=$this->db->query($sql);
        if($rs){
            $sql="UPDATE RELASI_TRANSAKSI_KELUAR SET id_jenis='".$jenis_sampah."' WHERE ID_TRANSAKSI='".$id_transaksi."'";
            $update=$this->db->query($sql);
            if($update){
                return 1;
            }
        }
    }
    function hapus_ajax_ts_keluar_bs($id_transaksi,$id_kelurahan){
        $sql="DELETE FROM RELASI_TRANSAKSI_KELUAR where id_transaksi='".$id_transaksi."'";
        $hapus1=$this->db->query($sql);
        if($hapus1){
            $sql="DELETE from transaksi_keluar where id_transaksi='".$id_transaksi."'";
            $hapus2=$this->db->query($sql);
            if ($hapus2) {
                return 1;
            }
        }
    }
    function load_jenis_sampah(){
        $sql="SELECT * FROM JENIS_SAMPAH";
        $rs=$this->db->query($sql);
        if($rs){
            return $rs;
        }
    }
    function count_jenis_sampah(){
        $sql="SELECT COUNT(id_jenis) as HASIL FROM JENIS_SAMPAH";
        $rs=$this->db->query($sql);
        if($rs){
            return $rs;
        }
    }
    function insert_jenis_sampah($id_jenis,$nama_jenis){
        $sql="INSERT INTO JENIS_SAMPAH VALUES('".$id_jenis."','".$nama_jenis."')";
        $rs=$this->db->query($sql);
        if ($rs) {
            return 1;
        }else return 2;
    }
    function edit_ajax_jenis_sampah($id_jenis){
        $sql="select * from jenis_sampah where id_jenis='".$id_jenis."'";
        $rs=$this->db->query($sql);
        if($rs){
            foreach ($rs->result() as $row) {
                 echo '<form action="'.base_url().'index.php/proses_db/update_ajax_jenis_sampah" method="POST" enctype="multipart/form-data">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                      <div class="panel-body form-horizontal payment-form">
                            <div class="form-group">
                                <label for="id_jenis" class="col-sm-3 control-label">TID Jenis</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="id_jenis" name="id_jenis" value="'.$row->id_jenis.'" readonly="true">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="nama_jenis" class="col-sm-3 control-label">Nama Jenis</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" value="'.$row->nama_jenis.'">
                                </div>
                            </div>  
                            <button type="submit" class="btn btn-primary" style="float: right;">Update Data</button>
                        </div>
                    </div>            
                </div> <!-- / panel preview -->
                </form>';
            }
        }
    }
    function update_ajax_jenis_sampah($id_jenis,$nama_jenis){
        $sql="UPDATE JENIS_SAMPAH SET nama_jenis='".$nama_jenis."' WHERE id_jenis='".$id_jenis."'";
        $rs=$this->db->query($sql);
        if ($rs) {
            return 1;
        }else return 2;
    }
    function hapus_ajax_jenis_sampah($id){
        $sql="DELETE FROM JENIS_SAMPAH WHERE id_jenis='".$id."'";
        $rs=$this->db->query($sql);
        if ($rs) {
            return 1;
        }else return 2;
    }

    
    function rekap_transaksi_masuk_pengepul(){
        $sql="SELECT data_pengepul.nama_pengepulan,MONTH(transaksi_masuk.tanggal) as bulan,YEAR(transaksi_masuk.tanggal) AS Tahun,SUM(transaksi_masuk.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan FROM data_lokasi,transaksi_masuk,data_pengepul,jenis_sampah,relasi_transaksi_masuk,kelurahan WHERE data_pengepul.id_pengepul=transaksi_masuk.dari and relasi_transaksi_masuk.jenis_sampah=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and data_pengepul.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_masuk.id_transaksi=transaksi_masuk.id_transaksi GROUP BY data_pengepul.id_pengepul,bulan,tahun";
        $rs=$this->db->query($sql);
        if ($rs) {
            return $rs;
        }
    }
    function rekap_table_admin($periode,$tanggal_dari,$tanggal_akhir,$jenis_sampah){
        if($periode=='bulan'){
            $sql="SELECT data_pengepul.nama_pengepulan,MONTH(transaksi_masuk.tanggal) as bulan,YEAR(transaksi_masuk.tanggal) AS Tahun,SUM(transaksi_masuk.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan FROM data_lokasi,transaksi_masuk,data_pengepul,jenis_sampah,relasi_transaksi_masuk,kelurahan WHERE data_pengepul.id_pengepul=transaksi_masuk.dari and relasi_transaksi_masuk.jenis_sampah=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and data_pengepul.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_masuk.id_transaksi=transaksi_masuk.id_transaksi and jenis_sampah.id_jenis='".$jenis_sampah."' and transaksi_masuk.tanggal >='".$tanggal_dari."'  and transaksi_masuk.tanggal <= '".$tanggal_akhir."' GROUP BY data_pengepul.id_pengepul,bulan,tahun";
            $rs=$this->db->query($sql);
            if($rs){
                foreach ($rs->result() as $row) {
                    echo '<tr>
                            <td>'.$row->bulan.'/'.$row->Tahun.'</td>
                            <td>'.$row->nama_kelurahan.'</td>
                            <td>'.$row->nama_pengepulan.'</td>
                            <td>'.$row->nama_jenis.'</td>
                            <td>'.$row->berat.'</td>
                        </tr>';
                }
                //$myObj=json_encode($rs->result());
                //echo $myObj;
                return $rs;
            }
        }else{
            $sql="SELECT data_pengepul.nama_pengepulan,YEAR(transaksi_masuk.tanggal) AS Tahun,SUM(transaksi_masuk.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan FROM data_lokasi,transaksi_masuk,data_pengepul,jenis_sampah,relasi_transaksi_masuk,kelurahan WHERE data_pengepul.id_pengepul=transaksi_masuk.dari and relasi_transaksi_masuk.jenis_sampah=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and data_pengepul.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_masuk.id_transaksi=transaksi_masuk.id_transaksi and jenis_sampah.id_jenis='".$jenis_sampah."' and transaksi_masuk.tanggal >='".$tanggal_dari."'  and transaksi_masuk.tanggal <= '".$tanggal_akhir."' GROUP BY data_pengepul.id_pengepul,tahun";
            $rs=$this->db->query($sql);
            if($rs){
                foreach ($rs->result() as $row) {
                    echo '<tr>
                            <td>'.$row->Tahun.'</td>
                            <td>'.$row->nama_kelurahan.'</td>
                            <td>'.$row->nama_pengepulan.'</td>
                            <td>'.$row->nama_jenis.'</td>
                            <td>'.$row->berat.'</td>
                        </tr>';
                }
            }
        }
    }
    function rekap_transaksi_masuk_bs(){
        $sql="SELECT bank_sampah.nama_bank,MONTH(transaksi_masuk.tanggal) as bulan,YEAR(transaksi_masuk.tanggal) AS Tahun,SUM(transaksi_masuk.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan FROM data_lokasi,transaksi_masuk,bank_sampah,jenis_sampah,relasi_transaksi_masuk,kelurahan WHERE bank_sampah.id_bank_sampah=transaksi_masuk.dari and relasi_transaksi_masuk.jenis_sampah=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and bank_sampah.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_masuk.id_transaksi=transaksi_masuk.id_transaksi GROUP BY bank_sampah.id_bank_sampah,bulan,tahun";
        $rs=$this->db->query($sql);
        if ($rs) {
            return $rs;
        }
    }
    function rekap_ts_masuk_table_bs($periode,$tanggal_dari,$tanggal_akhir,$jenis_sampah){
        if($periode=='bulan'){
            $sql="SELECT bank_sampah.nama_bank,MONTH(transaksi_masuk.tanggal) as bulan,YEAR(transaksi_masuk.tanggal) AS Tahun,SUM(transaksi_masuk.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan FROM data_lokasi,transaksi_masuk,bank_sampah,jenis_sampah,relasi_transaksi_masuk,kelurahan WHERE bank_sampah.id_bank_sampah=transaksi_masuk.dari and relasi_transaksi_masuk.jenis_sampah=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and bank_sampah.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_masuk.id_transaksi=transaksi_masuk.id_transaksi and jenis_sampah.id_jenis='".$jenis_sampah."' and transaksi_masuk.tanggal >='".$tanggal_dari."'  and transaksi_masuk.tanggal <= '".$tanggal_akhir."' GROUP BY bank_sampah.id_bank_sampah,bulan,tahun";
            $rs=$this->db->query($sql);
            if($rs){
                foreach ($rs->result() as $row) {
                    echo '<tr>
                            <td>'.$row->bulan.'/'.$row->Tahun.'</td>
                            <td>'.$row->nama_kelurahan.'</td>
                            <td>'.$row->nama_bank.'</td>
                            <td>'.$row->nama_jenis.'</td>
                            <td>'.$row->berat.'</td>
                        </tr>';
                }
            }
            return $rs;
        }else{
            $sql="SELECT bank_sampah.nama_bank,YEAR(transaksi_masuk.tanggal) AS Tahun,SUM(transaksi_masuk.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan FROM data_lokasi,transaksi_masuk,bank_sampah,jenis_sampah,relasi_transaksi_masuk,kelurahan WHERE bank_sampah.id_bank_sampah=transaksi_masuk.dari and relasi_transaksi_masuk.jenis_sampah=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and bank_sampah.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_masuk.id_transaksi=transaksi_masuk.id_transaksi and jenis_sampah.id_jenis='".$jenis_sampah."' and transaksi_masuk.tanggal >='".$tanggal_dari."'  and transaksi_masuk.tanggal <= '".$tanggal_akhir."' GROUP BY bank_sampah.id_bank_sampah,tahun";
            $rs=$this->db->query($sql);
            if($rs){
                foreach ($rs->result() as $row) {
                    echo '<tr>
                            <td>'.$row->Tahun.'</td>
                            <td>'.$row->nama_kelurahan.'</td>
                            <td>'.$row->nama_pengepulan.'</td>
                            <td>'.$row->nama_jenis.'</td>
                            <td>'.$row->berat.'</td>
                        </tr>';
                }
            }
            return $rs;
        }
    }
    function rekap_transaksi_keluar_pengepul(){
        $sql="SELECT data_pengepul.nama_pengepulan,MONTH(transaksi_keluar.tanggal) as bulan,YEAR(transaksi_keluar.tanggal) AS Tahun,SUM(transaksi_keluar.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan,transaksi_keluar.tujuan_setor FROM data_lokasi,transaksi_keluar,data_pengepul,jenis_sampah,relasi_transaksi_keluar,kelurahan WHERE data_pengepul.id_pengepul=transaksi_keluar.dari and relasi_transaksi_keluar.id_jenis=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and data_pengepul.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_keluar.id_transaksi=transaksi_keluar.id_transaksi GROUP BY data_pengepul.id_pengepul,bulan,tahun";
        $rs=$this->db->query($sql);
        if ($rs) {
            return $rs;
        }
    }
    function rekap_ts_keluar_table_pengepul($periode,$tanggal_dari,$tanggal_akhir,$jenis_sampah){
        if($periode=='bulan'){
            $sql="SELECT data_pengepul.nama_pengepulan,MONTH(transaksi_keluar.tanggal) as bulan,YEAR(transaksi_keluar.tanggal) AS Tahun,SUM(transaksi_keluar.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan,transaksi_keluar.tujuan_setor FROM data_lokasi,transaksi_keluar,data_pengepul,jenis_sampah,relasi_transaksi_keluar,kelurahan WHERE data_pengepul.id_pengepul=transaksi_keluar.dari and relasi_transaksi_keluar.id_jenis=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and data_pengepul.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_keluar.id_transaksi=transaksi_keluar.id_transaksi and jenis_sampah.id_jenis='".$jenis_sampah."' and transaksi_keluar.tanggal >='".$tanggal_dari."'  and transaksi_keluar.tanggal <= '".$tanggal_akhir."' GROUP BY data_pengepul.id_pengepul,bulan,tahun";
            $rs=$this->db->query($sql);
            if($rs){
                foreach ($rs->result() as $row) {
                    echo '<tr>
                            <td>'.$row->bulan.'/'.$row->Tahun.'</td>
                            <td>'.$row->nama_kelurahan.'</td>
                            <td>'.$row->nama_pengepulan.'</td>
                            <td>'.$row->nama_jenis.'</td>
                            <td>'.$row->berat.'</td>
                            <td>'.$row->tujuan_setor.'</td>
                        </tr>';
                }
                return $rs;
            }
        }else{
            $sql="SELECT data_pengepul.nama_pengepulan,YEAR(transaksi_keluar.tanggal) AS Tahun,SUM(transaksi_keluar.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan,transaksi_keluar.tujuan_setor FROM data_lokasi,transaksi_keluar,data_pengepul,jenis_sampah,relasi_transaksi_keluar,kelurahan WHERE data_pengepul.id_pengepul=transaksi_keluar.dari and relasi_transaksi_keluar.id_jenis=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and data_pengepul.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_keluar.id_transaksi=transaksi_keluar.id_transaksi and jenis_sampah.id_jenis='".$jenis_sampah."' and transaksi_keluar.tanggal >='".$tanggal_dari."'  and transaksi_keluar.tanggal <= '".$tanggal_akhir."' GROUP BY data_pengepul.id_pengepul,tahun";
            $rs=$this->db->query($sql);
            if($rs){
                foreach ($rs->result() as $row) {
                    echo '<tr>
                            <td>'.$row->Tahun.'</td>
                            <td>'.$row->nama_kelurahan.'</td>
                            <td>'.$row->nama_pengepulan.'</td>
                            <td>'.$row->nama_jenis.'</td>
                            <td>'.$row->berat.'</td>
                            <td>'.$row->tujuan_setor.'</td>
                        </tr>';
                }
                return $rs;
            }
        }
    }
    function rekap_transaksi_keluar_bs(){
        $sql="SELECT bank_sampah.nama_bank,MONTH(transaksi_keluar.tanggal) as bulan,YEAR(transaksi_keluar.tanggal) AS Tahun,SUM(transaksi_keluar.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan,transaksi_keluar.tujuan_setor FROM data_lokasi,transaksi_keluar,bank_sampah,jenis_sampah,relasi_transaksi_keluar,kelurahan WHERE bank_sampah.id_bank_sampah=transaksi_keluar.dari and relasi_transaksi_keluar.id_jenis=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and bank_sampah.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_keluar.id_transaksi=transaksi_keluar.id_transaksi GROUP BY bank_sampah.id_bank_sampah,bulan,tahun";
        $rs=$this->db->query($sql);
        if ($rs) {
            return $rs;
        }
    }
    function rekap_ts_keluar_table_bs($periode,$tanggal_dari,$tanggal_akhir,$jenis_sampah){
        if($periode=='bulan'){
            $sql="SELECT bank_sampah.nama_bank,MONTH(transaksi_keluar.tanggal) as bulan,YEAR(transaksi_keluar.tanggal) AS Tahun,SUM(transaksi_keluar.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan,transaksi_keluar.tujuan_setor FROM data_lokasi,transaksi_keluar,bank_sampah,jenis_sampah,relasi_transaksi_keluar,kelurahan WHERE bank_sampah.id_bank_sampah=transaksi_keluar.dari and relasi_transaksi_keluar.id_jenis=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and bank_sampah.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_keluar.id_transaksi=transaksi_keluar.id_transaksi and jenis_sampah.id_jenis='".$jenis_sampah."' and transaksi_keluar.tanggal >='".$tanggal_dari."'  and transaksi_keluar.tanggal <= '".$tanggal_akhir."' GROUP BY bank_sampah.id_bank_sampah,bulan,tahun";
            $rs=$this->db->query($sql);
            if($rs){
                foreach ($rs->result() as $row) {
                    echo '<tr>
                            <td>'.$row->bulan.'/'.$row->Tahun.'</td>
                            <td>'.$row->nama_kelurahan.'</td>
                            <td>'.$row->nama_bank.'</td>
                            <td>'.$row->nama_jenis.'</td>
                            <td>'.$row->berat.'</td>
                            <td>'.$row->tujuan_setor.'</td>
                        </tr>';
                }
            }
            return $rs;
        }else{
            $sql="SELECT bank_sampah.nama_bank,YEAR(transaksi_keluar.tanggal) AS Tahun,SUM(transaksi_keluar.berat) as berat,jenis_sampah.nama_jenis,kelurahan.nama_kelurahan,transaksi_keluar.tujuan_setor FROM data_lokasi,transaksi_keluar,bank_sampah,jenis_sampah,relasi_transaksi_keluar,kelurahan WHERE bank_sampah.id_bank_sampah=transaksi_keluar.dari and relasi_transaksi_keluar.id_jenis=jenis_sampah.id_jenis and data_lokasi.kelurahan=kelurahan.id_kelurahan and bank_sampah.id_lokasi=data_lokasi.id_lokasi AND relasi_transaksi_keluar.id_transaksi=transaksi_keluar.id_transaksi and jenis_sampah.id_jenis='".$jenis_sampah."' and transaksi_keluar.tanggal >='".$tanggal_dari."'  and transaksi_keluar.tanggal <= '".$tanggal_akhir."' GROUP BY bank_sampah.id_bank_sampah,tahun";
            $rs=$this->db->query($sql);
            if($rs){
                foreach ($rs->result() as $row) {
                    echo '<tr>
                            <td>'.$row->Tahun.'</td>
                            <td>'.$row->nama_kelurahan.'</td>
                            <td>'.$row->nama_pengepulan.'</td>
                            <td>'.$row->nama_jenis.'</td>
                            <td>'.$row->berat.'</td>
                            <td>'.$row->tujuan_setor.'</td>
                        </tr>';
                }
            }
            return $rs;
        }
    }
}
