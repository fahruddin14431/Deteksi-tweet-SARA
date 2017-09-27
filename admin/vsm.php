<?php 

include_once 'koneksi.php';

/**
* Vector Space Model
*/
class Vsm {
	
	private $koneksi;

	function __construct(){
		$this->koneksi = new Koneksi();
	}

	public function SQRTKK(){
		$sql = "SELECT SQRT(SUM(VSM_KK)) FROM tb_kata_sara";
        $result = $this->koneksi->setQuery($sql);
		$row	= $result->fetch_array();
		$data	= $row[0];
		return $data;
	}

	public function SQRTTweet($id_tweet){
		$sql = "SELECT SQRT(SUM(POW(sumIDF, 2)))
				FROM (SELECT SUM(tb_kata_sara.IDF) as sumIDF
				      FROM tb_detail, tb_kata_sara                      
				      WHERE tb_detail.id_kata_sara = tb_kata_sara.id_kata_sara
                      AND tb_detail.id_tweet = '$id_tweet'
				      GROUP BY tb_detail.id_kata_sara
				     ) x ";
		$result = $this->koneksi->setQuery($sql);
		$row	= $result->fetch_array();
		$data	= $row[0];
		return $data;
	}

	public function SUMKKdotDi($id_tweet){
		$sql = "SELECT SUM((tb_kata_sara.VSM_KK * tb_kata_sara.VSM_KK)) as total FROM tb_detail, tb_kata_sara
				WHERE tb_detail.id_kata_sara = tb_kata_sara.id_kata_sara
				AND tb_detail.id_tweet = '$id_tweet'";
		$result = $this->koneksi->setQuery($sql);
		$row	= $result->fetch_array();
		$data	= $row[0];
		return $data;
	}



}

 ?>