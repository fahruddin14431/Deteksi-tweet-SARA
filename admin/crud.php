<?php 

include_once 'koneksi.php';

/**
* crud
*/
class Crud {

	public $Koneksi;
	
	function __construct(){
		$this->koneksi = new Koneksi();
	}

	public function fetchData($sql){
		$result = $this->koneksi->setQuery($sql);
		return $result->fetch_all(MYSQLI_BOTH);
	}

	public function fetchKataSara(){
		$sql 	= "SELECT * FROM tb_kata_sara";
		$result = $this->koneksi->setQuery($sql);
		$kata_sara = array();
		foreach ($result as $value) {
			$kata_sara[$value['id_kata_sara']] = $value['kata_sara'];
		}
		return $kata_sara;
	}

	public function fetchKataTidakSara(){
		$sql 	= "SELECT * FROM tb_kata_sara WHERE status='N'";
		$result = $this->koneksi->setQuery($sql);
		$kata_sara = array();
		foreach ($result as $value) {
			$kata_sara[$value['id_kata_sara']] = $value['kata_sara'];
		}
		return $kata_sara;
	}

	public function insertDatas($table, $params){
		$sql  	= "INSERT INTO $table ";
		$field 	= "";
		$row 	= "";
		foreach ($params as $key => $value) {
			$field  .= ",".$key;
			$row	.= ",'".$value."'";
		}
		$sql	.= "(".substr($field, 1).")";
		$sql	.= " VALUES(".substr($row, 1).")";
		$result  = $this->koneksi->setQuery($sql);
		return $result;
	}

	public function updateDatas($table, $params, $id){
		$sql = "UPDATE $table SET ";
		$set="";
		foreach ($params as $key => $value) {
			$set .= ",".$key."='".$value."'";
		}
		$sql .= substr($set, 1)." WHERE $id";
		$res = $this->koneksi->setQuery($sql);
		return $sql;
	}

	public function deleteDatas($table, $id){
		$sql = "DELETE FROM $table";
		if (!empty($id)) {
			$sql .= " WHERE $id";
		}		
		$res =$this->koneksi->setQuery($sql);
		return $res;
	}

}

 ?>