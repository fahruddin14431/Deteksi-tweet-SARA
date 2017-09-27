<?php 

include_once '../crud.php';
include_once '../preprocessing.php';

if (isset($_POST['submit'])) {

	$koneksi = new Koneksi();
	$tweet 	= mysqli_escape_string($koneksi->getKoneksi(), trim($_POST['tweet']));

	// preprocessing
	$preprocessing = new Preprocessing();
	$preprocessing->caseFolding($tweet);
	$preprocessing->tokenizing();
	$preprocessing->filtering();
	$preprocessing->stemming();
	$after_preprocessing = $preprocessing->getAllResult();

	// proses insert tb tweet  
	$crud 	= new Crud();
	$array_tweet = array('tweet' => $tweet, 'after_preprocessing' => $after_preprocessing);
	$result = $crud->insertDatas("tb_tweet",$array_tweet);

	// jika ada kata tweet baru tambahkan 
	$kata_sara  = $crud->fetchKataSara();
	$kata_tweet = array_unique($preprocessing->stemming());
	$array_dif = array_diff($kata_tweet, $kata_sara);

	foreach ($array_dif as $kata_baru ) {
		$array_insert = array('kata_sara'=>$kata_baru,'status'=>'N');
		$crud->insertDatas("tb_kata_sara", $array_insert);
	}

	if ($result) {
		header("location:../index.php?p=hasil_tweet");
	}else{
		echo "gagal input di proses cek tweet";
	}

}


 ?>