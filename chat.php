<?php

require_once('init.inc.php');
require_once('inc/header.inc.php');
require_once('inc/nav.inc.php');
  
  if (empty($_SESSION['name'])) {
    echo '<div class="container mt-5">'.
    '<div class="row justify-content-md-center">'.
    '<div class="col-md-auto alert alert-danger" role="alert">'.
    '<h1>Zaloguj się!</h1>'.
    '</div></div></div>';
    die;
  }

// CREATE CONVERSATION
if (!empty($_POST['convName']) ) {
  $dao = new chatDAO("http://tank.iai-system.com/api/chat/create");
  $new_conv = $dao->createChat($_POST['convName']);
  unset($_POST['convName']);
}
// ADD USER TO CONVERSATION
if(isset($_POST['inviteBuddy'])) {
  $dao = new chatDAO("http://tank.iai-system.com/api/chat/join");
  $result = $dao->addBuddy($_POST['buddyName'], $_POST['invChat_id']);

}
// LEAVE CONVERSATION
if(!empty($_POST['leave'])) {
  $dao = new chatDAO("http://tank.iai-system.com/api/chat/leave");
  $result = $dao->leaveConv($_POST['chat_id']); 
}

function getActiveChat() {
  $dao = new chatDAO("http://tank.iai-system.com/api/chat/getActive");
  $activConv = $dao->getActive();
  return $activConv;
}


?>


<div class="container">
<div class="messaging mt-2">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chat_name">
                Create Chat
              </button>
            </div>
            <!-- <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div> -->
          </div> 
          <div class="inbox_chat">
          <?php
          $activConv = getActiveChat();
          foreach ($activConv as $key => $value) {
            echo '
                  <div class="chat_list">
                  <div class="chat_people">
                  <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                  <div class="chat_id">                  
                  <h5 class="convName" data-chat-id="'.$value['id'].'" >'. $value['name'] .'</h5>
                  <div class="d-flex justify-content-between">
                  <div>
                  <button" class="trans-btn btn btn-success" data-chat-id="'.$value['id'].'" data-toggle="modal" data-target="#add_buddy">Add Buddy</button></div>                   
                  <form class="" action="chat.php" method="post">
                    <input type="hidden" name="chat_id" value="'. $value['id'] .'"/>
                    <input class="btn btn-danger leaveChat" type="submit" name="leave" value="Leave"/>
                  </form>
                                   
                  </div>
                  </div>
                  </div>
                  </div>
            ';
          }
           ?>
         </div>
          <div>
          </div>
        </div>
        <?php  ?>
        <div class="mesgs">
          <div class="msg_history"></div> 
          <div id="instuction">Choose room</div>
          <div id="msg" style="display:none;" class="type_msg">
            <div class="input_msg_write">
              <input type="text" data-chatid="" class="write_msg" placeholder="Type a message" id="msgText" />
              <button id="sendMsg" class="msg_send_btn" type="button">
                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
              </button>
          </div>
        </div>               
      </div>
    </div>
  </div>
<!-- MODALS -->
<!-- Conv name -->
<div class="modal fade" id="chat_name" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Type conversation name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="chat.php" method="post">
        <div class="modal-body">
            <input type="text" name="convName"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="sumbitConvName">Enter</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Add buddy -->
<div class="modal fade" id="add_buddy" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" method="POST" action="chat.php">
        <div class="note">
            <p>Invite buddy</p>
        </div>

        <div class="form-content">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="buddyName">Buddy name</label>
                <input type="text" name="buddyName" required/>
                <input type="hidden" name="invChat_id" id="invChatID"/>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="inviteBuddy" value="Enter"/>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="error"></div>