<?php 
require_once('init.inc.php');

if (!empty($_POST['chat_id'])) {
    $daoGetMsg = new chatDAO("http://tank.iai-system.com/api/chat/get");
    $result = $daoGetMsg->getMsg();
    $result = $result["list"];
        
    $result = array_reverse($result);   
    foreach ($result as $key => $value) {
        if($value['chat_id'] !== $_POST['chat_id'] ){
            unset($result[$key]);
        }
    }
    
    if( !empty($result ) ){
        foreach ($result as $key => $value) {
            print   '<div class="incoming_msg">                    
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                            <span class="sm-font">'.$value["login"].'</span>
                        </div>
                        <div class="received_msg">
                            <div class="received_withd_msg" data-msg-id="' . $value["id"] . '" id="lastMsg">
                                <p>'. $value["message"] . '
                                    <br><span class="sm-font">Send at: '. $value["date"].'</span>
                                </p>                            
                            </div>      
                        </div>                
                    </div>';  

            
        }

    }

}
    



// if (!empty($_POST['chat_id']) && !empty($_POST['lastMsgId'])) {
//     $daoGetMsg = new chatDAO("http://tank.iai-system.com/api/chat/get");
//     $result = $daoGetMsg->getMsg($_POST['lastMsgId']);
//     $result = $result["list"];
    
    
//     foreach ($result as $key => $value) {
//         if($value['chat_id'] !== $_POST['chat_id'] ){
//             unset($result[$key]);
//         }
//     }
//     var_dump($_POST);
//     var_dump($result);
    
//     if( !empty($result ) ){
//         foreach ($result as $key => $value) {
//           $msgID =  intval($_POST['lastMsgId']) + 1;

//           print $msgID;
//           $responseId = intval($value['id']);
//             if($responseId != $_POST['lastMsgId']  ){
//                 print $value['id'] . "\n";
//                 print $_POST['lastMsgId'];
//                 print   '<div class="incoming_msg">                    
//                             <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
//                                 <span class="sm-font">'.$value["login"].'</span>
//                             </div>
//                             <div class="received_msg">
//                                 <div class="received_withd_msg" data-msg-id="' . $value["id"] . '" id="lastMsg">
//                                     <p>'. $value["message"] . '
//                                         <br><span class="sm-font">Send at: '. $value["date"].'</span>
//                                     </p>                            
//                                 </div>      
//                             </div>                
//                         </div>';  

//             }
//         }

//     }

// }

// /var/www/testowa/php_camp4/chat/bramkadoodswierzania.php:10:
// array (size=1)
//   0 => 
//     array (size=5)
//       'id' => string '916' (length=3)
//       'login' => string 'Zbyszek' (length=7)
//       'chat_id' => string '371' (length=3)
//       'message' => string 'Hejka' (length=5)
//       'date' => string '2020-06-20 19:23:54' (length=19)