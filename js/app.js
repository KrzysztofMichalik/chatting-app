$( document ).ready(function() {
    $('.trans-btn').click(function(event){
        var id = $(this).data('chat-id');
        $('#invChatID').val(id);

        // event.preventDefault();
        // var id = $(this).data('chat-id');
        // console.log(typeof(id));
        // var id = id.toString();
        // var id = JSON.stringify(id);
        // console.log(id);
        // $.ajax({            
        //     type: "POST",
        //     url: "chat.php",                        
        //     data: { chat_id: id },
        // }).done(function(r){
            
        //     console.log(r)
        //   }).fail(function(error){
        //     console.log(error);
        //   });
        
    });
});