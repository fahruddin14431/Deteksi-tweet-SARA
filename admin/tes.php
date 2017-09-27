<?php 

$D = array(
		'D1' => 1, 
		'D2' => 2, 
		'D3' => 0 
		);

$nilai ="";
foreach ($D as $key => $value) {
	if ($value !=0) {
		$nilai++;
	}
}

echo "Nilai ".$nilai;

 ?>