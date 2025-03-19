function renderChatHeader(element){
  const name = element.querySelector('.username').innerText;
  const imgUrl = element.querySelector("img").src;
  const chatFooterWhole = document.querySelector(".chatbox-footer");

  const chatHeader = `
  <div class="d-flex justify-content-between align-items-center w-100 gap-2 p-2 bg-accent">
    <div class="d-flex align-items-center gap-3">
      <img src="${imgUrl}" class="rounded-circle" style="height:50px; width=50px" alt="profile" >
      <div>
        <p class="m-0 fw-bold">${name}</p>
        <span class="text-success small">●</span><span class="small">online</span>
      </div>
    </div>
    <div class="pe-2 border border-2">
      <i class="fa-solid fa-ellipsis-vertical"></i>
    </div>
  </div>
  `

  const chatFooter = `
  <div class="d-flex justify-content-center align-items-center h-100 pe-3">
    <i class="fa-solid fa-paperclip fa-xl "></i>
  </div>
  <input type="text"
                 class="form-control bg-accent pe-5"
                 placeholder="Type a message"
                 aria-label="Type a message">
  <button class="send-button btn bg-accent rounded-3 p-0 m-0 position-absolute">
    <i class="fa-solid fa-paper-plane fa-xl"></i>
  </button>
  `
  document.getElementById("chatbox-header").innerHTML = chatHeader;
  document.getElementById("message-input").innerHTML = chatFooter;
  chatFooterWhole.style.backgroundColor = "#DBDCFE";

}

// function getRandomIntInclusive(min, max) {
//   min = Math.ceil(min);
//   max = Math.floor(max);
//   return Math.floor(Math.random() * (max - min + 1) + min);
// }

// async function loadUsers() {
//     const response = await fetch('../php/get_user.php');
//     const users = await response.json();
//     const userList = document.getElementById('user-list'); // Add this ID in HTML

//     userList.innerHTML = '';

//     users.forEach(user => {
//         const userDiv = document.createElement('div');
//         userDiv.className = 'd-flex align-items-center gap-3 p-2 bg-light mb-2 rounded shadow-sm user-card';
//         userDiv.setAttribute('onclick', 'renderChatHeader(this)');

//         userDiv.innerHTML = `
//             <img src="../Assets/${getRandomIntInclusive(1,6)}.png" 
//                  class="rounded-circle" style="height:50px; width:50px;" alt="profile" >
//             <div>
//                 <p class="m-0 fw-bold username">${user.username}</p>
//                 <span class="text-success small">●</span><span class="small">online</span>
//             </div>
//         `;
//         userList.appendChild(userDiv);
//     });
// }

// window.onload = loadUsers;
