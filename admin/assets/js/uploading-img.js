/* Uploading Profile Image */
//declearing html elements

const imgDiv = document.querySelector(".profile-pic-div");
const img = document.querySelector("#photo");
const file = document.querySelector("#file");
const uploadBtn = document.querySelector("#uploadBtn");

//if user hover on img div

imgDiv.addEventListener("mouseenter", function () {
  uploadBtn.style.display = "block";
});

//if we hover out from img div

imgDiv.addEventListener("mouseleave", function () {
  uploadBtn.style.display = "none";
});

//lets work for image showing functionality when we choose an image to upload

//when we choose a foto to upload

file.addEventListener("change", function () {
  // this refers to file
  const choosedFile = this.files[0];

  if (choosedFile) {
    if (choosedFile.type.startsWith("image/")) {
      const reader = new FileReader(); // FileReader is a predefined function of JS

      reader.addEventListener("load", function () {
        img.setAttribute("src", reader.result);
      });

      reader.readAsDataURL(choosedFile);
    } else {
      alert("Please choose a valid image file!");
      file.value = ""; // Reset the input file element to allow re-selection of file
    }
  }
});

const fileInput = document.getElementById("file");
const submitButton = document.getElementById("submitButton");
const message = document.getElementById("message");

fileInput.addEventListener("onchange", () => {
  submitButton.addEventListener("click", function (event) {
    if (!fileInput.value) {
      event.preventDefault(); //prevent form submission
      alert("Please choose a Profile Image.");
      alert(fileInput.value);
    }
  });
});
