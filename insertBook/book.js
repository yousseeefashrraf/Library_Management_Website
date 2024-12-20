let selectedGenres = []

function selectButton(button){
      var currentColor = window.getComputedStyle(button).backgroundColor;
      
      // Check if the background color is blue or not
      if (currentColor === "rgb(217, 217, 217)") { // This is the RGB value for blue
        button.style.backgroundColor = "rgb(245, 236, 236)"; // Change to red
        selectedGenres.push(button.value);
        console.log(selectedGenres);
      } else {
        button.style.backgroundColor = "#d9d9d9";
        selectedGenres.splice(selectedGenres.indexOf(button.value), 1); // Change to blue
      }
      document.getElementById("selectedGenres").value = selectedGenres.join(",");
}

function checkValidation(event) {
    event.preventDefault();

    if (!selectedGenres || selectedGenres.length < 3) {
        alert("Please select at least 3 genres.");
        return false; 
    }

    document.getElementById("Formconatiner").submit();
    document.getElementById("Formconatiner").reset();

}
