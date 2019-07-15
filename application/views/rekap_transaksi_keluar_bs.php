<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12">
					<div class="form-group col-md-3 col-xs-12 col-sm-12">
				        <label for="periode">Rekap Berdasarkan</label>
				        <select class="form-control" name="periode" id="periode" onchange="" required="true">
				          <option value="0">Pilih Periode</option>
				          <option value="bulan">Bulan</option>
				          <option value="tahun">Tahun</option>
				        </select>
				    </div>
				    <div class="form-group col-md-3 col-xs-12 col-sm-12">
				        <label for="tanggal_dari">Mulai Dari</label>
				        <input class="form-control" type="date" name="tanggal_dari" id="tanggal_dari" required="true">
				    </div>
				    <div class="form-group col-md-3 col-xs-12 col-sm-12">
				        <label for="tanggal_akhir">Sampai</label>
				        <input class="form-control" type="date" name="tanggal_akhir" id="tanggal_akhir" required="true">
				    </div>
				    <div class="form-group col-md-3 col-xs-12 col-sm-12">
				        <label for="jenis_sampah">Jenis Sampah</label>
				        <select class="form-control" name="jenis_sampah" id="jenis_sampah" required="true">
				        	<option value="0">Pilih Jenis Sampah</option>
				        	<?php foreach($jenis_sampah->result() as $row ){?>
				        		<option value=<?php echo '"'.$row->id_jenis.'"'; ?>><?php echo $row->nama_jenis;?></option>
				        		<?php } ?>
				        </select>
				    </div>
				</div>
				<div class="col-md-12 col-xs-12 col-sm-12">
					<button style="margin-left: 1.3%;" class="btn btn-primary" id="filter">Filter</button>
				</div>
			</div>
		</div>
		<?php //print_r($rekap->result());?>
		<div class="row">
			<a href="<?php echo base_url()?>"></a>
			<div class="col-md-12 col-xs-12 col-sm-12 table-responsive">
				<h3>Rekap</h3>
				<a id="download" href="<?php echo base_url()?>/index.php/c_admin/rekap_transaksi_keluar_bs_excel">Download Excel</a>
				<div id="isiTab">
				<table class="table" id="myTable">
					<thead>
						<th>Bulan/Tahun</th>
						<th>Nama Kelurahan</th>
						<th>Nama Bank Sampah</th>
						<th>Jenis Sampah</th>
						<th>Berat</th>
						<th>Tujuan Setor</th>
					</thead>
					<tbody id="tbody_rekap">
						<?php foreach($rekap->result() as $row) { ?>
						<tr>
							<td><?php echo $row->bulan.'/'.$row->Tahun;?></td>
							<td><?php echo $row->nama_kelurahan;?></td>
							<td><?php echo $row->nama_bank;?></td>
							<td><?php echo $row->nama_jenis;?></td>
							<td><?php echo $row->berat;?></td>
							<td><?php echo $row->tujuan_setor;?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var dataTable;
	$.noConflict();
    jQuery( document ).ready(function( $ ) {
    	var isiTab=document.getElementById('isiTab').innerHTML;
        var arr_tab=[isiTab];
        var json_tab=JSON.stringify(arr_tab);
        $('#download').attr('href','<?php echo base_url()?>/index.php/c_admin/rekap_transaksi_keluar_bs_excel?data='+json_tab);
        dataTable=$('#myTable').DataTable();
	    $('#filter').click(function(){
	    	filter();
	    });
	    function filter(){
	    	var periode=document.getElementById('periode').value;
	    	var tanggal_dari=document.getElementById('tanggal_dari').value;
	    	var tanggal_akhir=document.getElementById('tanggal_akhir').value;
	    	var jenis_sampah=document.getElementById('jenis_sampah').value;

	    	if(periode=='0'||tanggal_akhir==''||tanggal_dari==''||jenis_sampah=='0'){
	    		alert('Pastikan Filter Tidak Ada yang kosong');
	    	}else{
	    		if(tanggal_dari>tanggal_akhir){
	    			alert('Tanggal Mulai Lebih Besar Daripada Tanggal Akhir');
	    		}else{
	    			var xmlhttp=new XMLHttpRequest();
			        var param="periode="+periode+"&tanggal_akhir="+tanggal_akhir+"&tanggal_dari="+tanggal_dari+"&jenis_sampah="+jenis_sampah;
			         <?php 
			          if($this->session->userdata('level')!='admin'){
			            echo 'xmlhttp.open("POST", "'.base_url().'/index.php/proses_db/rekap_ts_keluar_table_bs", true);';
			          }else{
			            echo 'xmlhttp.open("POST", "'.base_url().'/index.php/proses_db/rekap_ts_keluar_table_bs", true);';
			          }
			        ?>
			        //xmlhttp.open("POST", "<?php echo base_url()?>/index.php/kelurahan/load_kelurahan", true);
			        xmlhttp.onreadystatechange=function(){
			          if(this.readyState == 4 && this.status == 200){
			          	dataTable.clear();
			          	dataTable.destroy();
			            document.getElementById("tbody_rekap").innerHTML=this.responseText;
			            var apa=document.getElementById('isiTab').innerHTML;
			           	var arr=[apa];
        				var json=JSON.stringify(arr);
			           	$('#download').attr('href','<?php echo base_url()?>/index.php/c_admin/rekap_transaksi_keluar_bs_excel?data='+json);
			            dataTable=$('#myTable').DataTable();
			          }
			        };
			        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			        xmlhttp.send(param);
	    		}	
	    	}
	    }
    });
</script>