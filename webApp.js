
//opens createNewEventForm
function newEvent() {
    var x = document.getElementById("createNewEventForm");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
          x.style.display = "none";
        }
  }

//opens filterForm onClick
function openFilter() {
  var y = document.getElementById("filterForm");
   if (y.style.display === "none") {
     y.style.display = "block";
   } else {
     y.style.display = "none";
   }
}

        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function openHobbyFilter() {
          document.getElementById("myDropdown").classList.toggle("show");
        }
//search funtion for hobby filter option
        function filterFunction() {
          var input, filter, ul, li, a, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          div = document.getElementById("myDropdown");
          a = div.getElementsByTagName("a");
          for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
              a[i].style.display = "show";
            } else {
              a[i].style.display = "none";
            }
          }
        }
