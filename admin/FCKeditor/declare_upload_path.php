<?php
//sets path for bthe teh config files in FCK editor
$arrTemp = explode("|", $_GET['fckFold']);
$Config['UserFilesPath'] = $arrTemp[0];
$Config['UserFilesAbsolutePath'] = $arrTemp[1];
?>

