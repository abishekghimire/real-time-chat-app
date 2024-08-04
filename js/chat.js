const form = document.querySelector(".typing-area"),
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
  e.preventDefault(); //preventing form from submitting
};

sendBtn.onclick = () => {
  //Ajax starts
  let xhr = new XMLHttpRequest(); //Creating XML object
  xhr.open("POST", "php/insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = ""; //once message is inserted into database leave the message typing field empty
        window.onload = scrollToBottom();
      }
    }
  };
  let formData = new FormData(form); //creating new formData object
  xhr.send(formData); //sending form data to php through ajax
};

setInterval(() => {
  //Ajax starts
  let xhr = new XMLHttpRequest(); //Creating XML object
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        window.onload = scrollToBottom();
      }
    }
  };
  xhr.onerror = () => {
    console.error("Request failed");
  };
  let formData = new FormData(form); //creating new formData object
  xhr.send(formData); //sending form data to php through ajax
}, 500); //this function will run frequently after 500ms

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
