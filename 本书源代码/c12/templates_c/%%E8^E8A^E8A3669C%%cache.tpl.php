<?php /* Smarty version 2.6.19, created on 2008-08-27 09:46:18
         compiled from cache.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cache.tpl', 9, false),array('block', 'dynamic', 'cache.tpl', 11, false),)), $this); ?>
<?php $this->_cache_serials['templates_c\%%E8^E8A^E8A3669C%%cache.tpl.inc'] = '69601ce553e58dd678bc9d96c788d671'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title><?php echo $this->_tpl_vars['title']; ?>
</title>
	</head>
	<body>
		页面创建时间：<?php echo ((is_array($_tmp='0')) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D %H:%M:%S") : smarty_modifier_date_format($_tmp, "%D %H:%M:%S")); ?>

		<?php if ($this->caching && !$this->_cache_including): echo '{nocache:69601ce553e58dd678bc9d96c788d671#0}'; endif;$this->_tag_stack[] = array('dynamic', array()); $_block_repeat=true;returnDynamic($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		当前时间：<?php echo ((is_array($_tmp='0')) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D %H:%M:%S") : smarty_modifier_date_format($_tmp, "%D %H:%M:%S")); ?>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo returnDynamic($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including): echo '{/nocache:69601ce553e58dd678bc9d96c788d671#0}'; endif;?>
	</body>
</html>