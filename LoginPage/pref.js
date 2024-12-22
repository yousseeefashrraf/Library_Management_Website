let selectedGenres = []
let userAv = "";
let previousSelection = null;


function sl(event){
    if(previousSelection!=null){
        previousSelection.style.transform = 'scale(1)';
    }
    event.style.transform = 'scale(1.4)';
    userAv = event.src;
    previousSelection = event;
    document.getElementById("selectAvatar").value = ".."+userAv.slice(48);
    console.log(".."+userAv.slice(48));
}
function selectButton(button){
      var currentColor = window.getComputedStyle(button).backgroundColor;
      
      // Check if the background color is blue or not
      if (currentColor === "rgb(217, 217, 217)") { // This is the RGB value for blue
        button.style.backgroundColor = "rgb(200, 230, 245)"; // Change to red
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
