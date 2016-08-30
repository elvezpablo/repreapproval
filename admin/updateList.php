<?php 
include("config.php");
$array	= $_POST['arrayorder'];
if ($_POST['update']){
	$count = 1;
	foreach ($array as $idval) {
		 $query ="UPDATE ".$_POST['update']." SET order_id=" . $count . " WHERE id = " . $idval;
		mysql_query($query) or die('Error, insert query failed');
		$count ++;	
	}
	echo 'All saved! Refresh the page to see the changes';
}

?>