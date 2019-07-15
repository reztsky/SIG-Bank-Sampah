<header class="masthead text-center text-white" style=>
      <div class="masthead-content">
       <div class="container">
        	<div class="row">
            <div id="peta_mini" class="col-md-12" style="height: 500px;"></div>    
          </div>
			</div>
        </div>
      </div>      
      </div>
</header>
 
    
    <script type="text/javascript">
      var content;
      var data=[[]];
      var i=0;
      var bank=[[]];
      var y=0;
    	function initialize() {
    		 var center={lat:-7.2784256,lng:112.7607396};
                var propertiPeta={
                    center:center,
                    zoom:12,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                };
                var map= new google.maps.Map(document.getElementById("peta_mini"), propertiPeta);
                var marker=new google.maps.Marker({
                    position: center,
                    map: map,
                });
                var contentString="<h5>Dinas Kebersihan dan Ruang Terbuka Hijau</h5>"
                var infowindow=new google.maps.InfoWindow({
                    content:contentString,
                    position:center,  
                })
                marker.addListener('click',function(){
                  infowindow.open(map,marker);
                });
            <?php
          foreach ($hasil->result() as $row) {
            
            echo ("data[i]=['".$row->nama_pengepulan."','".$row->no_telp."','".$row->jumlah_pegawai."','".$row->alamat_jalan."','".$row->keterangan_lokasi."','".$row->id_pengepul."'];\n");

            echo ("addMarker($row->latitude,$row->longtitude,data,i);\n");
            echo "i=i+1;";
          } 
        ?>
        <?php
          //print_r($bank->result()) ;
          foreach ($bank->result() as $row) {
            //echo $row->no_telp;
            echo ("bank[y]=['".$row->nama_bank."','".$row->no_telp."','".$row->jumlah_nasabah."','".$row->alamat_jalan."','".$row->keterangan_lokasi."','".$row->id_bank_sampah."'];\n");
            echo ("addMarkerBank($row->latitude,$row->longtitude,bank,y);\n");
            echo "y=y+1;";
          }
        ?>

        //Create and open InfoWindow.
        var infoWindow = new google.maps.InfoWindow();

        function addMarker(lat,lng,info,i){
          var markerLokasi=new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng) ,
                map: map,
                title: 'coba'
          });
          markerLokasi.setMap(map);
          //Attach click event to the marker.
            (function (markerLokasi, info) {
              //console.log(info[i][5]);
                google.maps.event.addListener(markerLokasi, "click", function (e) {
                  content='<div class="" style="color:black;width:400px;"><table class="table borderless"><tr align="left"><td>Nama Pengepulan</td><td>'+ info[i][0]+'</td></tr><tr align="left"><td>No. Telp</td><td>'+ info[i][1]+'</td></tr><tr align="left"><td>Jumlah Pegawai</td><td>'+ info[i][2]+'</td></tr><tr align="left"><td>Alamat Lokasi</td><td>'+ info[i][3]+'</td></tr><tr align="left"><td>Keterangan Lokasi</td><td>'+ info[i][4]+'</td></tr><tr><td colspan=2 align="right"><a href="<?php echo base_url()?>/index.php/c_utama/more_info?id_pengepul='+info[i][5]+'">More Info</a></td></tr></table></div>';
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    infoWindow.setContent(content);
                    infoWindow.open(map, markerLokasi);
                });
            })(markerLokasi, info);
        }

        function addMarkerBank(lat,lng,info,y){
          var markerLokasi=new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng) ,
                map: map,
                title: 'coba'
          });
          markerLokasi.setMap(map);
          //Attach click event to the marker.
            (function (markerLokasi, info) {
              console.log(info);
                google.maps.event.addListener(markerLokasi, "click", function (e) {
                  content='<div class="" style="color:black;width:400px;"><table class="table borderless"><tr align="left"><td>Nama Pengepulan</td><td>'+ info[y][0]+'</td></tr><tr align="left"><td>No. Telp</td><td>'+ info[y][1]+'</td></tr><tr align="left"><td>Jumlah Pegawai</td><td>'+ info[y][2]+'</td></tr><tr align="left"><td>Alamat Lokasi</td><td>'+ info[y][3]+'</td></tr><tr align="left"><td>Keterangan Lokasi</td><td>'+ info[y][4]+'</td></tr><tr><td colspan=2 align="right"><a href="<?php echo base_url()?>/index.php/c_utama/more_info?id_pengepul='+info[y][5]+'">More Info</a></td></tr></table></div>';
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    infoWindow.setContent(content);
                    infoWindow.open(map, markerLokasi);
                });
            })(markerLokasi, info);
        }
    	}
    	google.maps.event.addDomListener(window, 'load', initialize);
    </script>
