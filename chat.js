function hideChatBox() {
      const chatbox_header = document.querySelector("#chatbox-header");
      const chatbox_body = document.querySelector("#chatbox-body");
      const chatbox_footer = document.querySelector("#chatbox-footer");
      chatbox_header.classList.remove('d-flex');
      chatbox_header.classList.add("myClass");
      chatbox_body.classList.remove('d-flex');
      chatbox_body.classList.add("myClass");
      chatbox_footer.classList.remove('d-flex');
      chatbox_footer.classList.add("myClass");
    }

function addClass() {
    document.getElementById("chatbox").classList.add("myClass");
  }

function fetchMessage(){
  var sender = $('#sender').val();
  var receiver = $('#receiver').val();

  $.ajax({
    url : "fetch_message.php",
    type: 'POST',
    data: {sender:sender , receiver:receiver},
    success: function(data){
      $('#chatbox-body-dispMsg').html(data);
      // scrollChatToBottom();
    }
  });
}

function scrollChatToBottom(){
  var chatbox = $('#chatbox-body-dispMsg');
  chatbox.scrollTop(chatbox.prop("scrollHeight"));
}

// window.onload = function() {
//   scrollChatToBottom();
// };

$(document).ready(function(){
  // fetch messages every 3 seconds
  
  $('#chat-form').submit(function(e){
    e.preventDefault();
    var sender = $("#sender").val();
    var receiver = $("#receiver").val();
    var message = $("#message").val();
    
    console.log("Sending message via AJAX");

    $.ajax({
      url : "submit_message.php",
      type: "POST",
      data: {sender:sender , receiver:receiver, message:message},
      success: function(data){
        $('#message').val('');
        fetchMessage(); // fetch message after sending
      },
      error: function(xhr, status, error) {
        console.error("AJAX error:", error);
      }
    });
  });
  
  setInterval(fetchMessage, 3000);
});