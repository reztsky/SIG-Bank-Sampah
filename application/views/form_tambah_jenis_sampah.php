<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<?php echo $this->session->flashdata('message');?>
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
<form action="<?php echo base_url()?>index.php/proses_db/insert_jenis_sampah" method="POST">
  <div class="form-group">
    <h3>FORMS TAMBAH JENIS SAMPAH</h3>
        <div class="col-md-4">
            <div class="form-group">
              <label for="id_jenis">ID Jenis Sampah</label>
              <input type="text" class="form-control" id="id_jenis" aria-describedby="emailHelp" placeholder="id_jenis" name="id_jenis" required="true" readonly="true" value="<?php echo $count_jenis_sampah->result()[0]->HASIL+1;?>">

            </div>
            <div class="form-group">
              <label for="nama_jenis">Nama Jenis Sampah</label>
              <input type="text" class="form-control" id="nama_jenis" aria-describedby="emailHelp" placeholder="Nama Jenis" name="nama_jenis" required="true">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

 <div class="col-md-8 table-responsive">
    <table class="table" id="table_id">
      <thead>
        <tr>
          <th>No.</th>
          <th>ID Jenis Sampah</th>
          <th>Nama Jenis Sampah</th>
          <th>Aksis</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          foreach ($jenis_sampah->result() as $jenis_sampah) {
        ?>
          <tr>
            <td><?php echo $no++;?></td>
            <td><?php echo $jenis_sampah->id_jenis;?></td>
            <td><?php echo $jenis_sampah->nama_jenis;?></td>
            <td style="text-align: center;">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit_modal" onclick='edit(<?php echo '"'.$jenis_sampah->id_jenis.'"';?>)'><i class="glyphicon glyphicon-pencil"></i></button>
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_modal" onclick='modal_hapus(<?php echo '"'.$jenis_sampah->id_jenis.'"';?>)'><i class="glyphicon glyphicon-trash"></i></button>
            </td>
          </tr>
          <?php } ?>
      </tbody>
    </table>
  </div>
</div>

         


<script type="text/javascript">
  $.noConflict();
  jQuery( document ).ready(function( $ ) {
      $('#table_id').DataTable();
  });
  function edit(id_transaksi){
    var xmlhttp=new XMLHttpRequest();
      var param="kode="+id_transaksi;
      xmlhttp.open("GET", "<?php echo base_url()?>/index.php/c_admin/edit_ajax_jenis_sampah?"+param, true);
      xmlhttp.onreadystatechange=function(){
        if(this.readyState == 4 && this.status == 200){
          document.getElementById("coba").innerHTML=this.responseText;
          //document.getElementById("tambah").style.display="none";
          //document.getElementById("editform").style.display="block";
        }
      };
    xmlhttp.send();
  }
  function modal_hapus(id){
    document.getElementById('id_jenis_sampah_hidden').value=id;
  }
  function hapus(){
    var xmlhttp=new XMLHttpRequest();
    var id=document.getElementById('id_jenis_sampah_hidden').value;
    var param="kode="+id
      xmlhttp.open("GET", "<?php echo base_url()?>/index.php/proses_db/hapus_ajax_jenis_sampah?"+param, true);
      xmlhttp.onreadystatechange=function(){
        if(this.readyState == 4 && this.status == 200){
          alert('Data Berhasil Dihapus')
          window.location="<?php echo base_url()?>/index.php/c_admin/tambah_jenis_sampah";
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
        <h5 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-pencil"></span> Edit Jenis Sampah</h5>
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
      <input type="hidden" name="id_jenis_sampah_hidden" id="id_jenis_sampah_hidden">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
        <button type="button" class="btn btn-danger" onclick="hapus()">Hapus</button>
      </div>
    </div>
  </div>
</div>