const rows = document.querySelectorAll("tr");
const schoolNameInput = document.querySelector("#school_name");
const schoolIdInput = document.querySelector("#school_id");

rows.forEach((row) => {
  row.addEventListener("click", () => {
    // get the id of the clicked school
    const schoolId = row.getAttribute("id");
    // putting the id in the hidden input
    schoolIdInput.value = schoolId;

    // getting the right school name of the clicked school
    const school_name = document.querySelector(
      `#${CSS.escape(schoolId)} td:nth-child(2)`
    ).textContent;
    // putting the school name in the input name
    schoolNameInput.value = school_name;
  });
});
