
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
//search funtion for hobby filter option
$(document).ready(function captureTableRowClick() {
            $('tr').click(function () {
                var tableData = $(this).children('td').map(function returnTableDataText() {
                    return $(this).text();
                }).get();
                var props = $('thead > tr th');
                var array = [];
                props.each(function () { array.push($(this).text()) });
                //keys
                console.log(array);
                //values
                console.log(tableData);

                var obj = {};
                for (var i = 0; i < tableData.length; i++) {
                    obj[array[i]] = tableData[i];
                }
                console.log(obj);
            });

        });
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function openHobbyFilter() {
          document.getElementById("myDropdown").classList.toggle("show");
        }

        function filterFunction() {
          var input, filter, ul, li, a, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          div = document.getElementById("myDropdown");
          a = div.getElementsByTagName("a");
          for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
              a[i].style.display = "";
            } else {
              a[i].style.display = "none";
            }
          }
        }
