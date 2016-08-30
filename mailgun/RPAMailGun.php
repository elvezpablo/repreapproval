<?php
/**
 *
 * Created by PhpStorm.
 * User: paul.rangel
 * Date: 7/16/14
 * Time: 8:58 PM
 *
 * https://github.com/mailgun/mailgun-php/tree/master/src/Mailgun/Messages
 */


require "JsonDB.class.php";

use Mailgun\Mailgun;
use Handlebars\Handlebars;

//namespace mailgun;


class RPAMailGun
{

    private $mg;
    private $domain = "sandboxd8ddb92b0f9741a5950c1cb2d28f7860.mailgun.org";
    private $from = 'RePreApproval <admin@repreapproval.com>';
    private $config;
    private $db;

    public function __construct()
    {
        // set up the mailgun API
        $this->mg = new Mailgun("key-06wn7r2ckve38jgbeftn7lc8bqyxl5o7");
        // load the templating engine
        $template_dir = __DIR__ . '/templates/';
        $this->engine = new Handlebars(
            array(
                'loader' => new \Handlebars\Loader\FilesystemLoader($template_dir),
                'partials_loader' => new \Handlebars\Loader\FilesystemLoader($template_dir, array('prefix' => '_'))
            ));
        // set up the base data to be loaded into template
        $this->config = array(
            'timestamp' => date('F jS  h:i A')
        );
        //
        $this->db = new JsonDB(__DIR__ . "/");
    }

    private function generateTracking($template)
    {

        $time = time();
        $salt = $time;
        $salt .= $template;
        $tracking = md5($salt);

        $this->storeTrackingData($template, $time, $tracking);

        return $tracking;
    }

    private function storeTrackingData($template, $timestamp, $tracking_id, $notes = null)
    {
        $trackingData = array(
            'template' => $template,
            'sent' => $timestamp,
            'tracking_id' => $tracking_id
        );
        if (!is_null($notes)) {
            $trackingData['notes'] = $notes;
        }
        $this->db->insert('tracking', $trackingData);
    }

    public function trackEmailOpened($tracking_id)
    {
        $r = $this->db->select('tracking', 'tracking_id', $tracking_id);
        if (count($r) == 0)
            return;
        if (array_key_exists('opened', $r[0])) {
            $r[0]['last_opened'] = time();
        } else {
            $r[0]['opened'] = time();

        }
        $this->db->update('tracking', 'tracking_id', $tracking_id, $r[0]);
    }

    private function getHTML($template, $data)
    {
        // add the tracking info
        $this->config['tracking'] = $this->generateTracking($template);
        // append the default data
        $d = array_merge($data, $this->config);
        return $this->engine->render($template, $d);
    }

    public function sendHomeBuyer($to, $subject, $data)
    {
        $message = $this->getHTML('addHomeBuyer', $data);
        return $this->mail($to, $subject, $message, array('home_buyer'));
    }

    public function sendContact($to, $subject, $data)
    {
        $message = $this->getHTML('contact', $data);
        return $this->mail($to, $subject, $message, array('contact'));
    }

    public function mail($to, $subject, $message, $tags = null)
    {
        $mail_data =array (
            'from' => $this->from,
            'to' => $to,
            'subject' => $subject,
            'html' => $message
        );
        if($tags) {
            $mail_data['o:tag'] = $tags;
        }
        $response = $this->mg->sendMessage($this->domain, $mail_data);
        return ($response->http_response_code == 200);
    }

    /*
     * Returns a count of sent items per day
     * [
     *  {"total_count":26,"created_at":"Tue, 22 Jul 2014 00:00:00 GMT","tags":{},"id":"53cdf7c64ad147d665ea1e14","event":"sent"},
     *  {"total_count":1,"created_at":"Mon, 21 Jul 2014 00:00:00 GMT","tags":{},"id":"53cd436c4ad147d665e96bf5","event":"sent"},
     *  {"total_count":9,"created_at":"Thu, 17 Jul 2014 00:00:00 GMT","tags":{},"id":"53c733ec4ad147d665e51cfa","event":"sent"}
     * ]
     */
    public function stats()
    {
        $response = $this->mg->get($this->domain . "/stats", array(
            'event' => array('sent')
        ));
        if ($response->http_response_code == 200) {
            return json_encode($response->http_response_body->items);
        }

    }

}