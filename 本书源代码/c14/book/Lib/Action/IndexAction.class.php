<?php 
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action{
	public function index(){
		header("Content-Type:text/html; charset=utf-8");
		echo "<div style='font-weight:normal;color:blue;float:left;width:345px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;font-size:14px;font-family:Tahoma'>^_^ Hello,欢迎使用<span style='font-weight:bold;color:red'>ThinkPHP</span></div>";
	}
	//新添加的方法
	public function newAction(){
		header("Content-Type:text/html; charset=utf-8");
		echo "这是新添加的方法";
	}
	//读取数据库
	public function listbook(){
		//实例化模型
		$book = new bookModel();
		//使用findAll()方法，取得表中所有记
		$book->query('set charset latin1'); 
		$list = $book->findAll();
		//使用DUMP方法，显示返回的数组 
		dump($list); 
	}

} 
?>