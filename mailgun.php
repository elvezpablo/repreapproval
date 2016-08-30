<?php

# include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-06wn7r2ckve38jgbeftn7lc8bqyxl5o7');
$domain = "mg.repreapproval.com";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Mailgun Sandbox <postmaster@sandboxd8ddb92b0f9741a5950c1cb2d28f7860.mailgun.org>',
                        'to'      => 'Paul Rangel <prangel@gmail.com>',
                        'subject' => 'Hello Paul Rangel',
                        'text'    => 'Congratulations Paul Rangel, you just sent an email with Mailgun!  You are truly awesome!  You can see a record of this email in your logs: https://mailgun.com/cp/log .  You can send up to 300 emails/day from this sandbox server.  Next, you should add your own domain so you can send 10,000 emails/month for free.'));




?>
