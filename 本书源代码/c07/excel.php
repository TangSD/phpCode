<?php
class excel {
	var $_name = "";
	function excel($name) {
		$this->_name = $name;
	}
	function create($data, $title = "") {
		header("Pragma: public");
		header("Pragma: no-cache");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type:application/xls");
		header("Content-Disposition:attachment;filename=" . $this->_name);
		if ($title != "") {
			echo str_replace(",", "\t", $title) . "\n";
		}
		foreach ($data as $k => $v) {
			foreach ($v as $lk => $lv) {
				echo $lv . "\t";
			}
			echo "\n";
		}
	}
	function read($sheet, $rows = 0, $cols = 10) {
		$break = "";
		$workbook = dirname($_SERVER["SCRIPT_FILENAME"]) . "/" . $this->_name;
		$app = new COM("Excel.application") or die("Did not connect");
		$book = $app->Application->Workbooks->Open($workbook);
		$sheets = $book->Worksheets($sheet);
		$sheets->Activate;
		$sheet_data = array ();
		if ($rows == 0) {
			$row_num = $sheets->Rows->Count();
		} else {
			$row_num = $rows;
		}
		for ($row = 1; $row <= $row_num; $row++) {
			$row_data = array ();
			for ($col = 1; $col <= $cols; $col++) {
				$row_data[] = $sheets->Cells($row, $col)->Value;
				$break .= $sheets->Cells($row, $col)->Value;
			}
			if(strlen(trim($break))<1){
				break;
			}
			$sheet_data[] = $row_data;
			unset ($row_data);
		}
		unset ($book, $sheets, $app);
		return $sheet_data;
	}
}
?>