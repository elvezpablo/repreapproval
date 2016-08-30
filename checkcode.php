<?php 
include('admin/config.php');
if(isset($_REQUEST['action']) and $_REQUEST['action']=='codevalid')
{
$time=strtotime(date('y-m-d'));
$slePromo=mysql_query("select * from code where p_code='".$_REQUEST['code']."' and start_date<='".$time."' and end_date>='".$time."'");
$Check=mysql_num_rows($slePromo);
if($Check>0)
{
	$CodeApply=mysql_fetch_assoc($slePromo);
	
	if($CodeApply['applies_to']=='Y')
	{
		echo "success";
		exit;
	}
	else if($CodeApply['applies_to']==$_REQUEST['plan'])
	{
		echo "success";
		exit;
	}
	else
	{
		echo "unsuccess";
		exit;
	}
}
else
{
	echo "unsuccess";
}
}
?>