<?php 

include_once 'tf_idf.php';
include_once 'vsm.php';

// last id tweet
$crud   = new Crud();
$sql    = "SELECT * FROM tb_tweet ORDER BY id_tweet DESC LIMIT 1";
$result = $crud->fetchData($sql);

$id_tweet            = "";
$tweet               = "";
$after_preprocessing = "";
foreach ($result as $value) {
    $id_tweet            = $value['id_tweet'];
    $tweet               = $value['tweet'];
    $after_preprocessing = $value['after_preprocessing'];
}

// set array 
$kata_tweet = explode(" ", $after_preprocessing);
$kata_sara  = $crud->fetchKataSara();

// id tweet cek from tb detail
$sql1    = "SELECT * FROM tb_detail";
$result1 = $crud->fetchData($sql1);

$last_id_tweet = "";
foreach ($result1 as $value) {
    $last_id_tweet  = $value['id_tweet'];
}

$tf_idf = new Tf_idf();

// process cek tweet 
$ambil_tweet_sara = array();
if(!empty($id_tweet)){
    if ($id_tweet == $last_id_tweet) {
        $sql = "SELECT tb_kata_sara.kata_sara FROM tb_detail, tb_kata_sara
                WHERE tb_kata_sara.id_kata_sara = tb_detail.id_kata_sara
                AND tb_detail.id_tweet = ".$id_tweet;
        $result = $crud->fetchData($sql);
        foreach ($result as $value) {
            $ambil_tweet_sara [] = $value['kata_sara'];
        }
    }else{
        $ambil_tweet_sara = $tf_idf->checkTweet($kata_tweet,$kata_sara,$id_tweet);
    }
}

// remove kata sara where status N
$kata_tidak_sara = $crud->fetchKataTidakSara();
$cek_tweet = array_diff($ambil_tweet_sara, $kata_tidak_sara);

// proses menghitung D (semua tweet)
$count_d   = $tf_idf->getD();

// proses menghitung IDF
foreach ($kata_sara as $key => $value) {
    // proses menhitung df
    $count_df     = $tf_idf->getDf($key);
    $count_idf    = $tf_idf->getIDF($count_d, $count_df);
    $count_vsm_kk = pow($count_idf, 2);
    // update idf dan vsm_kk di table kata sara
    $array_update = array('IDF'=>$count_idf,'VSM_KK'=>$count_vsm_kk);
    $crud->updateDatas("tb_kata_sara", $array_update,"id_kata_sara = ".$key);   
}

// update vsm_kk  = 0 jika bukan kata sara (status N)
$kata_tidak_sara = $crud->fetchKataTidakSara();
foreach ($kata_tidak_sara as $key => $value) {
    $array_update1 = array('VSM_KK' => 0);
    $crud->updateDatas("tb_kata_sara",$array_update1,"id_kata_sara = ".$key);
}

// proses menghitung W
// proses update semua nilai bobot ketika ada penambahan tes tweet
$sql2   = "SELECT id_tweet FROM tb_tweet";
$result2 = $crud->fetchData($sql2);
foreach ($result2 as $value) {
    $id_tweet =  $value['id_tweet'];
    $updateBobot = $tf_idf->getW($id_tweet);

    $array_bobot = array("W"=>$updateBobot);
    $crud->updateDatas("tb_tweet", $array_bobot, "id_tweet = ".$id_tweet);

    // menghitung nilai VSM untuk tb tweet
    $vsm = new Vsm();
    $sqrt_kk = $vsm->SQRTKK();
    $sqrt_tweet = $vsm->SQRTTweet($id_tweet);
    $sum_kk_dot_tweet = $vsm->SUMKKdotDi($id_tweet);
    @$hasil_vsm = $sum_kk_dot_tweet / ($sqrt_kk * $sqrt_tweet);
    $array_update_vsm = array('VSM'=>$hasil_vsm);
    $crud->updateDatas("tb_tweet", $array_update_vsm, "id_tweet = ".$id_tweet);

}

// menampilkan bobot dari data terakhir (test saat ini)
$count_w = $tf_idf->getW($id_tweet);


 ?>
<!-- Blockquotes -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        <!-- cek bila tweet tidak ada -->
        <?php if (empty($result)) { ?>
            <div class="header">
                <h3 class="col-deep-orange">
                    <b>TIDAK ADA TWEET</b>
                </h3>                
            </div>     
            <div class="body">
                <a href="index.php?p=test_tweet" class="btn btn-lg btn-warning"><b>TEST TWEET</b></a>             
            </div>                                                              
        </div>     
        <?php }else{ ?>
            <div class="header">
                <h3 class="col-deep-orange">
                    <b>HASIL PROSES TWEET</b>
                </h3>                
            </div>            
            <div class="body <?php echo (empty($cek_tweet))?"bg-light-green":"bg-red"; ?>">      
                <blockquote>                    
                    <p><?php echo $tweet; ?></p>
                    <p class="font-15"><b>Preprocessing : </b><cite title="Source Title"><?php echo $after_preprocessing; ?></cite></p>
                    <p class="font-15"><b>Kata SARA : </b>
                        <cite title="Source Title">
                            <?php 
                            $tweet_kata_sara="";
                            if (count($cek_tweet)!=0) {                                
                                foreach ($cek_tweet as $value) {
                                    echo $value." ";
                                    $tweet_kata_sara .= $value." ";
                                }
                            }else {
                                echo "Tidak Ditemukan";
                                $tweet_kata_sara = "Tidak Ditemukan";
                            }
                            // update data kata sara di tb_twetter
                            $array_tweet_kata_sara = array('kata_SARA' => $tweet_kata_sara );
                            $crud->updateDatas("tb_tweet", $array_tweet_kata_sara, "id_tweet = ".$id_tweet);

                             ?>
                        </cite>
                    </p>
                    <p class="font-15"><b>Bobot(W) : </b><?php echo $count_w; ?></p>
                </blockquote>                
            </div>
            <div class="body">
                <a href="index.php?p=test_tweet" class="btn btn-warning btn-lg waves-effect"><b>TES LAGI</b></a>
            </div>            
        </div>
        <?php } ?>
        <!-- end  -->
    </div>
</div>
<!-- #END# Blockquotes -->

<!-- Data Tweet -->
<?php include_once 'Tweet/tampil_tweet.php'; ?>
<!-- #END# Data Tweet -->