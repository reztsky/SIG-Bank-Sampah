<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Homepage Admin</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>/Assets/css/style3.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        
    </head>
    <body>

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div id="dismiss">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                </div>

                <div class="sidebar-header">
                    <h3>Selamat Datang,Kelurahan <?php echo $hasil->result()[0]->nama_kelurahan?></h3>
                </div>

                <ul class="list-unstyled components">
                    <li class="">
                        <a href="<?php echo base_url()?>index.php/kelurahan"><span class="glyphicon glyphicon-home">&nbsp;</span>Beranda</a>
                    </li>
                    <li class=>
                        <a href="#tambah_master" data-toggle="collapse" aria-expanded="false" style="font-size: 14px;"><span class="glyphicon glyphicon-list-alt">&nbsp;</span>Pengepul / Bank Sampah</a>
                        <ul class="collapse list-unstyled" id="tambah_master">
                            <li><a href="<?php echo base_url()?>index.php/kelurahan/tambah_pengepul">Tambah Pengepul</a></li>
                            <li><a href="<?php echo base_url()?>index.php/kelurahan/tambah_bank">Tambah Bank Sampah</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#ts" data-toggle="collapse" aria-expanded="false"><span class="glyphicon glyphicon-pencil">&nbsp;</span>Input Transaksi</a>
                        <ul class="collapse list-unstyled" id="ts">
                            <a href="#ts_masuk" data-toggle="collapse" aria-expanded="false" >Transaksi Masuk</a>
                            <ul class="collapse list-unstyled" id="ts_masuk">
                                <li><a href="<?php echo base_url()?>index.php/kelurahan/transaksi_masuk">Pengepul</a></li>
                                <li><a href="<?php echo base_url()?>index.php/kelurahan/transaksi_masuk_bs">Bank Sampah</a></li>
                            </ul>
                            <a href="#ts_metu" data-toggle="collapse" aria-expanded="false">Transaksi Keluar</a>
                            <ul class="collapse list-unstyled" id="ts_metu">
                                <li><a href="<?php echo base_url()?>index.php/kelurahan/transaksi_keluar">Pengepul</a></li>
                                <li><a href="<?php echo base_url()?>index.php/kelurahan/transaksi_keluar_bs">Bank Sampah</a></li>
                            </ul>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>index.php/c_utama/logout"><span class="glyphicon glyphicon-log-out">&nbsp;</span>Keluar</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Menu</span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo base_url()?>index.php/c_utama/logout">Keluar &nbsp;<span class="glyphicon glyphicon-log-out"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
