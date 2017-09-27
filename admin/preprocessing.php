<?php 

/**
* Preprocessing class 
*/

// include composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// interface
require_once 'interface_preprocessing.php';

class Preprocessing implements interface_preprocessing {

	private $kalimat;

// merubah kalimat menjadi huruf kecil dan menghilangkan karakter selain huruf
	public function caseFolding($kalimat){
		$this->kalimat = $kalimat;
   		$params = strtolower($this->kalimat);
   		return preg_replace('/[^a-z0-9\  ]/', '', $params);
	}

// merubah kalimat menjadi kata
	public function tokenizing(){
		return explode(" ", $this->caseFolding($this->kalimat));
	}

// tahap pengambilan kata penting
	public function filtering(){
		// cukup dijalankan sekali saja, biasanya didaftarkan di service container
		$stopWordRemoverFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
		$stopWord  = $stopWordRemoverFactory->getStopWords();
		return array_diff($this->tokenizing(), $stopWord);
	}

// tahap mencari root kata (kata asli)
	public function stemming(){
		// cukup dijalankan sekali saja, biasanya didaftarkan di service container
		$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
		$stemmer  = $stemmerFactory->createStemmer();

		$params = implode(" ", $this->filtering());
		$params = $stemmer->stem($params);
		return explode(" ", $params);
	}

// hasil preprocessing
	public function getAllResult(){
		return implode(" ", $this->stemming());
	}

}

 ?>