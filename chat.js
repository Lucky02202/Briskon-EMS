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

// function addClass() {
//   document.getElementById("chatbox").classList.add("myClass");
// }

function fetchMessage(callback = null) {
  var sender = $('#sender').val();
  var receiver = $('#receiver').val();

  $.ajax({
    url: "fetch_message.php",
    type: 'POST',
    data: { sender: sender, receiver: receiver },
    success: function (data) {
      $('#chatbox-body-dispMsg').html(data);
      if (typeof callback === "function") {
        callback();   // Only scroll if callback is passed
      }
    }
  });
}

function scrollChatToBottom() {
  var chatbox = $('#chatbox-body-dispMsg');
  chatbox.scrollTop(chatbox.prop("scrollHeight"));
}

$(document).ready(function () {


  // var chatLinks = document.getElementsByClassName("chat-link");
  // Array.from(chatLinks).forEach(function (element) {
  //   element.addEventListener("click", function (e) {
  //     e.preventDefault();
  //     var url = this.getAttribute('href');
  //     history.pushState(null, null, url);
  //   });
  // });

  // fetch messages every 3 seconds
  fetchMessage(scrollChatToBottom);

  $('#chat-form').submit(function (e) {
    e.preventDefault();
    var sender = $("#sender").val();
    var receiver = $("#receiver").val();
    var message = $("#message").val().trim();

    if (message === '') {
      alert("Cannot send empty messages or spaces.")
      return;
    }

    console.log("Sending message via AJAX");
    $.ajax({
      url: "submit_message.php",
      type: "POST",
      data: { sender: sender, receiver: receiver, message: message },
      success: function (data) {
        $('#message').val('');
        fetchMessage();
        scrollChatToBottom();
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
      }
    });
  });

  setInterval(() => {
    fetchMessage();
    fetch('update_last_seen.php');
  }, 3000);

});