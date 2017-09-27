<?php 
include_once '../crud.php';

$crud = new Crud();

$kata_sara 		 = $_POST['kata_sara'];
$status 		 = $_POST['status'];
$array_kata_sara = array('kata_sara' => $kata_sara, 'status'=>$status);
$crud->insertDatas("tb_kata_sara",$array_kata_sara);


 ?>