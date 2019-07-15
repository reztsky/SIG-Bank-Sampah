<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/modal_delete.css">
<?php echo $this->session->flashdata('message');?>
<style type="text/css">
      .pac-controls {
        display: inline-block;
        padding: 10px 10px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }
</style>
<button class="btn btn-primary" onclick="tampil_data()" id="triger" style="margin-bottom: 10px;">Tampil Data</button>
<div class="form-group">
  <form action="<?php echo base_url()?>index.php/proses_db/insert_pengepul" method="POST"> 
    <div class="row" id="tambah_data">
    <h3>FORMS TAMBAH PENGEPUL</h3>
    <input type="hidden" name="id_pengepul" id="id_pengepul_edit">
    <input type="hidden" name="id_lokasi" id="id_lokasi_edit">
    <div class="col-md-4">
      <div class="form-group">
        <label for="nama_penanggung">Nama Penanggung Jawab</label>
        <input type="text" class="form-control" id="nama_penanggung"  placeholder="Nama Penanggung Jawab" name="nama_penanggung" required="true">
      </div>
       <div class="form-group">
        <label for="nama_pengepulan">Nama Pengepulan</label>
        <input type="text" class="form-control" id="nama_pengepulan"  placeholder="Nama Pengepulan" name="nama_pengepulan" required="true">
      </div>
      <div class="form-group">
        <label for="no_telp">No Telepon</label>
        <input type="text" class="form-control" id="no_telp" placeholder="No Telepon" name="no_telp" required="true">
      </div>
      <div class="form-group">
        <label for="jum_peg">Jumlah Pegawai</label>
        <input type="text" class="form-control" id="jum_peg" placeholder="Jumlah Pegawai" name="jumlah_pegawai"  onkeypress="return validCheck(event)">
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label><br>
        <textarea id="alamat" rows="4" cols="57" style="width: 100%; display: block;" name="alamat" required="true"></textarea>
      </div>
     <div class="form-group">
        <label for="keterangan_lokasi">Keterangan Lokasi</label><br>
        <textarea id="keterangan_lokasi" rows="4" cols="57" style="width: 100%; display: block;" name="keterangan_lokasi" required="true"></textarea>
    </div>
      <div class="form-group">
        <label for="kecamatan">Kecamatan</label>
        <select class="form-control" name="kecamatan" id="kecamatan" onchange="load_kelurahan()">
          <option value=0>Pilih Kecamatan</option>
           <?php
              if ($this->session->userdata('level')!='admin') {
                foreach ($hasil->result() as $row) {
                  if($row->id_kecamatan==$kecamatan->result()[0]->id_kecamatan){
                    echo '<option value='.$row->id_kecamatan.' selected="true">'.$row->nama_kecamatan.'</option>';  
                  }
                }
              }else {
                foreach ($hasil->result() as $row) {
                  echo '<option value='.$row->id_kecamatan.'>'.$row->nama_kecamatan.'</option>';
                }
              }
            ?>
        </select>
      </div>
      <div class="form-group">
        <label for="kelurahan">Kelurahan</label>
        <input type="hidden" name="coba" id="coba">
        <select class="form-control" name="kelurahan" id="kelurahan">
          <option value=0>Pilih Kelurahan</option>
          <?php
            if ($this->session->userdata('level')!='admin') {
              foreach ($kelurahan->result() as $row) {
                echo '<option value='.$row->id_kelurahan.' selected="true">'.$row->nama_kelurahan.'</option>';  
              }
            }
          ?>
            
        </select>
      </div>
    <div class="form-group">
    <label for="longtitude">Longitude</label>
    <input type="text" class="form-control" id="longtitude" aria-describedby="emailHelp" placeholder="Longitude" name="longtitude" required="true" readonly="true">
  </div>
   <div class="form-group">
    <label for="latitude">Latitude</label>
    <input type="text" class="form-control" id="latitude" aria-describedby="emailHelp" placeholder="Latitude" name="latitude" required="true" readonly="true">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<div class="col-md-8 col-xs-12 col-sm-12" id="peta">
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="peta_mini" style="height: 400px;"></div>
</div>
</div>
<div class="row hide" id="list_data">
  <div class="col-md-12 col-xs-12 col-sm-12 table-responsive" >
    <table class="table" id="my-table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Bank Sampah</th>
          <th>Penanggung Jawab</th>
          <th>No. Telpon</th>
          <th>Alamat</th>
          <th>Keterangan Lokasi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $no = 1;
          foreach ($pengepul->result() as $row) { 
        ?>
        <tr>
          <td><?php echo $no;?></td>
          <td><?php echo $row->nama_pengepulan?></td>
          <td><?php echo $row->penanggung_jawab?></td>
          <td><?php echo $row->no_telp?></td>
          <td><?php echo $row->alamat_jalan.','.$row->nama_kelurahan.','.$row->nama_kecamatan?></td>
          <td><?php echo $row->keterangan_lokasi?></td>
          <td>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit_modal" onclick='edit(<?php echo '"'.$row->id_pengepul.'"';?>)'><i class="glyphicon glyphicon-pencil"></i></button>
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_modal" onclick='modal_hapus(<?php echo '"'.$row->id_pengepul.'"';?>,<?php echo '"'.$row->id_lokasi.'"';?>)'><i class="glyphicon glyphicon-trash"></i></button>
          </td>
        </tr>  
        <?php $no++;} ?>
      </tbody>
    </table>
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
      <input type="hidden" name="id_pengepul" id="id_pengepul">
      <input type="hidden" name="id_lokasi" id="id_lokasi">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
        <button type="button" class="btn btn-danger"  onclick="hapus()">Hapus</button>
      </div>
    </div>
  </div>
