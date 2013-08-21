<?php
//加载常用类
include_once 'class/mysql.class.php';
class globalClass extends mysql{
	function globalClass($host,$user,$pass,$db,$charset,$pre){
		//链接数据库
		$this->mysql($host,$user,$pass,$db,$charset,$pre);
	}
	function newUser(){
		$this->setSql("select id,username from #_user order by id desc limit 0,10");
		$this->query();
		if($this->getLines()>0){
			foreach($this->loadRowList() as $k=>$v){
				echo '<LI>'.$v[1].'</LI>';
			}
		}else{
			echo '<LI>暂无注册用户</LI>';
		}
	}
	function newFile(){
		$this->setSql("select id,filetitle,filetype from #_files order by id desc limit 0,10");
		$this->query();
		if($this->getLines()>0){
			foreach($this->loadRowList() as $k=>$v){
				echo '<LI>['.$this->getFileType($v[2]).']<a href="file.php?id='.$v[0].'">'.$v[1].'</a></LI>';
			}
		}else{
			echo '<LI>暂无资源</LI>';
		}
	}
	function newFolder(){
		$this->setSql("select id,title,typeid from #_folder order by id desc limit 0,10");
		$this->query();
		if($this->getLines()>0){
			foreach($this->loadRowList() as $k=>$v){
				echo '<LI>['.$this->getFolderType($v[2]).']<a href="folder.php?id='.$v[0].'">'.$v[1].'</a></LI>';
			}
		}else{
			echo '<LI>暂无资源</LI>';
		}
	}
	//用户认证函数
	function auth(){
		$user = $_SESSION["i"]["username"];
		$pass = $_SESSION["i"]["password"];
		$this->setSql("select id from #_user where username = '".$user."' and password = '".$pass."'");
		$this->query();
		if($this->getLines()<1){
			$this->alert('非法登录!','index.php');	
		}
	}
	//登录用户信息
	function UserInfo(){
		$user = $_SESSION["i"]["username"];
		$pass = $_SESSION["i"]["password"];
		$this->setSql("select id,username,email,sex from #_user where username = '".$user."' and password = '".$pass."'");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo '<li>用户名：'.$user[1].'</li>';
			if($user[3]==1){
				echo '<li>性别：男</li>';
			}else{
				echo '<li>性别：女</li>';
			}			
			echo '<li>邮箱：'.$user[2].'</li>';
		}else{
			$this->alert('非法登录!','index.php');	
		}
	}
	//信息提示窗口
	function alert($info,$url,$time=3){
		echo $info;
		echo '<meta http-equiv="Refresh" content="'.$time.';url='.$url.'"/>';
		exit();
	}
	//登录信息显示
	function loginStats(){
		if(isset($_SESSION["i"])){		
			echo '
				欢迎：'.$_SESSION["i"]["username"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="navlogin" href="index.php">主页</a>
				<a class="navlogin" href="user.php">管理</a>
				<a class="navlogin" href="user_folder.php">文件夹</a>
				<a class="navlogin" href="user_sort.php">分类</a>
				<a class="navlogin" href="logout.php">退出</a>
			';
		}else{
			echo '
			<a class="navlogin" href="index.php">主页</a>
			<a class="navlogin" href="login.php">登录</a>
			<a class="navreg" href="register.php">新用户注册</a>
			';
		}
	}
	//取得文件MIME类型
	function getFileType($mime){
		$mimeArray = Array ( 'application/x-httpd-php' => 'php','application/vnd.lotus-1-2-3' => '123','video/3gpp' => '3gp','application/x-authoware-bin' => 'aab','application/x-authoware-map' => 'aam','application/x-authoware-seg' => 'aas','application/postscript' => 'ai','audio/x-aiff' => 'aif','audio/x-aiff' => 'aifc','audio/x-aiff' => 'aiff','audio/X-Alpha5' => 'als','application/x-mpeg' => 'amc','application/octet-stream' => 'ani','text/plain' => 'asc','application/astound' => 'asd','video/x-ms-asf' => 'asf','application/astound' => 'asn','application/x-asap' => 'asp','video/x-ms-asf' => 'asx','audio/basic' => 'au','application/octet-stream' => 'avb','video/x-msvideo' => 'avi','audio/amr-wb' => 'awb','application/x-bcpio' => 'bcpio','application/octet-stream' => 'bin','application/bld' => 'bld','application/bld2' => 'bld2','application/x-MS-bmp' => 'bmp','application/octet-stream' => 'bpk','application/x-bzip2' => 'bz2','image/x-cals' => 'cal','application/x-cnc' => 'ccn','application/x-cocoa' => 'cco','application/x-netcdf' => 'cdf','magnus-internal/cgi' => 'cgi','application/x-chat' => 'chat','application/octet-stream' => 'class','application/x-msclip' => 'clp','application/x-cmx' => 'cmx','application/x-cult3d-object' => 'co','image/cis-cod' => 'cod','application/x-cpio' => 'cpio','application/mac-compactpro' => 'cpt','application/x-mscardfile' => 'crd','application/x-csh' => 'csh','chemical/x-csml' => 'csm','chemical/x-csml' => 'csml','text/css' => 'css','application/octet-stream' => 'cur','x-lml/x-evm' => 'dcm','application/x-director' => 'dcr','image/x-dcx' => 'dcx','text/html' => 'dhtml','application/x-director' => 'dir','application/octet-stream' => 'dll','application/octet-stream' => 'dmg','application/octet-stream' => 'dms','application/msword' => 'doc','application/x-dot' => 'dot','application/x-dvi' => 'dvi','drawing/x-dwf' => 'dwf','application/x-autocad' => 'dwg','application/x-autocad' => 'dxf','application/x-director' => 'dxr','application/x-expandedbook' => 'ebk','chemical/x-embl-dl-nucleotide' => 'emb','chemical/x-embl-dl-nucleotide' => 'embl','application/postscript' => 'eps','image/x-eri' => 'eri','audio/echospeech' => 'es','audio/echospeech' => 'esl','application/x-earthtime' => 'etc','text/x-setext' => 'etx','x-lml/x-evm' => 'evm','application/x-envoy' => 'evy','application/octet-stream' => 'exe','image/x-freehand' => 'fh4','image/x-freehand' => 'fh5','image/x-freehand' => 'fhc','image/fif' => 'fif','application/x-maker' => 'fm','image/x-fpx' => 'fpx','video/isivideo' => 'fvi','chemical/x-gaussian-input' => 'gau','application/x-gca-compressed' => 'gca','x-lml/x-gdb' => 'gdb','image/gif' => 'gif','application/x-gps' => 'gps','application/x-gtar' => 'gtar','application/x-gzip' => 'gz','application/x-hdf' => 'hdf','text/x-hdml' => 'hdm','text/x-hdml' => 'hdml','application/winhlp' => 'hlp','application/mac-binhex40' => 'hqx','text/html' => 'htm','text/html' => 'html','text/html' => 'hts','x-conference/x-cooltalk' => 'ice','application/octet-stream' => 'ico','image/ief' => 'ief','image/gif' => 'gif','image/ifs' => 'ifs','audio/melody' => 'imy','application/x-NET-Install' => 'ins','application/x-ipscript' => 'ips','application/x-ipix' => 'ipx','audio/x-mod' => 'it','audio/x-mod' => 'itz','i-world/i-vrml' => 'ivr','image/j2k' => 'j2k','text/vnd.sun.j2me.app-descriptor' => 'jad','application/x-jam' => 'jam','application/java-archive' => 'jar','application/x-java-jnlp-file' => 'jnlp','image/jpeg' => 'jpe','image/pjpeg' => 'jpeg','image/jpeg' => 'jpg','image/jpeg' => 'jpz','application/x-javascript' => 'js','application/jwc' => 'jwc','application/x-kjx' => 'kjx','x-lml/x-lak' => 'lak','application/x-latex' => 'latex','application/fastman' => 'lcc','application/x-digitalloca' => 'lcl','application/x-digitalloca' => 'lcr','application/lgh' => 'lgh','application/octet-stream' => 'lha','x-lml/x-lml' => 'lml','x-lml/x-lmlpack' => 'lmlpack','video/x-ms-asf' => 'lsf','video/x-ms-asf' => 'lsx','application/x-lzh' => 'lzh','application/x-msmediaview' => 'm13','application/x-msmediaview' => 'm14','audio/x-mod' => 'm15','audio/x-mpegurl' => 'm3u','audio/x-mpegurl' => 'm3url','audio/ma1' => 'ma1','audio/ma2' => 'ma2','audio/ma3' => 'ma3','audio/ma5' => 'ma5','application/x-troff-man' => 'man','magnus-internal/imagemap' => 'map','application/mbedlet' => 'mbd','application/x-mascot' => 'mct','application/x-msaccess' => 'mdb','audio/x-mod' => 'mdz','application/x-troff-me' => 'me','text/x-vmel' => 'mel','application/x-mif' => 'mi','audio/midi' => 'mid','audio/midi' => 'midi','application/x-mif' => 'mif','image/x-cals' => 'mil','audio/x-mio' => 'mio','application/x-skt-lbs' => 'mmf','video/x-mng' => 'mng','application/x-msmoney' => 'mny','application/x-mocha' => 'moc','application/x-mocha' => 'mocha','audio/x-mod' => 'mod','application/x-yumekara' => 'mof','chemical/x-mdl-molfile' => 'mol','chemical/x-mopac-input' => 'mop','video/quicktime' => 'mov','video/x-sgi-movie' => 'movie','audio/x-mpeg' => 'mp2','audio/x-mpeg' => 'mp3','video/mp4' => 'mp4','application/vnd.mpohun.certificate' => 'mpc','video/mpeg' => 'mpe','video/mpeg' => 'mpeg','video/mpeg' => 'mpg','video/mp4' => 'mpg4','audio/mpeg' => 'mpga','application/vnd.mophun.application' => 'mpn','application/vnd.ms-project' => 'mpp','application/x-mapserver' => 'mps','text/x-mrml' => 'mrl','application/x-mrm' => 'mrm','application/x-troff-ms' => 'ms','application/metastream' => 'mts','application/metastream' => 'mtx','application/metastream' => 'mtz','application/metastream' => 'mzv','application/zip' => 'nar','image/nbmp' => 'nbmp','application/x-netcdf' => 'nc','x-lml/x-ndb' => 'ndb','application/ndwn' => 'ndwn','application/x-nif' => 'nif','application/x-scream' => 'nmz','image/vnd.nok-oplogo-color' => 'nokia-op-logo','application/x-netfpx' => 'npx','audio/nsnd' => 'nsnd','application/x-neva1' => 'nva','application/oda' => 'oda','application/x-AtlasMate-Plugin' => 'oom','audio/x-pac' => 'pac','audio/x-epac' => 'pae','application/x-pan' => 'pan','image/x-portable-bitmap' => 'pbm','image/x-pcx' => 'pcx','image/x-pda' => 'pda','chemical/x-pdb' => 'pdb','application/pdf' => 'pdf','application/font-tdpfr' => 'pfr','image/x-portable-graymap' => 'pgm','image/x-pict' => 'pict','application/x-perl' => 'pm','application/x-pmd' => 'pmd','image/png' => 'png','image/x-portable-anymap' => 'pnm','image/png' => 'pnz','application/vnd.ms-powerpoint' => 'pot','image/x-portable-pixmap' => 'ppm','application/vnd.ms-powerpoint' => 'pps','application/vnd.ms-powerpoint' => 'ppt','application/x-cprplayer' => 'pqf','application/cprplayer' => 'pqi','application/x-prc' => 'prc','application/x-ns-proxy-autoconfig' => 'proxy','application/postscript' => 'ps','application/listenup' => 'ptlk','application/x-mspublisher' => 'pub','video/x-pv-pvx' => 'pvx','audio/vnd.qcelp' => 'qcp','video/quicktime' => 'qt','image/x-quicktime' => 'qti','image/x-quicktime' => 'qtif','text/vnd.rn-realtext3d' => 'r3t','audio/x-pn-realaudio' => 'ra','audio/x-pn-realaudio' => 'ram','application/x-rar-compressed' => 'rar','image/x-cmu-raster' => 'ras','application/rdf+xml' => 'rdf','image/vnd.rn-realflash' => 'rf','image/x-rgb' => 'rgb','application/x-richlink' => 'rlf','audio/x-pn-realaudio' => 'rm','audio/x-rmf' => 'rmf','audio/x-pn-realaudio' => 'rmm','audio/x-pn-realaudio' => 'rmvb','application/vnd.rn-realplayer' => 'rnx','application/x-troff' => 'roff','image/vnd.rn-realpix' => 'rp','audio/x-pn-realaudio-plugin' => 'rpm','text/vnd.rn-realtext' => 'rt','x-lml/x-gps' => 'rte','application/rtf' => 'rtf','application/metastream' => 'rtg','text/richtext' => 'rtx','video/vnd.rn-realvideo' => 'rv','application/x-rogerwilco' => 'rwc','audio/x-mod' => 's3m','audio/x-mod' => 's3z','application/x-supercard' => 'sca','application/x-msschedule' => 'scd','application/e-score' => 'sdf','application/x-stuffit' => 'sea','text/x-sgml' => 'sgm','text/x-sgml' => 'sgml','application/x-sh' => 'sh','application/x-shar' => 'shar','magnus-internal/parsed-html' => 'shtml','application/presentations' => 'shw','image/si6' => 'si6','image/vnd.stiwap.sis' => 'si7','image/vnd.lgtwap.sis' => 'si9','application/vnd.symbian.install' => 'sis','application/x-stuffit' => 'sit','application/x-Koan' => 'skd','application/x-Koan' => 'skm','application/x-Koan' => 'skp','application/x-Koan' => 'skt','application/x-salsa' => 'slc','audio/x-smd' => 'smd','application/smil' => 'smi','application/smil' => 'smil','application/studiom' => 'smp','audio/x-smd' => 'smz','audio/basic' => 'snd','text/x-speech' => 'spc','application/futuresplash' => 'spl','application/x-sprite' => 'spr','application/x-sprite' => 'sprite','application/x-spt' => 'spt','application/x-wais-source' => 'src','application/hyperstudio' => 'stk','audio/x-mod' => 'stm','application/x-sv4cpio' => 'sv4cpio','application/x-sv4crc' => 'sv4crc','image/vnd' => 'svf','image/svg-xml' => 'svg','image/svh' => 'svh','x-world/x-svr' => 'svr','application/x-shockwave-flash' => 'swf','application/x-shockwave-flash' => 'swfl','application/x-troff' => 't','application/octet-stream' => 'tad','text/x-speech' => 'talk','application/x-tar' => 'tar','application/x-tar' => 'taz','application/x-timbuktu' => 'tbp','application/x-timbuktu' => 'tbt','application/x-tcl' => 'tcl','application/x-tex' => 'tex','application/x-texinfo' => 'texi','application/x-texinfo' => 'texinfo','application/x-tar' => 'tgz','application/vnd.eri.thm' => 'thm','image/tiff' => 'tif','image/tiff' => 'tiff','application/x-tkined' => 'tki','application/x-tkined' => 'tkined','application/toc' => 'toc','image/toy' => 'toy','application/x-troff' => 'tr','x-lml/x-gps' => 'trk','application/x-msterminal' => 'trm','audio/tsplayer' => 'tsi','application/dsptype' => 'tsp','text/tab-separated-values' => 'tsv','text/tab-separated-values' => 'tsv','application/octet-stream' => 'ttf','application/t-time' => 'ttz','text/plain' => 'txt','audio/x-mod' => 'ult','application/x-ustar' => 'ustar','application/x-uuencode' => 'uu','application/x-uuencode' => 'uue','application/x-cdlink' => 'vcd','text/x-vcard' => 'vcf','video/vdo' => 'vdo','audio/vib' => 'vib','video/vivo' => 'viv','video/vivo' => 'vivo','application/vocaltec-media-desc' => 'vmd','application/vocaltec-media-file' => 'vmf','application/x-dreamcast-vms-info' => 'vmi','application/x-dreamcast-vms' => 'vms','audio/voxware' => 'vox','audio/x-twinvq-plugin' => 'vqe','audio/x-twinvq' => 'vqf','audio/x-twinvq' => 'vql','x-world/x-vream' => 'vre','x-world/x-vrml' => 'vrml','x-world/x-vrt' => 'vrt','x-world/x-vream' => 'vrw','workbook/formulaone' => 'vts','audio/x-wav' => 'wav','audio/x-ms-wax' => 'wax','image/vnd.wap.wbmp' => 'wbmp','application/vnd.xara' => 'web','image/wavelet' => 'wi','application/x-InstallShield' => 'wis','video/x-ms-wm' => 'wm','audio/x-ms-wma' => 'wma','application/x-ms-wmd' => 'wmd','application/x-msmetafile' => 'wmf','text/vnd.wap.wml' => 'wml','application/vnd.wap.wmlc' => 'wmlc','text/vnd.wap.wmlscript' => 'wmls','application/vnd.wap.wmlscriptc' => 'wmlsc','text/vnd.wap.wmlscript' => 'wmlscript','audio/x-ms-wmv' => 'wmv','video/x-ms-wmx' => 'wmx','application/x-ms-wmz' => 'wmz','image/x-up-wpng' => 'wpng','x-lml/x-gps' => 'wpt','application/x-mswrite' => 'wri','x-world/x-vrml' => 'wrl','x-world/x-vrml' => 'wrz','text/vnd.wap.wmlscript' => 'ws','application/vnd.wap.wmlscriptc' => 'wsc','video/wavelet' => 'wv','video/x-ms-wvx' => 'wvx','application/x-wxl' => 'wxl','application/x-gzip' => 'x-gzip','application/vnd.xara' => 'xar','image/x-xbitmap' => 'xbm','application/x-xdma' => 'xdm','application/x-xdma' => 'xdma','application/vnd.fujixerox.docuworks' => 'xdw','application/xhtml+xml' => 'xht','application/xhtml+xml' => 'xhtm','application/xhtml+xml' => 'xhtml','application/vnd.ms-excel' => 'xla','application/vnd.ms-excel' => 'xlc','application/x-excel' => 'xll','application/vnd.ms-excel' => 'xlm','application/vnd.ms-excel' => 'xls','application/vnd.ms-excel' => 'xlt','application/vnd.ms-excel' => 'xlw','audio/x-mod' => 'xm','text/xml' => 'xml','audio/x-mod' => 'xmz','application/x-xpinstall' => 'xpi','image/x-xpixmap' => 'xpm','text/xml' => 'xsit','text/xml' => 'xsl','text/xul' => 'xul','image/x-xwindowdump' => 'xwd','chemical/x-pdb' => 'xyz','application/x-yz1' => 'yz1','application/x-compress' => 'z','application/x-zaurus-zac' => 'zac','application/zip' => 'zip' );
		return $mimeArray[$mime];
	}
	//文件夹类型
	function getFolderType($key){
		$keys = array('1'=>'图形文件','2'=>'视频文件','3'=>'其他文件');
		return $keys[$key];
	}
	//创建文件夹类型选择控件
	function buildTypeSelect($default=0){
		$keys = array('1'=>'图形文件','2'=>'视频文件','3'=>'其他文件');
		$select = "<select name='typeid'>";
		foreach($keys as $k=>$v){
			if($k==$default){
				$select .= "<option value='".$k."' selected='selected'>".$v."</option>";
			}else{
				$select .= "<option value='".$k."'>".$v."</option>";
			}
		}
		$select .= "</option>";
		return $select;
	}
	//分类名称
	function getSortTitle($key){
		$this->setSql("select title from #_sort where id = '".$key."'");
		$this->query();
		if($this->getLines()>0){
			$result = $this->loadRow();
			return $result[0];
		}else{
			return "无";
		}
	}
	//布尔值转换
	function getTitle($key){
		$keys = array('true'=>'是','false'=>'否','1'=>'是','0'=>'否');
		return $keys[$key];
	}
	//创建用户分类选择控件
	function buildSelect($table,$where){
		$this->setSql("select id,title from #_".$table." where 1 ".$where);
		$this->query();
		$select = "<select name='".$table."'>";
		if($this->getLines()>0){
			foreach($this->loadRowList() as $k=>$v){
				$select .= "<option value='".$v[0]."'>".$v[1]."</option>";
			}
		}else{
			$select .= "<option value='0'>没有分类</option>";
		}
		$select .= "</select>";
		return $select;
	}
	//自由选择数据库字段
	function get($table,$fields,$key,$word){
		$this->setSql("select `".$fields."` from #_".$table." where `".$key."`='".$word."'");
		$this->query();
		$f = $this->loadRow();
		return $f[0];
	}
}
$g = new globalClass("localhost","root","password","multimedia","latin1","m");
?>
