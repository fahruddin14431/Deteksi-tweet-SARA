<?php 

/**
* Term Frequency – Inverse Document Frequency (TF-IDF)
*/

include_once 'crud.php';

class Tf_idf {

	private $koneksi;
	private $crud;
	
	function __construct(){
		$this->koneksi = new Koneksi();
		$this->crud = new Crud();
	}

	// membandingan tweet dengan kata sara
	public function checkTweet($arrayTweet, $arrayCheck, $id_tweet){
		$hasil =array();
		foreach ($arrayTweet as $tweet) {
			if (in_array($tweet, $arrayCheck)) {
				foreach ($arrayCheck as $id_kata_sara => $value) {
					if ($tweet == $value) {

						$hasil [] = $tweet;

						// insert data ke tb_detail
						$array_insert_detail = array("id_tweet"=>$id_tweet,"id_kata_sara"=>$id_kata_sara);
						$this->crud->insertDatas("tb_detail",$array_insert_detail);					
					}
				}
			}
		}
		return $hasil;
	}

	// mencari total D (total semua data)
	public function getD(){
		$sql 	= "SELECT count(id_tweet) FROM tb_tweet";
		$result = $this->koneksi->setQuery($sql);
		$row	= $result->fetch_array();
		$data	= $row[0];
		return $data;
	}

	// mencari total df (banyak data yang mengandung kata yang dicari)
	public function getDf($id_kata_sara){
		$sql = "SELECT COUNT(*) FROM(
					SELECT id_kata_sara FROM tb_detail
				    WHERE id_kata_sara = '$id_kata_sara'
					GROUP BY id_tweet
				) AS temp";
		$result = $this->koneksi->setQuery($sql);
		$row	= $result->fetch_array();
		$data	= $row[0];
		return $data;
	}

	// mencari total IDF 
	public function getIDF($getD, $getDf){
		$params = @($getD / $getDf);		 
		$res = log10($params);
		if (is_infinite($res)) {
			$res=0;
		}
		return $res;
	}

	// mencari W (bobot) update value W ketika ada penambahan tweet
	public function getW($id_tweet){
		$sql = "SELECT SUM(tb_kata_sara.IDF) 
				FROM tb_detail, tb_kata_sara
				WHERE tb_kata_sara.id_kata_sara = tb_detail.id_kata_sara
				AND tb_kata_sara.status = 'Y'
				AND tb_detail.id_tweet = '$id_tweet'";
		$result = $this->koneksi->setQuery($sql);
		$row	= $result->fetch_array();
		$data	= $row[0];
		return $data;
	}

}

 ?>