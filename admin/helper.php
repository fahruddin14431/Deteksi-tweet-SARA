<?php 

include_once 'crud.php';

/**
* helper
*/
class Helper {

    private $crud;
	
	function __construct()	{
		$this->crud = new Crud();
	}

	public function CountDataWidget($sql){       
        $result = $this->crud->fetchData($sql);
        $jumlah ="";    
            foreach ($result as $value) {
                $jumlah =  $value[0];
            }   
        return $jumlah;
    }

    public function getKataSara(){
        $sql = "SELECT kata_sara, IDF FROM tb_kata_sara WHERE status = 'Y'";
        $result = $this->crud->fetchData($sql);
        $kata_sara = array();
        foreach ($result as $value) {
            $kata_sara[$value['kata_sara']] = $value['IDF'];
        }
        return $kata_sara;
    }
}

 ?>