const searchBar = document.querySelector(".users .search input"),
  searchBtn = document.querySelector(".users .search button"),
  usersList = document.querySelector(".users .users-list");

searchBtn.onclick = () => {
  searchBar.classList.toggle("active");
  searchBar.focus();
  searchBtn.classList.toggle("active");
  searchBar.value = "";
};

searchBar.onkeyup = () => {
  let searchTerm = searchBar.value; //getting user search value
  if (searchTerm != "") {
    searchBar.classList.add("active");
  } else {
    searchBar.classList.remove("active");
  }
  //Ajax starts
  let xhr = new XMLHttpRequest(); //Creating XML object
  xhr.open("POST", "php/search.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  };
  xhr.onerror = () => {
    console.error("Request failed");
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm); //sending user search term with ajax
};

setInterval(() => {
  //Ajax starts
  let xhr = new XMLHttpRequest(); //Creating XML object
  xhr.open("GET", "php/user.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (!searchBar.classList.contains("active")) {
          //if search bar is not active then add this data
          usersList.innerHTML = data;
        }
      }
    }
  };
  xhr.onerror = () => {
    console.error("Request failed");
  };
  xhr.send();
}, 500); //this function will run frequently after 500ms
