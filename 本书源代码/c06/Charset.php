<?php
/********Charset.php***********/
class Charset{
	//gb2312转化为utf-8
	function gb2utf8($chars){
		//使用iconv()函数，把gb2312字符，转换为utf-8的字符
		return iconv("gb2312","utf-8",$chars);
	}
	//gb2312转化为unicode
	function gb2unicode($chars){
		$string = "";
		preg_match_all("/[\x80-\xff]?./",$chars,$array);
		//遍历字符串
		foreach($array[0] as $v){
			/**
			 * 使用iconv()函数，把GB2312字符串转化为UTF－8编码
			 * 再使用utf8_unicode()函数，返回UTF-8字符的编码值
			 * 为返回的编码值，添加&#和;符号，形成unicode值
			 * */
			$string .= "&#".$this->utf8_unicode(iconv("GB2312","UTF-8",$v)).";";
		}
		//返回最后的UNICODE值
		return $string;
	}
	//把单个utf-8字符转换为unicode数字值
	function utf8_unicode($c) {
	//根据字符的大小，返回字符串
	switch(strlen($c)) {
		case 1:
	    	return ord($c);
	    case 2:
	    	$n = (ord($c[0]) & 0x3f) << 6;
			$n += ord($c[1]) & 0x3f;
			return $n;
	    case 3:
			$n = (ord($c[0]) & 0x1f) << 12;
			$n += (ord($c[1]) & 0x3f) << 6;
			$n += ord($c[2]) & 0x3f;
			return $n;
	    case 4:
			$n = (ord($c[0]) & 0x0f) << 18;
			$n += (ord($c[1]) & 0x3f) << 12;
			$n += (ord($c[2]) & 0x3f) << 6;
			$n += ord($c[3]) & 0x3f;
			return $n;
		}
	}
	//utf-8转为了gb2312编码
	function utf82gb($chars){
		//使用iconv()函数，把utf-8编码，转化为gb2312编码
		return iconv("utf-8","gb2312",$chars);
	}
	//utf-8编码，转化为unicode编码
	function utf82unicode($chars){
		//使用utf82gb()函数，返回字符的GB值
		$utf8 = $this->utf82gb($chars);
		//再使用gb2unicode()函数，返回字符的unicode值
		return $this->gb2unicode($utf8);
	}
	//unicode编码转化为utf-8编码
	function unicode2utf8($chars){
		$string = "";
		//把unicode编码的字符串进行分割
		$chars = explode(";",$chars);
		//遍历分割后的字符串
		foreach($chars as $char){
			//取得unicode编码中的数字值
			$unicode = substr($char,2);
			//使用unicode_utf8()函数，返回这个值对应的utf-8字符
			$string .= $this->unicode_utf8($unicode);
		}
		//返回最后的utf-8字符串
		return $string;
	}
	//unicode转为了gb2312编码
	function unicode2gb($chars){
		//使用unicode2utf8函数，返回与utf-8对应的字符
		$string = $this->unicode2utf8($chars);
		//再使用utf82gb()函数，返加GB2312编码的字符串
		return $this->utf82gb($string);
	}
	//把单个unicode数字值，转换为utf-8字符
	function unicode_utf8($c){
		$str="";
		//根据unicode数字值，计算并返回字符
		if($c < 0x80){
			$str.=$c;
		}elseif($c < 0x800){
			$str.=chr(0xC0 | $c>>6);
			$str.=chr(0x80 | $c & 0x3F);
		}elseif($c < 0x10000){
			$str.=chr(0xE0 | $c>>12);
			$str.=chr(0x80 | $c>>6 & 0x3F);
			$str.=chr(0x80 | $c & 0x3F);
		}elseif($c < 0x200000){
			$str.=chr(0xF0 | $c>>18);
			$str.=chr(0x80 | $c>>12 & 0x3F);
			$str.=chr(0x80 | $c>>6 & 0x3F);
			$str.=chr(0x80 | $c & 0x3F);
		}
		return $str;
	}
}
?>