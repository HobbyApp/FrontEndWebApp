/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function showDistanceOptions() {
    document.getElementById("filterDistance").classList.toggle("show");
}
// Separate functions to show individual contents. If you can Find
// a better way to do this then please consolidate the code.
function showOwnerOptions() {
    document.getElementById("filterMyEvents").classList.toggle("show");
}

// This one is for the Hobbies dropdown with a search bar
function showHobbies() {
  document.getElementById("filterHobbies").classList.toggle("show");
}
//Opens new event form
function newEvent() {
  var x = document.getElementById("createNewEventForm");
      if (x.style.display === "none") {
          x.style.display = "block";
      } else {
          x.style.display = "none";
      }


}



// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
// A "filter" should appear upon button click allowing the user to select filters
function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("filterHobbyInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("filterHobbies");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
