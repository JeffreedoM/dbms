function populateSchoolDropdown() {
  const barangayDropdown = document.getElementById("barangayDropdown");
  const schoolDropdown = document.getElementById("schoolDropdown");
  const selectedBarangay = barangayDropdown.value;

  // Clear the school dropdown
  schoolDropdown.innerHTML = '<option value="">Select School</option>';

  if (selectedBarangay) {
    // Make an AJAX request to fetch the school options for the selected barangay
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);

        // Add school options for the selected barangay
        response.forEach(function (school) {
          const option = document.createElement("option");
          option.text = school;
          option.value = school;
          schoolDropdown.add(option);
        });
      }
    };

    // Send the request to the PHP endpoint to get the school options
    xhr.open(
      "GET",
      "includes/get_schools.php?barangay=" + selectedBarangay,
      true
    );
    xhr.send();
  }
}
