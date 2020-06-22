$( document ).ready(function() {
    var timer = null;
    var message = $('#msgText'); 
    
    // var funca = function(id, lastMsgId){
    //     xhr = $.ajax({            
    //         method: "POST",
    //         url: "bramkadoodswierzania.php",                        
    //         data: { chat_id: id, lastMsgId: lastMsgId },
    //     }).done(function(r){            
    //         $('.msg_history').html(r);
    //         var element = $(".msg_history");
    //         element.scrollTop(element.height());
    //         // append for solution with last id
    //         // $('.msg_history').append(r);
    //     }).fail(function(error){
    //         console.log(error);
    //     });

    // }

    // function reloadChat(event, id){
    //    timer = setInterval(function(){           
    //         funca(event, id)
    //     }, 1000)
    // }

    
    $('.leaveChat').click(function(){
        $('#msg_history').empty();
        $('#instuction').css("display", "block");
    });


    function getMessages(id){
        $.ajax({            
                method: "POST",
                url: "bramkadopobieraniawiadomosci.php",                        
                data: { chat_id: id },
            }).done(function(r){            
                $('.msg_history').html(r);
                var element = $(".msg_history");
                element.scrollTop(element.height());
                var lastMsgId = $("#lastMsg").data("msg-id");
                var chatId = $("#recived_msg").data("chatid");
                // reloadChat(chatId, lastMsgId);
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
            getMessages(id);   
          }).fail(function(error){
            console.log(error);
          });
    }
 
     $('.trans-btn').click(function(event){
         var id = $(this).data('chat-id');
         $('#invChatID').val(id);        
     });

    $('.convName').click(function(event){    
        clearInterval(timer);
        timer = 0;
        $('#msg').css("display", "block");
        $('#instuction').css("display", "none");
        var id = $(this).data('chat-id');
        message.attr("data-chatid", id);  
        timer = setInterval(function(){           
            getMessages(id)
        }, 1000)      
        // getMessages(id);    
    });    

    $('#sendMsg').click(function(event){        
        sendMsg();
    });

    message.keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            sendMsg();
        }
        event.stopPropagation();
    });
});