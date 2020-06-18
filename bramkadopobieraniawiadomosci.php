<?php 
require_once('init.inc.php');
if (!empty($_POST['chat_id'])) {
    $chat_id = $_POST["chat_id"];
}


$daoGetMsg = new chatDAO("http://tank.iai-system.com/api/chat/get");

$result = $daoGetMsg->getMsg();

$result = $result["list"];
$result = array_reverse($result);

foreach ($result as $key => $value) {
    if($value["chat_id"] == $_POST["chat_id"]){        
        // var_dump($value);
        print   '   
            <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                <span class="sm-font">'.$value['login'].'</span></div>
                <div class="received_msg">
                    <div class="received_withd_msg">
                        <p>'.$value["message"].'
                        <br><span class="sm-font">Send at: '. $value["date"].'</span>
                        </p>
                        
                    </div>
                </div>
                
            </div>';
    }
    
}

?>
<!-- <div class="type_msg">
    <div class="input_msg_write">
        <input type="text" class="write_msg" placeholder="Type a message" id="msg" />
        <button id="sendMsg"  class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
    </div>
</div> -->


