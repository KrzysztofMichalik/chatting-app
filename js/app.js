$( document ).ready(function() {
    $('.trans-btn').click(function(event){
        var id = $(this).data('chat-id');
        $('#invChatID').val(id);        
    });

    $('.convName').click(function(event){
        var id = $(this).data('chat-id');
        $('#sendMsg').val(id)
        $.ajax({            
            method: "POST",
            url: "bramkadopobieraniawiadomosci.php",                        
            data: { chat_id: id },
        }).done(function(r){            
            $('.msg_history').html(r);
        }).fail(function(error){
            console.log(error);
        });

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