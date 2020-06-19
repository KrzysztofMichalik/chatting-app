$( document ).ready(function() {

    var funca = function(event, id){
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
    
    function reloadChat(event, id){
        setInterval(function(){
            funca(event, id)
        }, 1000)
    }

    $('.convName').click(function(event){
        $('#msg').css("display", "block");
        $('#sendMsg').val(id);

        var id = $(this).data('chat-id');

        reloadChat(event, id);
                
    });

    $('.trans-btn').click(function(event){
        var id = $(this).data('chat-id');
        $('#invChatID').val(id);        
    });

    $('#sendMsg').click(function(event){
        console.log('click');
        var msg = $('#msg').val();
        var id = $(this).val();
        console.log(id); 
        $.ajax({            
            method: "POST",
            url: "bramkadowysylaniawiadomosci.php",                        
            data: { chat_id: id,
                    message: msg,
            },
        }).done(function(r){
            
            $('.msg_history').html(r); 
          }).fail(function(error){
            console.log(error);
          });
    });
});