</div>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0&language=id&region=ID&callback=initialize&libraries=places"
    async defer></script>

    <script type="text/javascript">
       $.noConflict();
      jQuery( document ).ready(function( $ ) {
          $('#my-table').DataTable();
      });
      function modal_hapus(id_pengepul,id_lokasi){
        $('#id_pengepul').val(id_pengepul);
        $('#id_lokasi').val(id_lokasi);
      }
      function hapus(){
        var id_pengepul=document.getElementById('id_pengepul').value;
        var id_lokasi=document.getElementById('id_lokasi').value;
        window.location.href="<?php echo base_url()?>/index.php/proses_db/hapus_peng?kode="+id_pengepul+"&&id_lokasi="+id_lokasi;
      }
      function tampil_data(){
        if ( $("#list_data").hasClass( 'hide' ) ) {
         $("#list_data").hide().removeClass('hide'); 
         $("#list_data").show();
         $("#tambah_data").hide().addClass('hide'); 
         $("#triger").text('Tambah Data');
        }else {
          $("#list_data").hide().addClass('hide'); 
          $("#tambah_data").hide().removeClass('hide'); 
          $("#tambah_data").show();
          $("#triger").text('Tampil Data');
         //$("#list_data").show();
        }
      }
      function load_kelurahan(){
        var xmlhttp=new XMLHttpRequest();
        var id=document.getElementById('kecamatan').value;
        var coba=document.getElementById('coba').value;
        console.log(coba);
        var param="id="+id+"&&coba="+coba;
         <?php 
          if($this->session->userdata('level')!='admin'){
            echo 'xmlhttp.open("POST", "'.base_url().'/index.php/kelurahan/load_kelurahan", true);';
          }else{
            echo 'xmlhttp.open("POST", "'.base_url().'/index.php/c_admin/load_kelurahan", true);';
          }
        ?>
        //xmlhttp.open("POST", "<?php echo base_url()?>/index.php/kelurahan/load_kelurahan", true);
        xmlhttp.onreadystatechange=function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("kelurahan").innerHTML=this.responseText;
          }
        };
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(param);
      }
      function edit(id_pengepul){
        var xmlhttp=new XMLHttpRequest();
        var param="id_pengepul="+id_pengepul;
        //alert(id_bank_sampah);
        <?php 
          if($this->session->userdata('level')!='admin'){
            echo 'xmlhttp.open("GET", "'.base_url().'/index.php/proses_db/edit_ajax_pengepul?"+param, true);';
          }else{
            echo 'xmlhttp.open("GET", "'.base_url().'/index.php/proses_db/edit_ajax_pengepul?"+param, true);';
          }
        ?>
        xmlhttp.onreadystatechange=function(){
          if(this.readyState == 4 && this.status == 200){
              var myObj = JSON.parse(this.responseText);
              console.log(myObj);
              if ( $("#list_data").hasClass( 'hide' ) ) {
               $("#list_data").hide().removeClass('hide'); 
               $("#list_data").show();
               $("#tambah_data").hide().addClass('hide'); 
               $("#triger").text('Tambah Data');
              }else {
                $("#list_data").hide().addClass('hide'); 
                $("#tambah_data").hide().removeClass('hide'); 
                $("#tambah_data").show();
                $("#triger").text('Tampil Data');
               //$("#list_data").show();
              }

              
              $('#nama_penanggung').val(myObj[0]['penanggung_jawab']);
              $('#nama_pengepulan').val(myObj[0]['nama_pengepulan']);
              $('#no_telp').val(myObj[0]['no_telp']);
              $('#jum_peg').val(myObj[0]['jumlah_pegawai']);
              $('textarea#alamat').text(myObj[0]['alamat_jalan']);
              $('textarea#keterangan_lokasi').text(myObj[0]['keterangan_lokasi']);
              $('#kecamatan').val(myObj[0]['kecamatan']);
              $('#coba').val(myObj[0]['kelurahan']);
              <?php 
                if($this->session->userdata('level')=='admin'){
                  echo 'load_kelurahan();';
                }else{
                  
                }
              ?>
              $('#kelurahan').val(myObj[0]['kelurahan']);
              $('#longtitude').val(myObj[0]['longtitude']);
              $('#latitude').val(myObj[0]['latitude']);
              $('#id_pengepul_edit').val(myObj[0]['id_pengepul']);
              $('#id_lokasi_edit').val(myObj[0]['id_lokasi']);

          }
        };
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(param);
      }
    </script>
        <script type="text/javascript">
          var marker;
          
          function tambahMarker(map,koordinat){
                if(marker){
                  //clearMarkers();
                  marker.setPosition(koordinat);
                  //console.log(markers);
                }else{
                  marker=new google.maps.Marker({
                        position: koordinat,
                        map: map,
                  });
                }
                document.getElementById("latitude").value = koordinat.lat();
                document.getElementById("longtitude").value = koordinat.lng();
          }
            function initialize(){
                var geocoder = new google.maps.Geocoder();
                var center={lat:-7.2784256,lng:112.7607396};
                var propertiPeta={
                    center:center,
                    zoom:15,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                };
                var map= new google.maps.Map(document.getElementById("peta_mini"), propertiPeta);
                var marker=new google.maps.Marker({
                    position: center,
                    map: map,
                });
                var contentString="<h5 style='color:black;'>Dinas Kebersihan dan Ruang Terbuka Hijau</h5>"
                var infowindow=new google.maps.InfoWindow({
                    content:contentString,
                    position:center,  
                })
                /*marker.addListener('click',function(){
                  infowindow.open(peta,marker);
                });*/
               
                var markers = [];

                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                map.addListener('bounds_changed', function() {
                  searchBox.setBounds(map.getBounds());
                });
                
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {

                  var places = searchBox.getPlaces();

                  if (places.length == 0) {
                    return;
                  }

                  // Clear out the old markers.
                  markers.forEach(function(marker) {
                    marker.setMap(null);
                  });
                  markers = [];
                  var location;
                  // /var service = new google.maps.places.PlacesService(map);
                  // For each place, get the icon, name and location.
                  var bounds = new google.maps.LatLngBounds();
                  places.forEach(function(place) {
                    location=place.geometry.location;

                    //document.getElementById('alamat').value= place.formatted_address;
                    document.getElementById('latitude').value=location.lat();
                    document.getElementById('longtitude').value=location.lng();
                    if (!place.geometry) {
                      console.log("Returned place contains no geometry");
                      return;
                    }
                    var icon = {
                      url: place.icon,
                      size: new google.maps.Size(71, 71),
                      origin: new google.maps.Point(0, 0),
                      anchor: new google.maps.Point(17, 34),
                      scaledSize: new google.maps.Size(25, 25)
                    };
                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                      map: map,
                      icon: icon,
                      title: place.name,
                      position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                      // Only geocodes have viewport.
                      bounds.union(place.geometry.viewport);
                    } else {
                      bounds.extend(place.geometry.location);
                    }
                  });
                  map.fitBounds(bounds);
                });
                google.maps.event.addListener(map, 'click', function(event) {
                    markers.forEach(function(marker) {
                    marker.setMap(null);
                    });
                    markers = [];
                  tambahMarker(this, event.latLng);
                });
            }
            google.maps.event.addDomListener(window, 'load', initialize);

            function validCheck(e) {
            var keyCode = (e.which) ? e.which : e.keyCode;
            if ((keyCode >= 48 && keyCode <= 57) || (keyCode == 8))
                return true;
            else if (keyCode == 46) {
                var curVal = document.activeElement.value;
                if (curVal != null && curVal.trim().indexOf('.') == -1)
                    return true;
                else
                    return false;
            }
            else
                return false;
        
        }
        </script>