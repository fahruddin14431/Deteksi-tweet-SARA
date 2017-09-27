<?php 

interface interface_preprocessing{

	public function caseFolding($params);

	public function tokenizing();

	public function filtering();

	public function stemming();
}

 ?>