<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<?php echo $this->session->flashdata('message');?>
<div class="table-responsive">
	<table class="table" id="table_id">
		<thead>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Nama Pengepul</th>
			<th>Jenis Sampah</th>
			<th>Berat</th>
			<th>Aksi</th>
		</thead>
		<tbody>
			<?php
				$no = 1;
                foreach($riwayat->result() as $riwayat){
			?>
				<tr>
	                <td><?php echo $no++;?></td>
	                <td><?php echo $riwayat->TANGGAL;?></td>
	                <td><?php echo $riwayat->NAMA_PENGEPULAN;?></td>
	                <td><?php echo $riwayat->NAMA_JENIS;?></td>
	                <td><?php echo $riwayat->BERAT;?></td>
	                <td style="text-align: center;">
	                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit_modal" onclick='edit(<?php echo '"'.$riwayat->ID_TRANSAKSI.'"';?>)'><i class="glyphicon glyphicon-pencil"></i></button>
	                    <button class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
	                </td>
	            </tr>
	           <?php }?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$.noConflict();
	jQuery( document ).ready(function( $ ) {
	    $('#table_id').DataTable();
	});
	function edit(id_transaksi){
		var xmlhttp=new XMLHttpRequest();
			var param="kode="+id_transaksi;
			xmlhttp.open("GET", "<?php echo base_url()?>/index.php/kelurahan/edit_ajax_ts_masuk?"+param, true);
			xmlhttp.onreadystatechange=function(){
				if(this.readyState == 4 && this.status == 200){
					document.getElementById("coba").innerHTML=this.responseText;
					//document.getElementById("tambah").style.display="none";
					//document.getElementById("editform").style.display="block";
				}
			};
		xmlhttp.send();
		
	}
</script>

<!-- Modal -->
<div class="modal fade" id="Edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-pencil"></span> Edit Transaksi Masuk</h5>
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

