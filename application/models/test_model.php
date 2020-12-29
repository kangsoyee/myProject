<?php
class Test_model extends CI_Model {
	private $table_list;

	function __construct(){
		parent::__construct();
		$this->table_list = array();
	}

	public function getString(){
		$this->table_list = array();

		$db_file = fopen("./database.txt", 'r') or die("can't open file");
		if($db_file){
			while(!feof($db_file)) {
				$raw_data = fgets($db_file);
				$table_row_object = explode("/", $raw_data);
				array_push($this->table_list, $table_row_object);
			}
		}
		fclose($db_file);
//		print_r($this->table_list);
//		exit;
		return $this->table_list;
	}

	public function putString($list, $number){
		$db_file = fopen("./database.txt", 'r') or die("can't open file");
		$count = 1;
		while(!feof($db_file)){
			if(fgets($db_file)){
				$count++;
			}
		}
		array_splice($list, 0, 1, $count);
		fclose($db_file);

		if($number != null){
			$db_file = fopen("./database.txt", 'r') or die("can't open file");
			if($db_file){
				while(!feof($db_file)) {
					$raw_data = fgets($db_file);
					array_push($this->table_list, $raw_data);
				}
			}
			fclose($db_file);
			$list_string = implode("/", $list);
			array_splice($this->table_list, $number-1, 0, $list_string."\n");

			$db_file = fopen("./database.txt", 'w') or die("can't open file");
			fwrite($db_file, implode("", $this->table_list));
			fclose($db_file);
		}else {
			$db_file = fopen("./database.txt", 'a') or die("can't open file");
			fwrite($db_file,implode("/", $list)."\n");
			fclose($db_file);
		}
	}

	public function deleteString($number){
		$db_file = fopen("./database.txt", 'r') or die("can't open file");
		if($db_file){
			while(!feof($db_file)) {
				$raw_data = fgets($db_file);
				array_push($this->table_list, $raw_data);
			}
		}
		fclose($db_file);
		array_splice($this->table_list, $number-1, 1);

		$db_file = fopen("./database.txt", 'w') or die("can't open file");
		fwrite($db_file, implode("", $this->table_list));
		fclose($db_file);
	}

	public function editString($number, $text){
		$db_file = fopen("./database.txt", 'r') or die("can't open file");
		if($db_file){
			while(!feof($db_file)) {
				$raw_data = fgets($db_file);
				array_push($this->table_list, $raw_data);
			}
		}
		fclose($db_file);

		$list = explode("/", $this->table_list[$number-1]); //수정할 행 저장
		array_splice($list, 1, 1, $text); // 내용 수정
		array_splice($this->table_list, $number-1, 1, implode("/", $list));

		$db_file = fopen("./database.txt", 'w') or die("can't open file");
		fwrite($db_file, implode("", $this->table_list));
		fclose($db_file);
	}

	public function sortString($up_down){
		$this->table_list = array();
		$count = 0;
		$db_file = fopen("./database.txt", 'r') or die("can't open file");
		if($db_file){
			while(!feof($db_file)) {
				$raw_data = fgets($db_file);
				$table_row_object = explode("/", $raw_data);
				array_push($this->table_list, $table_row_object);
			}
		}
		fclose($db_file);

		foreach ($this->table_list as $key => $row){
			$aaa[$key] = $row[0];
		}
		echo $up_down;
		if($up_down==1) array_multisort($aaa, SORT_ASC, $this->table_list);
		else array_multisort($aaa, SORT_DESC, $this->table_list);
		//reset($this->table_list);
		$db_file = fopen("./database.txt", 'w') or die("can't open file");
		$list = array();
		for($i = 0; $i < count($this->table_list); $i++){
			array_push($list, implode('/', $this->table_list[$i]));
		}
		fwrite($db_file, implode("", $list));
		fclose($db_file);
	}

	public function searchString(){

	}

}
?>
