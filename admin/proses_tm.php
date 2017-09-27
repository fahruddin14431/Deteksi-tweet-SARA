<?php 

include_once 'preprocessing.php';
include_once 'tf_idf.php';
include_once 'crud.php';
require_once __DIR__ . '/vendor/autoload.php';
 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Text Mining - SARA PILGUB 2K17</title>
	<link rel="stylesheet" href="">
</head>
<body>

	<h1>Text Mining - SARA PILGUB 2K17</h1>

	<h2>Presprocessing</h2>

	<?php 

	$crud 		= new Crud();
	$sql		= "SELECT * FROM tb_tweet";
	$result 	= $crud->fetchData($sql);

	$tf_idf = new Tf_idf();
	$preprocessing = new preprocessing();

	foreach ($result as $value) {

		$id_tweet	= $value['id_tweet'];
		$tweet  	= $value['tweet'];

		echo "Original Tweet = ". $tweet;
		$preprocessing->caseFolding($tweet);
		$preprocessing->tokenizing();
		$preprocessing->filtering();
		$preprocessing->stemming();
		echo "<br>";
		echo "Result 	= ";
		print_r($preprocessing->stemming());
		echo "<br>";

		// proses cek tweet dengan kata sara dan proses input
		$cek_tweet = $preprocessing->stemming();
		$kata_sara = $crud->fetchKataSara();
		foreach ($cek_tweet as $tweet) {
			if (in_array($tweet, $kata_sara)) {
				foreach ($kata_sara as $id_kata_sara => $value) {
					if ($tweet == $value) {
						$hasil =  "D".$id_tweet." ".$tweet." ".$id_kata_sara;
						var_dump($hasil);
						echo "<br>";

						// $crud->insertData($id_tweet, $id_kata_sara);
					}
				}
			}
		}
		echo "<br>";

		// update field tweet after preprocessing
		$crud->updateTweet($preprocessing->getAllResult(), $id_tweet);
		
		// print_r($tf_idf->countValArray($preprocessing->stemming()));
		echo "<br><br>";		
		
	}
	
	?>

	<h2>TF-IDF</h2>

	<?php 

	echo "D = ".$tf_idf->getD();
	echo "<br>";
	foreach ($crud->fetchKataSara() as $key => $value) {
		echo $value;
		echo "<br>";
	}

	 ?>
	
</body>
</html>