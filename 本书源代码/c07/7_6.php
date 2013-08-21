<?php

//<!---------------------------------------文件名： 7_6.php-------------------------------->
//引用fpdf类文件
include_once ("chinese.php");
//创建新的pdf类，并继承fpdf类
class pdf extends PDF_Chinese {
	//重新定义header()函数
	function Header() {
		//在页眉中插入图片
		$this->Image('logo.png', 10, 8, 33);
		//设置显示页眉使用的字体名称、样式和大小
		$this->SetFont('simsun', '', 10);
		//为页眉内容定位
		$this->Cell(80);
		//定位并显示页眉
		$this->Cell(30, 10, 'FPDF生成的PDF文件', 0, 0, 'C');
		//添加分割线
		$this->Ln(20);
	}
	//设置页脚
	function Footer() {
		//定义页脚信息
		$this->SetY(-15);
		//设置显示页脚使用的字体名称、样式和大小
		$this->SetFont('simsun', '', 10);
		//显示页码
		$this->Cell(0, 10, '页 ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
	//生成表格函数
	function BasicTable($header, $data) {
		//输出表头
		foreach ($header as $col){
			$this->Cell(40, 7, $col, 1);
		}
		$this->Ln();
		//构建数据
		foreach ($data as $row) {
			foreach ($row as $col){
				//显示数据内容
				$this->Cell(40, 6, $col, 1);
			}
			$this->Ln();
		}
	}
}
//使用新的pdf类，创建PDF文件
//初始化pdf类
$pdf = new pdf();
$pdf->AddGBFont('simsun', '宋体');
$pdf->AddGBFont('simhei', '黑体');
$pdf->AddGBFont('simkai', '楷体_GB2312');
$pdf->AddGBFont('sinfang', '仿宋_GB2312');
$pdf->SetFont('simsun', '', 20);
$pdf->Open();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('fw.png', 140, 25, 40);
$pdf->SetFont('simsun', '', 20);
$pdf->Cell(0, 10, '宋体', 0, 1);
$header = array (
	'姓名',
	'年龄',
	'专业'
);
$student = array (
	array ("小李",19,"计算机"),
	array ("小张",18,"计算机"),
	array ("小刘",19,"计算机"),
	array ("小苑",20,"计算机"),
	array ("小吴",20,"计算机"),
	array ("小王",20,"计算机"),
	array ("小朱",18,"计算机")
);
$pdf->SetFont('simsun', '', 14);
$pdf->BasicTable($header, $student);
$pdf->Ln();
$pdf->Write("", "友情链接", "http://www.baidu.com");
$pdf->AddPage();
$pdf->Write("", "第二页内容");
$pdf->Output();
?>