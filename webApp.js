
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
