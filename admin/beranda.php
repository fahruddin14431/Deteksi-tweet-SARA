<?php 

include_once 'helper.php';

$helper = new Helper();
$jumlah_kata_sara       = $helper->CountDataWidget("SELECT COUNT(id_kata_sara) FROM tb_kata_sara WHERE status = 'Y'");
$jumlah_tweet           = $helper->CountDataWidget("SELECT COUNT(id_tweet) FROM tb_tweet");
$jumlah_kata_tambahan   = $helper->CountDataWidget("SELECT COUNT(id_kata_sara) FROM tb_kata_sara WHERE status = 'N'");


 ?>

<div class="block-header">
    <h2>BERANDA</h2>
</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-red hover-expand-effect">
            <div class="icon">
                <i class="material-icons">format_list_bulleted</i>
            </div>
            <div class="content">
                <div class="text">KATA SARA</div>
                <div class="number count-to" data-from="0" data-to="<?= $jumlah_kata_sara; ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">comment</i>
            </div>
            <div class="content">
                <div class="text">TWEET</div>
                <div class="number count-to" data-from="0" data-to="<?= $jumlah_tweet; ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>                
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add</i>
            </div>
            <div class="content">
                <div class="text">KATA TAMBAHAN</div>
                <div class="number count-to" data-from="0" data-to="<?= $jumlah_kata_tambahan  ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">forum</i>
            </div>
            <div class="content">
                <div class="text">KOMENTAR</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->

<div class="row">
    <!-- Latest Social Trends -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-cyan">
                <div class="m-b--35 font-bold"><h4>HASTAG TWEET</h4></div>
                <ul class="dashboard-stat-list">
                    <li>
                        #pilkadadki2017
                        <span class="pull-right">
                            <i class="material-icons">trending_up</i>
                        </span>
                    </li>
                    <li>
                        #pilkadadki
                        <span class="pull-right">
                            <i class="material-icons">trending_up</i>
                        </span>
                    </li>                    
                    <li>#temanahok</li>
                    <li>#aniessandi</li>
                    <li>
                        #jakartamemilih
                        <span class="pull-right">
                            <i class="material-icons">trending_down</i>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #END# Latest Social Trends -->    
    <!-- Chart JS kata sara -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body">                
                <div class="m-b--35 font-bold"><h4>BOBOT KATA SARA</h4></div>
                <br>
                <canvas id="bar_chart" height="220px"></canvas>                            
            </div>
        </div>
    </div>
    <!-- #END# Chart JS kata sara -->
    <!-- Trial Tweet -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-light-green">
                <div class="m-b--35 font-bold"><h4>UJI COBA TWEET</h4></div>
                <ul class="dashboard-stat-list">
                    <li>
                        HARI INI
                        <span class="pull-right"><b><?php echo $jumlah_tweet; ?></b> Tweet</span>
                    </li>
                    <li>
                        KEMARIN
                        <span class="pull-right"><b>14</b> Tweet</span>
                    </li>
                    <li>
                        MINGGU LALU
                        <span class="pull-right"><b>72</b> Tweet</span>
                    </li>
                    <li>
                        BULAN LALU
                        <span class="pull-right"><b>138</b> Tweet</span>
                    </li>            
                    <li>
                        TOTAL UJI COBA
                        <span class="pull-right"><b><?php echo $jumlah_tweet+138; ?></b> Tweet</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #END# Trial Tweet -->      
</div>

 <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">     
                <h3 class="col-deep-orange">
                    <b>PETA DKI JAKARTA</b>
                </h3> 
            </div>                
            <div class="body">
                <!-- maps -->
                <div id="googleMap" style="width:100%;height:400px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- init map -->
<script>
function myMap() {
      // get id 
      var mapCanvas = document.getElementById("googleMap");

      // set LatLng (Malang)
      var myCenter = new google.maps.LatLng(-6.175459,106.826976); 

      // set zoom
      var mapOptions = {center: myCenter, zoom: 11};
      var map = new google.maps.Map(mapCanvas,mapOptions);
      var marker = new google.maps.Marker({
                    position: myCenter
                });
      
      // add marker
      marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1JuL6Rq5rIp65eOde2mBngeVlLr8lqEg&callback=myMap"></script>
<!-- end init map -->


<!-- init data for chart JS (kata sara) -->
<?php 

$get_kata_sara = $helper->getKataSara();
$kata_sara     = array_keys($get_kata_sara);
$kata_sara     = implode('" ,"', $kata_sara);

$nilai_kata_sara = implode(', ', $get_kata_sara);
 ?>
<!-- end init -->

<!-- Chart JS -->
<script src="../assets/plugins/chartjs/Chart.bundle.js"></script>
<script>
    var ctx = document.getElementById("bar_chart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?= '"'.$kata_sara.'"';  ?>],
            datasets: [{
                label:"Dataset",
                data: [<?= $nilai_kata_sara ?>],
                backgroundColor: [
                    'rgba(244, 67, 54, 1)',
                    'rgba(33, 150, 243, 1)',
                    'rgba(255, 152, 0, 1)',
                    'rgba(0, 150, 136, 1)',
                    'rgba(139, 195, 74, 1)'
                ],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>