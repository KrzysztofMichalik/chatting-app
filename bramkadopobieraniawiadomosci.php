<?php 
require_once('init.inc.php');

if (!empty($_POST['chat_id'])) {
    $chat_id = $_POST["chat_id"];
} else {
    die();
}


$daoGetMsg = new chatDAO("http://tank.iai-system.com/api/chat/get");

$result = $daoGetMsg->getMsg();
$result = $result["list"];

foreach ($result as $key => $value) {
    if($value['chat_id'] !== $chat_id ){
        unset($result[$key]);
    }
}



$result = array_reverse($result);
$last_key = end($result);
print '<div class="vardupms" id="recived_msg"  data-chatid="'. $_POST['chat_id'].'"></div>';


foreach ($result as $key => $value) {

    // var_dump($value);
    if($value["chat_id"] == $_POST["chat_id"]){                
        print   '<div class="incoming_msg">                    
                    <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                    <span class="sm-font">'.$value['login'].'</span></div>
                    <div class="received_msg">
                        <div class="received_withd_msg" ';      
                        // TUTAJ JEST PROBLEM Z DRUKOWANIEM I REDENDUNCJA KODU. 
                        if($last_key["id"] == $value["id"]){
                            print 'data-msg-id="' . $value["id"] . '" id="lastMsg">
                            <p>'.$value["message"].'
                            <br><span class="sm-font">Send at: '. $value["date"].'</span>
                            </p>                            
                        </div>
                    </div>                
                </div>';  
                        } else {
                            print '">
                            <p>'.$value["message"].'
                                <br><span class="sm-font">Send at: '. $value["date"].'</span>
                            </p>                            
                        </div>
                    </div>                
                </div>'; 
                         }
     }
    
}


?>
