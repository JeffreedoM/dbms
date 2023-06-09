const scrollToTopButton = document.querySelector(".scroll-to-top");

// Show the button when scrolling down the page
window.addEventListener("scroll", () => {
  if (window.pageYOffset > 200) {
    scrollToTopButton.classList.add("show");
  } else {
    scrollToTopButton.classList.remove("show");
  }
});

// Scroll to top when the button is clicked
scrollToTopButton.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});
