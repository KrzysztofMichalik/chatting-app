<?php 
require_once('init.inc.php');
// print 'ka do u u do er er do wu wu do a';
print 'k';
if (!empty($_POST['chat_id']) && !empty($_POST['lastMsgId'])) {
    $daoGetMsg = new chatDAO("http://tank.iai-system.com/api/chat/get");
    $result = $daoGetMsg->getMsg($_POST['lastMsgId']);
    $result = $result["list"];
    

    foreach ($result as $key => $value) {
        if($value['chat_id'] !== $_POST['chat_id'] ){
            unset($result[$key]);
        }
    }
    var_dump($result);

    print   '<div class="incoming_msg">                    
                    <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                    <span class="sm-font">'.$result['login'].'</span></div>
                    <div class="received_msg">
                        <div class="received_withd_msg" ';      
                        print 'data-msg-id="' . $result["id"] . '" id="lastMsg">
                            <p>'.$result["message"].'
                            <br><span class="sm-font">Send at: '. $result["date"].'</span>
                            </p>                            
                        </div>
                    </div>                
                </div>';  
}