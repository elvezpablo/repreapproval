<?php include("config.php");

if(isset($_REQUEST['type']) and $_REQUEST['type']=='sub_sub_menu')
{
	 
	$delete=mysql_query("delete from sub_sub_menu where id='".$_REQUEST['DelId']."'");
	if($delete)
	{
		echo "10";
	}
}
else if(isset($_REQUEST['type']) and $_REQUEST['type']=='submenu')
{
	
	$delete=mysql_query("delete from sub_menu where id='".$_REQUEST['DelId']."'");
	$delete1=mysql_query("DELETE FROM sub_sub_menu WHERE sub_menu_id='".$_REQUEST['DelId']."'");
	if($delete)
	{
		echo "10";
	}
}
else{
	
$delete=mysql_query("DELETE FROM main_menu WHERE id='".$_REQUEST['DelId']."'");
$delete1=mysql_query("DELETE FROM sub_menu WHERE main_menu_id='".$_REQUEST['DelId']."'");
if($delete1)
	{
		echo "10";
	}
}
?>