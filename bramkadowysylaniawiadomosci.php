<?php 
if (isset($_COOKIES['my_session'])) {
    @session_id($_COOKIES['my_session']);
  }
  session_name('my_session');
  session_start();
  

if (!empty($_POST["message"]) && !empty($_POST["chat_id"])) {
    print 'cokolwiek';
    

    $chat_id = $_POST["chat_id"];

    $ch1 = curl_init();
    $ch2 = curl_init();
    
    curl_setopt($ch1, CURLOPT_URL, "http://tank.iai-system.com/api/chat/get");
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch1, CURLOPT_HEADER, 0);
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_POSTFIELDS,
                            "login=". $_SESSION['name'].
                            "&key=" . $_SESSION['key'].                              
                            "&last_id=10");

    curl_setopt($ch2, CURLOPT_URL, "http://tank.iai-system.com/api/chat/send");
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch2, CURLOPT_HEADER, 0);
    curl_setopt($ch2, CURLOPT_POST, 1);
    curl_setopt($ch2, CURLOPT_POSTFIELDS,
                              "login=". $_SESSION['name'].
                              "&key=" . $_SESSION['key'].                              
                              "&chat_id=" . $chat_id.
                              "&message=" . $_POST['message']
                              );

    //create the multiple cURL handle
    $mh = curl_multi_init();

    //add the two handles
    curl_multi_add_handle($mh,$ch1);
    curl_multi_add_handle($mh,$ch2);
    
    $index=null;
    do {
      curl_multi_exec($mh,$index);
    } while($index > 0);
    
    $resultSend = curl_multi_getcontent($ch2);
    $resultSend = json_decode($resultSend, true);
    $resultGet = curl_multi_getcontent($ch1);
    $resultGet = json_decode($resultGet, true);

  
    
    // var_dump($resultGet);
    if(is_array($resultGet) && is_array($resultSend) ){
        foreach ($resultGet['list'] as $key => $value) {
            // var_dump($value);
            if($value["chat_id"] == $chat_id ){        
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

    }
    curl_multi_remove_handle($mh, $ch1);
    curl_multi_remove_handle($mh, $ch2);
    curl_multi_close($mh);


}

?>
<!-- <div class="type_msg">
    <div class="input_msg_write">
        <input type="text" class="write_msg" placeholder="Type a message" id="msg" />
        <button id="sendMsg"  class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
    </div>
</div> -->

<?php 



