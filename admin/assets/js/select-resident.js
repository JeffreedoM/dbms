const rows = document.querySelectorAll("tr");
const barangayNameInput = document.querySelector("#barangay_name");
const barangayIdInput = document.querySelector("#barangay_id");

rows.forEach((row) => {
  row.addEventListener("click", () => {
    // get the id of the clicked barangay
    const barangayId = row.getAttribute("id");
    // putting the id in the hidden input
    barangayIdInput.value = barangayId;

    // getting the right barangay name of the clicked barangay
    const barangay_name = document.querySelector(
      `#${CSS.escape(barangayId)} td:nth-child(2)`
    ).textContent;
    // putting the barangay name in the input name
    barangayNameInput.value = barangay_name;
  });
});
