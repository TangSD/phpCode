<?php 
class bookViewModel extends Model 
{
	protected $viewModel = true;
	//设置与模型相关联的数据表
	protected $masterModel = 'book';
	//设置要获取数据表的字段
	protected $viewFields = array('book'=>array('id','name','sex','IP','email','http','detail'));
}
?>
