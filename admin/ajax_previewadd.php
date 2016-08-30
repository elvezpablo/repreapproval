<?php
include ("config.php");
 mysql_query("TRUNCATE TABLE preview");
	  $insert_sql=mysql_query("insert into preview set metatitle ='".addslashes($_REQUEST['metatitle'])."',metakeyword='".addslashes($_REQUEST['metakeyword'])."',metadescription ='".addslashes($_REQUEST['metadescription'])."',pagetitle='".addslashes($_REQUEST['pagetitle'])."',pagesubtitle='".addslashes($_REQUEST['pagesubtitle'])."',rightcontent='".addslashes($_REQUEST['tester1'])."',content='".addslashes($_REQUEST['tester2'])."',url='".$_REQUEST['url']."',smallcontent='".$_REQUEST['urltext']."'");
   if($insert_sql){ 
   echo "50";
   }	
 ?>
 