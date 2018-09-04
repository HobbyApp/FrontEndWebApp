
//opens createNewEventForm
function newEvent() {
    var x = document.getElementById("createNewEventForm");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
          x.style.display = "none";
        }
  }
