<?php 
session_start();

if (empty($_SESSION['user'])) {
    header("location:../index.php");
}

include_once 'crud.php';

 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>UAS DSS Text Mining - SARA PILGUB DKI 2K17</title>
    <!-- Favicon-->
    <!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../assets/css/themes/all-themes.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Jquery Core Js -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>

</head>

<body class="theme-deep-orange">
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php"><b>ANALISIS TWEET SARA PILGUB DKI 2K17</b></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../assets/images/user_flat.png" width="96" height="96" alt="User" />
                </div>
                <div class="info-container pull-right" style="margin:-100px 13px 10px 0px">
                    <div class="name"><h4>Fahruddin Yusuf H</h4></div>
                    <div class="email">140403020020</div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU UTAMA</li>
                    <!-- list menu -->
                    <li>
                        <a href="index.php?p=beranda">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="index.php?p=kata_sara">Kata Sara</a>
                            </li>
                            <li>
                                <a href="index.php?p=tweet">Tweet</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php?p=test_tweet">
                            <i class="material-icons">play_circle_filled</i>
                            <span>Tes Tweet</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?p=hasil_tweet">
                            <i class="material-icons">assignment</i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li class="header">PENGATURAN</li>
                    <li>
                        <a href="index.php?p=keluar">
                            <i class="material-icons col-red">power_settings_new</i>
                            <span>Keluar</span>
                        </a>
                    </li>
                    <!-- #END# list menu -->
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="index.php">UAS DSS - TEXT MINING</a>.
                </div>
                <div class="version">
                    <!-- <b>Fahruddin Yusuf Habibi </b> 140403020020 -->
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <div>
                <p><b>DESKRIPSI</b></p>            
                <p>SISTEM ANALISIS TWEET SARA DENGAN METODE TF-IDF DAN VSM</p>
                <p>
                    Sistem Analisis Tweet SARA digunakan untuk mengetahui suatu
                    tweet apakah mengandung unsur SARA atau tidak dan dilakukan perangkingan
                    untuk semua tweet. Sistem Analisis Tweet SARA akan melakukan pembobotan
                    untuk semua tweet yang mengandung kata kunci yang sudah ditentukan dengan
                    metode <i>Term Frequency - Inverse Document Frequency</i> (TF-IDF) dan 
                    <i>Vector Space Model</i> VSM 
                </p>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">
            
        <?php 

        if (isset($_GET['p'])) {
            if ($_GET['p']=="beranda") {
                include 'beranda.php';
            }
            else if($_GET['p']=="kata_sara"){
                include 'Kata_sara/tampil_kata_sara.php';
            }
            else if($_GET['p']=="tweet"){
                include 'Tweet/tampil_tweet.php';
            }
            else if($_GET['p']=="hapus_tweet"){
                $crud = new Crud();
                $res  = $crud->deleteDatas("tb_tweet",null);
                if ($res) {
                    echo "<script> location.replace('index.php?p=hasil_tweet'); </script>";
                }else{
                    "gagal delete, saya di halaman index (hapus_tweet)";
                }
            }
            else if($_GET['p']=="hasil_tweet"){
                include 'Test_tweet/hasil_tweet.php';
            }
            else if($_GET['p']=="test_tweet"){
                include 'Test_tweet/test_tweet.php';
            }
            else if($_GET['p']=="keluar"){
                session_destroy();
                echo "<script> location.replace('../index.php'); </script>";
            }
            else{
                include '404.php';
            }
        }else{
            include 'beranda.php';
        }

         ?>

        </div>
    </section>
    <!-- #END# Content -->

    <!-- hanle last click li item -->
    <script type="text/javascript">
        $('li').each(function(){
            if(window.location.href.indexOf($(this).find('a:first').attr('href'))>-1){
                $(this).addClass('active').siblings().removeClass('active');
            }
        });
    </script>

    <!-- Bootstrap Core Js -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../assets/plugins/node-waves/waves.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Custom Js -->
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/pages/tables/jquery-datatable.js"></script>    
    <script src="../assets/js/pages/index.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>    
    
    <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

</body>

</html>