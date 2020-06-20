<?php 
require_once('init.inc.php');
if (!empty($_POST['chat_id']) || !empty($_POST['message']) ) {
    $daoSendMsg = new chatDAO("http://tank.iai-system.com/api/chat/send");

    $result = $daoSendMsg->sendMsg($_POST['chat_id'], $_POST['message']);
    
    // // var_dump($result);

    // if(!is_array($result)){
    //     var_dump($result);
    // }

    
} else {
    die();
}

