<?php
/**
 * Created by PhpStorm.
 * User: paul.rangel
 * Date: 7/16/14
 * Time: 9:20 PM
 * http://documentation.mailgun.com/libraries.html#libraries
 *
 * https://github.com/mailgun/mailgun-php/tree/master/src/Mailgun/Messages
 */
require '../../vendor/autoload.php';

include('RPAMailGun.php');

$mailgun = new RPAMailGun();

$subject = " email test ";
$subject .= date('F jS  h:i A');
$to= 'prangel@gmail.com';


//$body = $mailgun->getHomeBuyerHTML("Dude", "dude@dudeface.com", "Somepassword");

//$body = $mailgun->getContactHTML("Bro", "bro@ham.com", "707 777-2222", "yaya", "some longer message");

//$body = $mailgun->getHTML('addHomeBuyer', $data);



$contact_data = array(
    'name' => 'Paul',
    'email' => 'some@email.com',
    'phone' => '515 555-6666',
    'subject' => "This is only a test",
    'message' => "Hey look is is a test"
);
if($mailgun->sendContact($to, $subject, $contact_data)) {
    echo "worked";
}

$homebuyer_data = array(
    'username' => $name,
    'email' => $email,
    'password' => $password
);

if($mailgun->sendHomeBuyer($to, $subject, $homebuyer_data)) {
    echo "worked";
}

?>

<pre>
<?php print_r($mailgun->stats()); ?>
</pre>