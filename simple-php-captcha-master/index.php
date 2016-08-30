<?php
session_start();
$_SESSION = array();

include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();

?>


<?php
print_r($_SESSION['captcha']['code']);
?>

    	<?php
    	echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code" >';

    	?>
    </p>
    
  
    
