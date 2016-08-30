<?php
include("admin/config.php");
if(!isset($_SESSION['logge']['id']))
 {
   header('location:index.php');
 }

if(isset($_SESSION['logge']['id']))
 {
  $deactivtae= mysql_query("update `userthree` set `email`= 'ACCOUNT_HAS_BEEN_DELETED', `username`= '".$_SESSION['logge']['email']."' where id= '".$_SESSION['logge']['id']."' and email= '".$_SESSION['logge']['email']."'");
  if($deactivtae)
   {
	 session_destroy();
	 header('location:bestwishes.php');
   }
   
 }


?>