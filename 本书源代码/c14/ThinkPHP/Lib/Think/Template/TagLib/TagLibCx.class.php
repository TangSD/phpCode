<?php 
// +----------------------------------------------------------------------
// | ThinkPHP                                                             
// +----------------------------------------------------------------------
// | Copyright (c) 2008 http://thinkphp.cn All rights reserved.      
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>                                  
// +----------------------------------------------------------------------
// $Id$

import('Think.Template.TagLib');

/**
 +------------------------------------------------------------------------------
 * CX标签库解析类
 +------------------------------------------------------------------------------
 * @category   Think
 * @package  Think
 * @subpackage  Template
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id$
 +------------------------------------------------------------------------------
 */
class TagLibCx extends TagLib
{//类定义开始

    /**
     +----------------------------------------------------------
     * include标签解析
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function _include($attr) 
    {
        $tag    = $this->parseXmlAttr($attr,'include');
        $file   =   $tag['file'];
        if(is_file($file)) {
            $parseStr = file_get_contents($file);
            return $this->tpl->parse($parseStr);
        }else {
            return $this->tpl->parseInclude($file);
        }
    }

    /**
     +----------------------------------------------------------
     * comment标签解析
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function _comment($attr) 
    {
        return '';
    }

    /**
     +----------------------------------------------------------
     * php标签解析
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
	public function _php($attr,$content) {
		$parseStr = '<?php '.$content.' ?>';
		return $parseStr;
	}

    /**
     +----------------------------------------------------------
     * iterator标签解析 循环输出iterator变量的值
     * 格式： 
     * <iterate name="userList" id="user" empty="" >
     * {user.username}
     * {user.email}
     * </iterate>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _iterate($attr,$content) 
    {
        static $_iterateParseCache = array();
        //如果已经解析过，则直接返回变量值
        $cacheIterateId = md5($attr.$content);
        if(isset($_iterateParseCache[$cacheIterateId])) 
            return $_iterateParseCache[$cacheIterateId];

        $tag        = $this->parseXmlAttr($attr,'iterate');
        $name       = $tag['name'];
        $id         = $tag['id'];
        $empty      = isset($tag['empty'])?$tag['empty']:'';
        $offset     = isset($tag['offset'])?$tag['offset']:0;
        $length     = isset($tag['length'])?$tag['length']:'';
		$key			=	!empty($tag['key'])?$tag['key']:'i';
		$mod			=	isset($tag['mod'])?$tag['mod']:'2';
		$name = $this->autoBuildVar($name);
		$parseStr  =  '<?php if(isset('.$name.')): ?>';
		$parseStr	.= '<?php $'.$key.' = 0; ?>';
		if(!empty($offset)) {
			$parseStr  .= '<?php '.$name.'= array_slice('.$name.','.$offset.','.$length.') ?>';
		}
		$parseStr .= '<?php if( count('.$name.')==0 ) echo "'.$empty.'" ?>';
		$parseStr .= '<?php foreach('.$name.' as $key=>$'.$id.'): ?>';
		$parseStr .= '<?php ++$'.$key.';?>';
		$parseStr .= '<?php $mod = (($'.$key.' % '.$mod.' )==0)?>';
		$parseStr .= $this->tpl->parse($content);
		$parseStr .= '<?php endforeach; ?>';
		$parseStr .=  '<?php endif; ?>';
		$_iterateParseCache[$cacheIterateId] = $parseStr;
        
        if(!empty($parseStr)) {
            return $parseStr;
        }
        return ;
    }

	public function _volist($attr,$content) {
		return $this->_iterate($attr,$content);
	}

	public function _resultset($attr,$content) {
		return $this->_iterate($attr,$content);
	}

	public function _sublist($attr,$content) {
		return $this->_iterate($attr,$content);
	}

    public function _foreach($attr,$content) 
    {
        static $_iterateParseCache = array();
        //如果已经解析过，则直接返回变量值
        $cacheIterateId = md5($attr.$content);
        if(isset($_iterateParseCache[$cacheIterateId])) 
            return $_iterateParseCache[$cacheIterateId];

        $tag        = $this->parseXmlAttr($attr,'foreach');
        $name       = $tag['name'];
        $item         = $tag['item'];
		$key			=	!empty($tag['key'])?$tag['key']:'key';
		$name = $this->autoBuildVar($name);
		$parseStr  =  '<?php if(isset('.$name.')): ?>';
		$parseStr .= '<?php foreach('.$name.' as $'.$key.'=>$'.$item.'): ?>';
		$parseStr .= $this->tpl->parse($content);
		$parseStr .= '<?php endforeach; ?>';
		$parseStr .=  '<?php endif; ?>';
		$_iterateParseCache[$cacheIterateId] = $parseStr;
        
        if(!empty($parseStr)) {
            return $parseStr;
        }
        return ;
    }

    public function _subeach($attr,$content) 
    {
    	return $this->_foreach($attr,$content);
    }

	public function _url($attr) {
        $tag        = $this->parseXmlAttr($attr,'url');		
		$action	 =	 $tag['action'];
		$module	=	$tag['module'];
		$parseStr	=	'<?php echo url('.$action.','.$module.');?>';
		return $parseStr;
	}

	public function _var($attr) {
		$tag	=	$this->parseXmlAttr($attr,'var');
		$name       = $tag['name'];
		$varArray = explode('|',$name);
		$name	=	array_shift($varArray);
		$name = $this->autoBuildVar($name);
		if(count($varArray)>0) 
			$name = $this->tpl->parseVarFunction($name,$varArray);
		$parseStr	=	'<?php echo ('.$name.');?>';
		return $parseStr;
	}

    public function _defined($attr,$content) 
    {
        $tag        = $this->parseXmlAttr($attr,'defined');
        $name       = $tag['name'];
        $parseStr = '<?php if(defined("'.$name.'")): ?>';
        $parseStr .= $content.'<?php endif; ?>';

        return $parseStr;  	
    }

    /**
     +----------------------------------------------------------
     * if标签解析 
     * 格式： 
     * <if condition=" $a eq 1" >
     * <elseif condition="$a eq 2" />
     * <else />
     * </if>
	 * 表达式支持 eq neq gt egt lt elt == > >= < <= or and || &&
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	public function _if($attr,$content) {
		$tag = $this->parseXmlAttr($attr,'if');
		$condition = $this->parseCondition($tag['condition']); 
        $parseStr .= '<?php if('.$condition.'): ?>'.$content.'<?php endif; ?>';
        return $parseStr;
	}

    /**
     +----------------------------------------------------------
     * else标签解析 
     * 格式：见if标签
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	public function _elseif($attr,$content) {
		$tag = $this->parseXmlAttr($attr,'elseif');
		$condition = $this->parseCondition($tag['condition']); 
        $parseStr .= '<?php elseif('.$condition.'): ?>';
        return $parseStr;
	}

    /**
     +----------------------------------------------------------
     * else标签解析 
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	public function _else($attr) {
        $parseStr = '<?php else: ?>';
        return $parseStr;
	}

    /**
     +----------------------------------------------------------
     * switch标签解析 
     * 格式： 
     * <switch name="$a.name" >
     * <case value="1" break="false">1</case>
     * <case value="2" >2</case>
     * <default />other
     * </switch>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	public function _switch($attr,$content) {
		$tag = $this->parseXmlAttr($attr,'switch');
		$name = $tag['name']; 
		$varArray = explode('|',$name);
		$name	=	array_shift($varArray);
		$name = $this->autoBuildVar($name);
		if(count($varArray)>0) 
			$name = $this->tpl->parseVarFunction($name,$varArray);
        $parseStr = '<?php switch('.$name.'): ?>'.$content.'<?php endswitch;?>';
        return $parseStr;
	}

    /**
     +----------------------------------------------------------
     * case标签解析 需要配合switch才有效
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	public function _case($attr,$content) {
		$tag = $this->parseXmlAttr($attr,'case');
		$value = $tag['value']; 
		$varArray = explode('|',$value);
		$value	=	array_shift($varArray);
        if('$' == substr($value,0,1)) {
			$value  =  $this->autoBuildVar(substr($value,1));
			if(count($varArray)>0) 
				$value = $this->tpl->parseVarFunction($value,$varArray);
        }else{
			$value	=	'"'.$value.'"';
		}
		$break = empty($tag['break'])?true:$tag['break'];
        $parseStr = '<?php case '.$value.' : ?>'.$content;
		if($break) {
			$parseStr .= '<?php break;?>';
		}
        return $parseStr;
	}

    /**
     +----------------------------------------------------------
     * default标签解析 需要配合switch才有效
	 * 使用： <default />ddfdf
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	public function _default($attr) {
        $parseStr = '<?php default: ?>';
        return $parseStr;
	}

    /**
     +----------------------------------------------------------
     * compare标签解析 
     * 用于值的比较 支持 eq neq gt lt egt elt heq nheq 默认是eq
     * 格式： <compare name="" type="eq" value="" >content</compare>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _compare($attr,$content,$type='eq') 
    {
        $tag        = $this->parseXmlAttr($attr,'compare');
        $name       = $tag['name'];
        $value      = $tag['value'];
		$type	 =	 $tag['type']?$tag['type']:$type;
		$type	 =	 $this->parseCondition(' '.$type.' ');
		$varArray = explode('|',$name);
		$name	=	array_shift($varArray);
		$name = $this->autoBuildVar($name);
		if(count($varArray)>0) 
			$name = $this->tpl->parseVarFunction($name,$varArray);
        if('$' == substr($value,0,1)) {
			$value  =  $this->autoBuildVar(substr($value,1));
        }else {
			$value	=	'"'.$value.'"';
        }
        $parseStr = '<?php if(('.$name.') '.$type.' '.$value.'): ?>'.$content.'<?php endif; ?>';
        return $parseStr;
    }

	public function _eq($attr,$content) {
		return $this->_compare($attr,$content,'eq');
	}

	public function _equal($attr,$content) {
		return $this->_eq($attr,$content);
	}

	public function _neq($attr,$content) {
		return $this->_compare($attr,$content,'neq');
	}

	public function _notequal($attr,$content) {
		return $this->_neq($attr,$content);
	}

	public function _gt($attr,$content) {
		return $this->_compare($attr,$content,'gt');
	}

	public function _lt($attr,$content) {
		return $this->_compare($attr,$content,'lt');
	}

	public function _egt($attr,$content) {
		return $this->__compare($attr,$content,'egt');
	}

	public function _elt($attr,$content) {
		return $this->_compare($attr,$content,'elt');
	}

	public function _heq($attr,$content) {
		return $this->_compare($attr,$content,'heq');
	}

	public function _nheq($attr,$content) {
		return $this->_compare($attr,$content,'nheq');
	}

    /**
     +----------------------------------------------------------
     * present标签解析 
     * 如果某个变量已经设置 则输出内容
     * 格式： <present name="" >content</present>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _present($attr,$content) 
    {
        $tag  = $this->parseXmlAttr($attr,'present');
        $name  = $tag['name'];
		$name = $this->autoBuildVar($name);
        $parseStr  = '<?php if(isset('.$name.')): ?>'.$content.'<?php endif; ?>';
        return $parseStr;
    }

    /**
     +----------------------------------------------------------
     * notpresent标签解析 
     * 如果某个变量没有设置，则输出内容
     * 格式： <notpresent name="" >content</notpresent>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _notpresent($attr,$content) 
    {
        $tag  = $this->parseXmlAttr($attr,'notpresent');
        $name  = $tag['name'];
		$name = $this->autoBuildVar($name);
        $parseStr  = '<?php if(!isset('.$name.')): ?>'.$content.'<?php endif; ?>';
        return $parseStr;
    }

    /**
     +----------------------------------------------------------
     * session标签解析 
     * 如果某个session变量已经设置 则输出内容
     * 格式： <session name="" >content</session>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _session($attr,$content) 
    {
        $tag  = $this->parseXmlAttr($attr,'session');
        $name  = $tag['name'];
		if(strpos($name,'|')) {
			$array	=	explode('|',$name);
			$parseStr  = '<?php if( ';
			for($i=0; $i<count($array); $i++) {
				$parseStr  .= 'isset($_SESSION["'.$array[$i].'"]) || ';
			}
			$parseStr	=	substr($parseStr,0,-3);
			$parseStr  .='): ?>'.$content.'<?php endif; ?>';		
		}elseif(strpos($name,',')) {
			$array	=	explode(',',$name);
			$parseStr  = '<?php if( ';
			for($i=0; $i<count($array); $i++) {
				$parseStr  .= 'isset($_SESSION["'.$array[$i].'"]) && ';
			}
			$parseStr	=	substr($parseStr,0,-3);
			$parseStr  .='): ?>'.$content.'<?php endif; ?>';				
		}else {
			$parseStr  = '<?php if(isset($_SESSION["'.$name.'"])): ?>'.$content.'<?php endif; ?>';			
		}
        return $parseStr;
    }

    /**
     +----------------------------------------------------------
     * notsession标签解析 
     * 如果某个session变量没有设置 则输出内容
     * 格式： <notsession name="" >content</notsession>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _nosession($attr,$content) 
    {
        $tag  = $this->parseXmlAttr($attr,'nosession');
        $name  = $tag['name'];
		if(strpos($name,'|')) {
			$array	=	explode('|',$name);
			$parseStr  = '<?php if( ';
			for($i=0; $i<count($array); $i++) {
				$parseStr  .= '!isset($_SESSION["'.$array[$i].'"]) || ';
			}
			$parseStr	=	substr($parseStr,0,-3);
			$parseStr  .='): ?>'.$content.'<?php endif; ?>';		
		}elseif(strpos($name,',')) {
			$array	=	explode(',',$name);
			$parseStr  = '<?php if( ';
			for($i=0; $i<count($array); $i++) {
				$parseStr  .= '!isset($_SESSION["'.$array[$i].'"]) && ';
			}
			$parseStr	=	substr($parseStr,0,-3);
			$parseStr  .='): ?>'.$content.'<?php endif; ?>';				
		}else {
			$parseStr  = '<?php if( !isset($_SESSION["'.$name.'"])): ?>'.$content.'<?php endif; ?>';			
		}
		
        return $parseStr;
    }

    /**
     +----------------------------------------------------------
     * access标签解析 
     * 如果有模块和操作权限则输出，默认为当前模块和操作
     * 格式： <access module="" action="" >content</access>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _access($attr,$content) 
    {
        $tag		= $this->parseXmlAttr($attr,'access');
        $module		= $tag['module']?$tag['module']:MODULE_NAME;
		$action		= $tag['action']?$tag['action']:ACTION_NAME;
        $parseStr = '<?php $accessList = Session::get("_ACCESS_LIST"); if(Session::is_setLocal("administrator") || isset($accessList[strtoupper(APP_NAME)][strtoupper("'.$module.'")][strtoupper("'.$action.'")])) : ?>'.$content.'<?php endif; ?>';
        return $parseStr;
    }

    /**
     +----------------------------------------------------------
     * noaccess标签解析 
     * 如果没有模块和操作权限则输出，默认为当前模块和操作
     * 格式： <noaccess module="" action="" >content</noaccess>
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _noaccess($attr,$content) 
    {
        $tag		= $this->parseXmlAttr($attr,'noaccess');
        $module		= $tag['module']?$tag['module']:MODULE_NAME;
		$action		= $tag['action']?$tag['action']:ACTION_NAME;
        $parseStr = '<?php $accessList = Session::get("_ACCESS_LIST"); if(!Session::is_setLocal("administrator") &&  !isset($accessList[strtoupper(APP_NAME)][strtoupper("'.$module.'")][strtoupper("'.$action.'")])) : ?>'.$content.'<?php endif; ?>';
        return $parseStr;
    }

	public function _layout($attr,$content) {
		$tag		= $this->parseXmlAttr($attr,'layout');
		$name	=	$tag['name'];
		$cache	=	$tag['cache'];
		$parseStr	=	"<!-- layout::$name::$cache -->";
		return $parseStr;
	}

}//类定义结束
?>