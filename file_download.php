<?php ob_start();
session_start();
if(isset($_REQUEST['file_name']))
{
 if(!isset($_SESSION['REAL_VEER']['id']) and !isset($_SESSION['logge']['id']))// to restrict home-buyer to see letters after 90 days
  {
   if(strpos($_REQUEST['file_name'],'certificates/')!== false)
	{
     if(strpos($_REQUEST['file_name'],'RePre_BAS')!== false)
	  {
		$vgfZ= explode('RePre_BAS', $_REQUEST['file_name']);
	  }
	 elseif(strpos($_REQUEST['file_name'],'RePre')!== false)
	  {
		$vgfZ= explode('RePre', $_REQUEST['file_name']);
	  }
	 $stamAP= explode('.', $vgfZ[1]);
	 //$ne= 1;// for testing
	 $ne= 90*24*60*60;
	 $xpiry= $stamAP[0]+$ne;
	 $tda= time();
	 if($tda>$xpiry)
	  {
		echo 'Unauthorized Request';
		exit;
	  }
	}
  }

 $path = $_SERVER['DOCUMENT_ROOT']."/"; // change the path to fit your websites document structure
 $fullPath = $_REQUEST['file_name'];
 if($fd = fopen ($fullPath, "r"))
  {
	$fsize = filesize($fullPath);
	$path_parts = pathinfo($fullPath);
	$ext = strtolower($path_parts["extension"]);
	switch ($ext)
	 {
	  case "pdf":
	  header("Content-type: application/pdf"); // add here more headers for diff. extensions
	  header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
	  break;
	  default;
	  header("Content-type: application/octet-stream");
	  header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
     }
    header("Content-length: $fsize");
    header("Cache-control: private"); //use this to open files directly
	while(!feof($fd))
	 {
	  $buffer = fread($fd, 2048);
	  echo $buffer;
     }
  }
fclose ($fd);
exit;
}
?>
