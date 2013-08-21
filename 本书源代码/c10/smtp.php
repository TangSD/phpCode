<?php
class smtp {
	//定义公共变量
	var $smtp_port; //SMTP服务器端口，默认为25
	var $time_out = 30; //SOCKET超时时间,默认30秒
	var $host_name = "localhost";
	var $log_file = ""; //日志信息
	var $smtp_host; //SMTP主机地址
	var $debug; //调试信息
	var $user; //SMTP服务器用户名
	var $pass; //SMTP服务器密码
	var $sock = false;
	var $auth = true;
	//使用构造函数初始化相关参数
	function smtp($smtp_host = "", $smtp_port = 25, $user, $pass) {
		$this->debug = FALSE;
		$this->smtp_port = $smtp_port;
		$this->smtp_host = $smtp_host;
		$this->user = $user;
		$this->pass = $pass;
	}
	/**
	 * 发送邮件主函数，包括以下参数
	 * $to:收件人信箱地址
	 * $from:发邮人信箱地址
	 * $subject:邮件主题
	 * $body:邮件内容
	 * $mailtype:邮件类型
	 * $cc:抄送地址
	 * $bcc:密送地址
	 * $header:头信息
	 * */
	function sendmail($to, $from, $subject = "", $body = "", $mailtype, $cc = "", $bcc = "", $mail_headers = ""){
		//获取邮件发送者邮箱地址
		$mail_from = $this->get_address($this->strip_comment($from));
		//处理邮件内容
		$body = ereg_replace("(^|(\r\n))(\.)", "\1.\3", $body);
		//构建邮件头信息
		$header .= "MIME-Version:1.0\r\n";
		//如果邮件类型为HTML时，添加HTML头信息
		if($mailtype == "HTML") {
			$header .= "Content-Type:text/html\r\n";
		}
		//处理接收者邮件
		$header .= "To: " . $to . "\r\n";
		//处理抄送者邮件
		if ($cc != "") {
			$header .= "Cc: " . $cc . "\r\n";
		}
		$header .= "From: $from<" . $from . ">\r\n";
		$header .= "Subject: " . $subject . "\r\n";
		$header .= $mail_headers;
		$header .= "Date: " . date("r") . "\r\n";
		$header .= "X-Mailer:By Redhat (PHP/" . phpversion() . ")\r\n";
		list ($msec, $sec) = explode(" ", microtime());
		$header .= "Message-ID: <" . date("YmdHis", $sec) . "." . ($msec * 1000000) . "." . $mail_from . ">\r\n";
		//取得接收者电子邮件地址
		$TO = explode(",", $this->strip_comment($to));
		if ($cc != "") {
			$TO = array_merge($TO, explode(",", $this->strip_comment($cc)));
		}
		if ($bcc != "") {
			$TO = array_merge($TO, explode(",", $this->strip_comment($bcc)));
		}
		$sent = TRUE;
		foreach ($TO as $rcpt_to) {
			$rcpt_to = $this->get_address($rcpt_to);
			if (!$this->smtp_sockopen($rcpt_to)) {
				$this->alert("打开SMTP服务器失败" . $rcpt_to . "<br>");
				$sent = FALSE;
				continue;
			}
			if ($this->smtp_send($this->host_name, $mail_from, $rcpt_to, $header, $body)) {
				$this->alert("发送邮件到<" . $rcpt_to . ">成功<br>");
			} else {
				$this->alert("发送邮件到<" . $rcpt_to . ">失败<br>");
				$sent = FALSE;
			}
			fclose($this->sock);
			$this->alert("与远程主机断开连接!");
		}
		return $sent;
	}
	//SMTP主机命令发送
	function smtp_send($helo, $from, $to, $header, $body = "") {
		if (!$this->smtp_putcmd("HELO", $helo)) {
			return $this->smtp_error("发送HELO命令");
		}
		if ($this->auth) {
			if (!$this->smtp_putcmd("AUTH LOGIN", base64_encode($this->user))) {
				return $this->smtp_error("发送HELO命令");
			}
			if (!$this->smtp_putcmd("", base64_encode($this->pass))) {
				return $this->smtp_error("发送HELO命令");
			}
		}
		if (!$this->smtp_putcmd("MAIL", "FROM:<" . $from . ">")) {
			return $this->smtp_error("发送MAIL FROM命令");
		}
		if (!$this->smtp_putcmd("RCPT", "TO:<" . $to . ">")) {
			return $this->smtp_error("发送RCPT TO命令");
		}
		if (!$this->smtp_putcmd("DATA")) {
			return $this->smtp_error("发送DATA命令");
		}
		if (!$this->smtp_message($header, $body)) {
			return $this->smtp_error("发送信息");
		}
		if (!$this->smtp_eom()) {
			return $this->smtp_error("发送<CR><LF>.<CR><LF> [EOM]");
		}

		if (!$this->smtp_putcmd("QUIT")) {
			return $this->smtp_error("发送QUIT命令");
		}
		return TRUE;

	}
	//使用fsockopen()函数，连接到SMTP主机
	function smtp_sockopen() {
		$this->alert("连接远程主机：" . $this->smtp_host . ":" . $this->smtp_port);
		$this->sock = @ fsockopen($this->smtp_host, $this->smtp_port, $errno, $errstr, $this->time_out);
		//如果主机连接失败，返回错误信息
		if (!($this->sock && $this->smtp_ok())) {
			$this->alert("错误：打开运程主机" . $this->smtp_host . "失败");
			$this->alert("错误内容: " . $errstr . " (" . $errno . ")");
			return FALSE;
		}
		$this->alert("已连接到SMTP主机：" . $this->smtp_host);
		return TRUE;
	}
	//发送邮件的头信息和内容
	function smtp_message($header, $body) {
		fputs($this->sock, $header . "\r\n" . $body);
		$this->alert("> " . str_replace("\r\n", "\n" . "> ", $header . "\n> " . $body . "\n> "));
		return TRUE;
	}
	//发送邮件结束命令
	function smtp_eom(){
		fputs($this->sock, "\r\n.\r\n");
		$this->alert(". [EOM]<br>");
		return $this->smtp_ok();
	}
	//检测SMTP命令是否成功
	function smtp_ok(){
		$response = str_replace("\r\n", "", fgets($this->sock, 512));
		$this->alert($response . "\n");
		if (!ereg("^[23]", $response)) {
			fputs($this->sock, "QUIT\r\n");
			fgets($this->sock, 512);
			$this->alert("错误: 远程主机返回 \"" . $response . "\"\n");
			return FALSE;
		}
		return TRUE;
	}
	//发送SMTP命令到SMTP服务器
	function smtp_putcmd($cmd, $arg = "") {
		if ($arg != "") {
			if ($cmd == ""){
				$cmd = $arg;
			}else{
				$cmd = $cmd . " " . $arg;
			}
		}
		fputs($this->sock, $cmd . "\r\n");
		$this->alert("> " . $cmd . "\n");
		return $this->smtp_ok();
	}
	//显示发送SMTP命令时的错误信息
	function smtp_error($string) {
		$this->alert("" . $string . ".时出现错误<br>");
		return FALSE;
	}
	//显示运行信息
	function alert($message) {
		echo $message."<br>";
		return TRUE;
	}
	//注释邮箱地址
	function strip_comment($address) {
		$comment = "\([^()]*\)";
		while (ereg($comment, $address)) {
			$address = ereg_replace($comment, "", $address);
		}
		return $address;
	}
	//取得电子邮件地址
	function get_address($address) {
		$address = ereg_replace("([ \t\r\n])+", "", $address);
		$address = ereg_replace("^.*<(.+)>.*$", "\1", $address);
		return $address;
	}
}
?>