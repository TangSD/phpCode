<?php /* Smarty version 2.6.19, created on 2008-08-27 09:46:18
         compiled from cache.tpl */

$this->_cache_serials['templates_c\%%E8^E8A^E8A3669C%%cache.tpl.inc'] = '69601ce553e58dd678bc9d96c788d671';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cache.tpl', 9, false),array('block', 'dynamic', 'cache.tpl', 11, false),)), $this); ?>
<?php
function _smarty_tplfunc_69601ce553e58dd678bc9d96c788d671_0(&$_smarty)
{
$_smarty->_tag_stack[] = array('dynamic', array()); $_block_repeat=true;returnDynamic($_smarty->_tag_stack[count($_smarty->_tag_stack)-1][1], null, $_smarty, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		当前时间：<?php echo ((is_array($_tmp='0')) ? $_smarty->_run_mod_handler('date_format', true, $_tmp, "%D %H:%M:%S") : smarty_modifier_date_format($_tmp, "%D %H:%M:%S")); ?>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo returnDynamic($_smarty->_tag_stack[count($_smarty->_tag_stack)-1][1], $_block_content, $_smarty, $_block_repeat); }  array_pop($_smarty->_tag_stack); 
}



?>
