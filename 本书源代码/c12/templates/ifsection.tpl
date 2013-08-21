<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>{$title}</title>
	</head>
	<body>
		<table border=1>
			{section name=classmate loop=$student}
				{if $smarty.section.classmate.index is even by 1}
				    <tr bgcolor="#EFEFEF">
				    	<td>
				     		{$student[classmate]}
				    	</td>
				    </tr>
				{else}
				    <tr bgcolor="#FFFFFFF">
				    	<td>
				    		{$student[classmate]}
				    	</td>
				    </tr>
				{/if}
			{sectionelse}
			    没有数据
			{/section}
		</table>
	</body>
</html>