<?php
//定义一个以csv命名的类
class csv{
	//定义CSV文件名称
	var $_name = "";
	//定义分割符，默认为逗号
	var $_split  = ",";
	//定义临时存储select数据的数组
	var $_select = array();
	//构造函数，用于初始化类
	function csv($name="",$split=","){
		if($name==""){
			$this->_name  = time();
		}else{
			$this->_name  = $name;
		}
		$this->_split = $split;
	}
	//用于重新设置初始化变量，防止操作同一个文件
	function set($name="",$split=","){
		if($name==""){
			$this->_name  = time();
		}else{
			$this->_name  = $name;
		}
		$this->_split = $split;
	}
	//使用表格方式，预览select()函数的数据
	function preview(){
		$table = "<table border='2'>";
		$row = 0;
		foreach($this->_select as $k=>$v){
			$table .= "<tr>";
				foreach($v as $tk=>$tv){
					$table .= "<td>$tv</td>";
				}
			$table .= "</tr>";
			$row++;
		}
		$table .= "</table>";
		return $table;
	}
	//根据用户提交的数据，生成一个csv格式的文件
	function create($data){
		if(is_array($data)){
			//使用类中的connect()函数，取得文件句柄
			$this->connect($this->_name,"wb");
			foreach($data as $line){
				//使用fputcsv()函数，把用户提交的数据写入文件
				fputcsv($this->_fp,$line,$this->_split);
			}
			//使用类中的close()函数，关闭文件句柄
			$this->close();
			return true;
		}else{
			return false;
		}
	}
	//插入记录到CSV文件
	function insert($row){
		$this->connect($this->_name,"ab");
		fputcsv($this->_fp,$row,$this->_split);
		$this->close();
	}
	//根据指定的值，删除CSV文件中的某一行
	function delete($id){
		$this->connect($this->_name,"rb");
		$row = 0;
		$newData = array();
		while($data = fgetcsv($this->_fp,strlen($this->getRow($row)),$this->_split)){
			if($id-1!=$row){
				$newData[] = $data;
			}
			$row++;
		}
		$this->close();
		$this->create($newData);
		return true;
	}
	//查找某一字段的值，与指定值是否相等
	function select($f,$c){
		$this->connect($this->_name,"rb");
		$row = 0;
		while($data = fgetcsv($this->_fp,strlen($this->getRow($row)),$this->_split)){
			foreach($data as $dk=>$dv){
				if($dk==$f and $dv==$c){
					$this->_select[] = $data;
				}
			}
			$row++;
		}
		$this->close();
		return true;
	}
	//取得CSV文件某一行的数据
	function getRow($id){
		$rows = file($this->_name);
		return $rows[$id];
	}
	//取得CSV文件某一行的数据，并以数组形式返回
	function getRowArray($id){
		$rows = file($this->_name);
		return explode($this->_split,$rows[$id]);
	}
	//取得CSV文件的记录数
	function rows(){
		$file = file($this->_name);
		$rows = count($file);
		return $rows;
	}
	/**
	 * 以表格的形式，显示CSV文件的数据
	 * $header(true/false):是否显示表头
	 * $lineNumber(true/false):是否显示行数
	 * */
	function showTable($header = true,$lineNumber=true){
		$this->connect($this->_name,"rb");
		$table = "<table border='2'>";
		$row = 0;
		while($data = fgetcsv($this->_fp,strlen($this->getRow($row)),$this->_split)){
			$table .= "<tr>";
			if($header == true and $row==0){
				if($lineNumber==true){
					$table .= "<th>编号</th>";
				}
				foreach($data as $tk=>$tv){
					$table .= "<th>$tv</th>";
				}
			}else{
				if($lineNumber==true){
					$table .= "<td>".$row."</td>";
				}
				foreach($data as $tk=>$tv){
					$table .= "<td>$tv</td>";
				}
			}
			$table .= "</tr>";
			$row++;
		}
		$table .= "</table>";
		$this->close();
		return $table;
	}
	//根据参数，返回一个文件句柄供类中的其他函数使用
	function connect($file,$mode){
		if($file==""){
			return false;
		}else{
			if($this->_fp = fopen($file,$mode)){
				return true;
			}else{
				return false;
			}
		}
	}
	//关闭文件句柄
	function close(){
		fclose($this->_fp);
	}
}
?>