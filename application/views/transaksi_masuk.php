<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style type="text/css">
  .modal-confirm {    
    color: #636363;
    width: 400px;
  }
  .modal-confirm .modal-content {
    padding: 20px;
    border-radius: 5px;
    border: none;
        text-align: center;
    font-size: 14px;
  }
  .modal-confirm .modal-header {
    border-bottom: none;   
        position: relative;
  }
  .modal-confirm h4 {
    text-align: center;
    font-size: 26px;
    margin: 30px 0 -10px;
  }
  .modal-confirm .close {
        position: absolute;
    top: -5px;
    right: -2px;
  }
  .modal-confirm .modal-body {
    color: #999;
  }
  .modal-confirm .modal-footer {
    border: none;
    text-align: center;   
    border-radius: 5px;
    font-size: 13px;
    padding: 10px 15px 25px;
  }
  .modal-confirm .modal-footer a {
    color: #999;
  }   
  .modal-confirm .icon-box {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    border-radius: 50%;
    z-index: 9;
    text-align: center;
    border: 3px solid #f15e5e;
  }
  .modal-confirm .icon-box i {
    color: #f15e5e;
    font-size: 46px;
    display: inline-block;
    margin-top: 13px;
  }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
    background: #60c7c1;
    text-decoration: none;
    transition: all 0.4s;
        line-height: normal;
    min-width: 120px;
        border: none;
    min-height: 40px;
    border-radius: 3px;
    margin: 0 5px;
    outline: none !important;
    }
  .modal-confirm .btn-info {
        background: #c1c1c1;
    }
    .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
        background: #a8a8a8;
    }
    .modal-confirm .btn-danger {
        background: #f15e5e;
    }
    .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }
</style>

<div class="row">
	<?php
		if(isset($_SESSION['message'])){
			echo $_SESSION['message'];
		}
	?>
	<form action="<?php echo base_url()?>index.php/kelurahan/insert_transaksi_pengepul" method="POST" enctype="multipart/form-data">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<h3>Input Transaksi Masuk Pengepul</h3>
			<div class="panel panel-default">
			  <div class="panel-body form-horizontal payment-form">
					<div class="form-group">
						<label for="date" class="col-sm-3 control-label">Tanggal</label>
						<div class="col-sm-9">
							<input type="date" class="form-control" id="date" name="tanggal">
						</div>
					</div>  
					<div class="form-group">
						<label for="lokasi" class="col-sm-3 control-label">Pilih Pengepul</label>
						<div class="col-sm-9">
							<select class="form-control" id="pengepul" name="pengepul">
								<?php 
									$pengepul=$data['pengepul'];
									foreach ($pengepul->result() as $row) {
										echo '<option value="'.$row->id_pengepul.'">'.$row->nama_pengepulan.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="lokasi" class="col-sm-3 control-label">Jenis Sampah</label>
						<div class="col-sm-9">
							<select class="form-control" id="jenis_sampah" name="jenis_sampah">
								<?php
									$jenis_sampah=$data['jenis_sampah'];
									foreach ($jenis_sampah->result() as $row) {
										echo '<option value="'.$row->id_jenis.'">'.$row->nama_jenis.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Berat :</label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="text" class="form-control" id="berat" name="berat" required="">
								<span class="input-group-addon" id="basic-addon1">Kg</span>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
				</div>
			</div>            
		</div> <!-- / panel preview -->
	</form>
</div>
<?php //echo print_r($transaksi_masuk_pengepul->result())?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table" id="table_id">
			<thead>
				<tr>
					<th>No.</th>
					<th>Tanggal</th>
					<th>Nama Pengepulan</th>
					<th>Jenis Sampah</th>
					<th>Berat</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="tbody_riwayat">
				<?php 
					$no=1;
					foreach($transaksi_masuk_pengepul->result() as $row){?>
					<tr>
						<td><?php echo $no?></td>
						<td><?php echo $row->tanggal?></td>
						<td><?php echo $row->nama_pengepulan?></td>
						<td><?php echo $row->nama_jenis?></td>
						<td><?php echo $row->berat?></td>
						<td>
							<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit_modal" onclick='edit(<?php echo '"'.$row->id_transaksi.'"';?>)'><i class="glyphicon glyphicon-pencil"></i></button>
                			<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_modal" onclick='modal_hapus(<?php echo '"'.$row->id_transaksi.'"';?>)'><i class="glyphicon glyphicon-trash"></i></button>
						</td>
					</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$.noConflict();
	  jQuery( document ).ready(function( $ ) {
	      $('#table_id').DataTable();
	});
	function edit(id_transaksi) {
		var xmlhttp=new XMLHttpRequest();
	    var param="kode="+id_transaksi;
	    xmlhttp.open("GET", "<?php echo base_url()?>/index.php/proses_db/edit_ajax_ts_masuk?"+param, true);
	    xmlhttp.onreadystatechange=function(){
	   	if(this.readyState == 4 && this.status == 200){
	          document.getElementById("coba").innerHTML=this.responseText;
	          //document.getElementById("tambah").style.display="none";
	          //document.getElementById("editform").style.display="block";
	        }
	    };
	    xmlhttp.send();
	}
	function modal_hapus(id_transaksi){
		document.getElementById('id_transaksi').value=id_transaksi;
	}
	function hapus(){
		var id_transaksi=document.getElementById('id_transaksi').value;
		var xmlhttp=new XMLHttpRequest();
	    var param="kode="+id_transaksi;
	    xmlhttp.open("GET", "<?php echo base_url()?>/index.php/proses_db/hapus_ajax_ts_masuk?"+param, true);
	    xmlhttp.onreadystatechange=function(){
	   	if(this.readyState == 4 && this.status == 200){
	   			document.getElementById("tbody_riwayat").innerHTML=this.responseText;
	   			$('#delete_modal').modal('hide');
	   			alert('Data Berhasil DiHapus');
	        }
	    };
	    xmlhttp.send();

	}
</script>

<!-- Modal Edit -->
<div class="modal fade" id="Edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-pencil"></span> Edit Transaksi Masuk Pengepul</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="coba">
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
        <div class="icon-box">
          <i class="material-icons">&#xE5CD;</i>
        </div>        
        <h4 class="modal-title">Apakah Yakin Ingin Menghapus ?</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Data yang telah dihapus tidak dapat dikembalikan</p>
      </div>
      <input type="hidden" name="id_transaksi" id="id_transaksi">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
        <button type="button" class="btn btn-danger" onclick="hapus()">Hapus</button>
      </div>
    </div>
  </div>
</div>