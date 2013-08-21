<?php 
class bookAction extends Action{
	//默认方法
	public function index() {
		//使用D()函数，调用bookView模型
		$book = D("bookView");
		//向数据库发送字符设置语句
		$book->query('set charset latin1');
		//获取数据库中的记录
		$list	=	$book->findAll();
		//设置模板标记
		$this->assign("title","留言板");
		$this->assign("list",$list);
		//显示模板
		$this->display();
	}
	//添加留言的方法
	public function add() {
		$this->assign("title","留言板");
		$this->display();
	}
	//保存留言内容
	public function save() {
		$book = new bookModel();
		$book->query('set charset latin1');
		$book->name = strval($_POST["name"]);
		$book->sex = strval($_POST["sex"]);
		$book->IP = $this->getip();
		$book->email = strval($_POST["email"]);
		$book->http = strval($_POST["http"]);
		$book->detail = strval($_POST["detail"]);
		$book->add();
		$this->assign("stats","留言保存成功");
		$this->display();

	}
	//获取IP地址的方法
	public static function getip() {   
        if ($_SERVER['HTTP_CLIENT_IP'] && $_SERVER['HTTP_CLIENT_IP']!='unknown') {   
            $ip = $_SERVER['HTTP_CLIENT_IP'];   
        } elseif ($_SERVER['HTTP_X_FORWARDED_FOR'] && $_SERVER['HTTP_X_FORWARDED_FOR']!='unknown') {   
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];   
        } else {   
            $ip = $_SERVER['REMOTE_ADDR'];   
        }   
        return $ip;   
    }  
}
?>
