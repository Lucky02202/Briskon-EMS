$(document).ready(function () {
  var chatLinks = document.getElementsByClassName("chat-link");
  hideChatBox();

  Array.from(chatLinks).forEach(function (element) {
    element.addEventListener("click", function (e) {
      e.preventDefault();
      showChatBox();
      var user_id = this.getAttribute('data-user_id'); // Get selected user's ID
      var username = this.getAttribute('data-username'); // Get selected user's name
      var url = "?user_id=" + user_id + "&username=" + encodeURIComponent(username);
      history.pushState(null, null, url); // Update URL without refreshing
      $("#selected-username").text(username); // Update username on chat header
      $("#receiver").val(user_id); // Update hidden input for selected user ID
      fetchLastSeen(user_id)
      fetchMessage(); // Fetch messages dynamically
    });
  });

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

function showChatBox() {
  const chatbox_header = document.querySelector("#chatbox-header");
  const chatbox_body = document.querySelector("#chatbox-body");
  const chatbox_footer = document.querySelector("#chatbox-footer");
  chatbox_header.classList.remove('myClass');
  chatbox_header.classList.add("d-flex");
  chatbox_body.classList.remove('myClass');
  chatbox_body.classList.add("d-flex");
  chatbox_footer.classList.remove('myClass');
  chatbox_footer.classList.add("d-flex");
}

// scroll chat to bottom code
function scrollChatToBottom() {
  var chatbox = $('#chatbox-body-dispMsg');
  chatbox.scrollTop(chatbox.prop("scrollHeight"));
}

// fetch message code
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

function fetchLastSeen(user_id) {
  let selected_userid = user_id;
  $.ajax({
    url: "./fetch_last_seen.php",
    type: 'POST',
    data: { selected_userid: user_id },
    success: function (data) {
      $('#onlinestatus').html(data);
      console.log(data);

    }
  })
}