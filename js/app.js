$( document ).ready(function() {
    var message = $('#msgText'); 

    $('.trans-btn').click(function(event){
        var id = $(this).data('chat-id');
        $('#invChatID').val(id);        
    });

    var funca = function(event, id){
        $.ajax({            
            method: "POST",
            url: "bramkadopobieraniawiadomosci.php",                        
            data: { chat_id: id,
                    reload: true
            },
        }).done(function(r){            
            console.log('refresh');
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
                console.log('refresh');
                $('.msg_history').html(r);
            }).fail(function(error){
                console.log(error);
            });
    }
 
    $('.convName').click(function(event){
        $('#msg').css("display", "block");
        var id = $(this).data('chat-id');
        message.attr("data-chatid", id);
        
        getMessages(event, id);
        
        var lastMsg = $('#lastMsg').data('lastMsg');
        console.log(lastMsg)
        
        reloadChat(event, id);
                
    });


    $('#sendMsg').click(function(event){        
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
    });

    message.keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
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
        //Stop the event from propogation to other handlers
        //If this line will be removed, then keypress event handler attached 
        //at document level will also be triggered
        event.stopPropagation();
    });
});