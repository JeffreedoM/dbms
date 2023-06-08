//Hide alert after 5 seconds
let alertElement = document.querySelector(".alert");
alertElement.style.display = "block";

setTimeout(function () {
  alertElement.style.display = "none";
}, 5000);
