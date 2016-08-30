<?php

class RPAAddHomeBuyer {
  function __construct() {

  }
  public function generatePassword() {
    $randstring = '';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i = 0; $i < 10; $i++){
      $randstring .= $characters[rand(0, strlen($characters))];
    }
    $randstring;
  }

  public function save() {
    $makeSQLFriendly = function($input) {
        return "'".$input."',";
    }

    $sql_data = array(
      'firstname' => $_REQUEST['first_name'],
      'phone' => $_REQUEST['phone'],
      'email' => $_REQUEST['email'],
      'username' => $_REQUEST['username'],
      'password' => $this->generatePassword(),
      'accounttype' => 'HOMEBUYER',
      'otherbuyer' => $_REQUEST['byr1'].'@=@'.$_REQUEST['byr2'].'@=@'.$_REQUEST['byr3'],
      'street' => $_REQUEST['street'],
      'city' => $_REQUEST['city'],
      'zip' => $_REQUEST['zip'],
      'createdby' => $_REQUEST['rtr'],
      'lender_of_buyer' => $_SESSION['logge']['id'],
      'created' => time()
    );

   $sql = "INSERT INTO userthree ";
   $sql .= "(";
   $sql .= array_map($makeSQLFriendly, $array_keys[$sql_data]);
   $sql .= ") VALUES (";
   $sql .= array_map($makeSQLFriendly, $array_values[$sql_data]);
   $sql .= ")";
   print($sql);
  }

}

 ?>
