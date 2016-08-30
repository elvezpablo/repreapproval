<?php
class RPAApp {
  function __construct() {

  }

  public function checkAuthenticated($redirect = 'index.php') {
      if(!$this->isLoggedIn()) {        
        header('location: '.$redirect);
      }
  }

  public function isLoggedIn() {
    return $_SESSION['logge'] and isset($_SESSION['logge']['id']);
  }

}
 ?>
