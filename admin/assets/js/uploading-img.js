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

/* Uploading defects */
const dropArea = document.getElementById("dropArea");
const imageUpload = document.getElementById("imageUpload");
const previewContainer = document.getElementById("previewContainer");

// Prevent the default behavior for dragover and drop events
dropArea.addEventListener("dragover", function (event) {
  event.preventDefault();
});

dropArea.addEventListener("drop", function (event) {
  event.preventDefault();

  const files = event.dataTransfer.files;
  handleFiles(files);
});

imageUpload.addEventListener("change", function () {
  const files = Array.from(this.files);
  handleFiles(files);
});

function handleFiles(files) {
  previewContainer.innerHTML = ""; // Clear previous previews

  Array.from(files).forEach(function (file) {
    const reader = new FileReader();

    reader.onload = function (event) {
      const imageUrl = event.target.result;
      const previewImage = document.createElement("img");
      previewImage.classList.add("previewImage");
      previewImage.src = imageUrl;
      previewContainer.appendChild(previewImage);
    };

    reader.readAsDataURL(file);
  });
}

// Form validation
// const schoolNameInput = document.getElementById('school_name');
// const submitButton = document.getElementById('submitButton');

submitButton.addEventListener("click", function (event) {
  if (!schoolNameInput.value) {
    event.preventDefault();
    alert("Please select school name.");
  }
});
