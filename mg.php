<?php

require '../vendor/autoload.php';
use Mailgun\Mailgun;


# First, instantiate the SDK with your API credentials and define your domain. 
$mg = new Mailgun("key-06wn7r2ckve38jgbeftn7lc8bqyxl5o7");
$domain = "sandboxd8ddb92b0f9741a5950c1cb2d28f7860.mailgun.org";

# Now, compose and send your message.
$mg->sendMessage($domain, array('from'    => 'mailgun@example.com', 
                                'to'      => 'prangel@gmail.com', 
                                'subject' => 'The PHP SDK is awesome!', 
                                'text'    => 'It is so simple to send a message.'));


?>
