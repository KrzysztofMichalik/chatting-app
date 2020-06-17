$( document ).ready(function() {
    $('.trans-btn').click(function(event){
        
        var id = $(this).data('chat-id');
        console.log(typeof(id));
        var id = id.toString();
        $.ajax({            
            type: "GET",
            url: "chat.php",                        
            data: { chat_id: id },
            success: function( result){
                console.log(result);
            }
        });
        event.preventDefault();
    });
});