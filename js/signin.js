const form = document.querySelector(".signin form"),
  signinBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault(); //preventing form from submitting
};

signinBtn.onclick = () => {
  //Ajax starts
  let xhr = new XMLHttpRequest(); //Creating XML object
  xhr.open("POST", "php/signin.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        console.log(data);
        if (data == "success") {
          location.href = "user.php";
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  };
  let formData = new FormData(form); //creating new formData object
  xhr.send(formData); //sending form data to php through ajax
};
