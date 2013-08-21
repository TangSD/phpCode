<?php
/*******************13_1.php********************/
include("template.php");
$themes = new template(true);
$themes->load("themes.php");
$title = "模板演示";
$logo  = "模板演示文件－标头";
$menu = "首页 | 论坛 | 博客 | 下载 | 联系我们";
$left = "<div><b>热门下载</b></div><div>PHP教程</div><div>PHP实例</div><div><b>精品图书</b></div><div>PHP实例</div><div>搜索引擎</div><div></div>";
$contents = "详细内容显示区域";
$footer = "关于我们 | 联系我们 | 论坛 | 博客";
$themes->setLabel("{title}",$title);
$themes->setLabel("{logo}",$logo);
$themes->setLabel("{menu}",$menu);
$themes->setLabel("{left}",$left);
$themes->setLabel("{contents}",$contents);
$themes->setLabel("{footer}",$footer);
$themes->out();
?>
