<?php
/*******************14_1.php*************************/
class UserController extends Zend_Controller_Action{
    function userAction()  {
        $this->view->title = "标题设置";
    }
	function addAction() {
	    $this->view->title = "添加记录";
		if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
	        Zend_Loader::loadClass('Zend_Filter_StripTags');
	        //使用过滤器
	        $filter = new Zend_Filter_StripTags();
	        //过滤表单提交的数据
	        $artist = $filter->filter($this->_request->getPost('artist'));
	        $artist = trim($artist);
	        $title = trim($filter->filter($this->_request->getPost('title')));
			//判读提交数据是否为空
	        if ($artist != '' && $title != '') {
		        $data = array(
		         'artist' => $artist,
		         'title'  => $title,
		    	);
	    		$item = new item();
	    		$item->insert($data);
	            $this->_redirect('/');
	            return;
	        }
	    }
	    $this->view->item = new stdClass();
	    $this->view->item->id = null;
	    $this->view->item->artist = '';
	    $this->view->item->title = '';
	    //向表单中添加表单元素
	    $this->view->action = 'add';
	    $this->view->buttonText = '添加';
	}
	//存放编辑代码的函数
    function editAction()  {
        $this->view->title = "编辑";
    }
    //存放删除代码的函数
    function deleteAction() {
        $this->view->title = "删除";
    }
}
?>
