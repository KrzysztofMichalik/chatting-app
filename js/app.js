$( document ).ready(function() {
    // refresh messanges
    var message = $('#msgText'); 

    var funca = function(id, lastMsgId){
        $.ajax({            
            method: "POST",
            url: "bramkadoodswierzania.php",                        
            data: { chat_id: id, lastMsgId: lastMsgId },
        }).done(function(r){            
            console.log('done?');
            $('.msg_history').html(r);
        }).fail(function(error){
            console.log(error);
        });

    }
    
    function reloadChat(event, id){
        setInterval(function(){           
            funca(event, id)
        }, 1000)
    }

    function getMessages(event, id){
        $.ajax({            
                method: "POST",
                url: "bramkadopobieraniawiadomosci.php",                        
                data: { chat_id: id },
            }).done(function(r){            
                $('.msg_history').html(r);
            }).fail(function(error){
                console.log(error);
            });
    }

    function sendMsg(){
        var msg = message.val();
        message.val("");
        var id = message.data('chatid');
        $.ajax({            
            method: "POST",
            url: "bramkadowysylaniawiadomosci.php",                        
            data: { chat_id: id,
                    message: msg,
            },
        }).done(function(r){
            $('#error').html(r);
            console.log('wiadomsoc wyslana');
          }).fail(function(error){
            console.log(error);
          });
    }

    if($("#lastMsg").length !== 0) {
        console.log('eh');
         var lastMsgId = $("#lastMsg").data("msg-id");
         var chatId = $("#recived_msg").data("chatid");
         reloadChat(chatId, lastMsgId);
       } 
 
     $('.trans-btn').click(function(event){
         var id = $(this).data('chat-id');
         $('#invChatID').val(id);        
     });

    $('.convName').click(function(event){
        
        $(".msg_history").load(" .msg_history > *");
        $('#msg').css("display", "block");
        var id = $(this).data('chat-id');
        message.attr("data-chatid", id);        
        getMessages(event, id);    
    });

    

    $('#sendMsg').click(function(event){        
        sendMsg();
    });

    message.keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            sendMsg();
        }
        //Stop the event from propogation to other handlers
        //If this line will be removed, then keypress event handler attached 
        //at document level will also be triggered
        event.stopPropagation();
    });
});