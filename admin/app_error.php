<?php
class AppError extends ErrorHandler {

    public function error404($params){
        extract($params);

        if(!isset($url)){
            $url = $action;
        }

        if(!isset($message)){
            $message ="";
        }

        if(!isset($base)){
            $base = "";
        }

        $this->controller->redirect(array('controller'=>'pages','action'=>'home'));
        //Or the page you want...

    }

}
?>