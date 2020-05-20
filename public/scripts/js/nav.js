/*
    function searchFilter() {
      document.getElementById("searchFilter").classList.toggle("show");
    }

    window.onclick = function(e) {
      if (!document.getElementById('searchFilter').contains(e)) {
      var myDropdown = document.getElementById("searchFilter");
        if (myDropdown.classList.contains('show')) {
          myDropdown.classList.remove('show');
        }
      }
    }
*/
function Signin(){

    var login_username = document.getElementById('username').value;
    var login_password = document.getElementById('password').value;

    if( login_username == "" || login_password == "" ){
      document.getElementById('err-msg').innerText = "Please fill in all fields"
    } 
    else {
      $.ajax({
        method:"POST",
        url:"/signin",
        data:{username: login_username,password: login_password},
        })
        .done(function(response){
          if (response.includes("Success")){
            location.href = "../../reservation.php";
          }
          else{
            // Replace later 
            alert(response);
          }
        })
        .fail(function(response){
          $('#err-msg').text("Invalid username or password . Please try again");
        })
    }
}

$("#currentDate").change(function(){
  // var $x = $("calendar");
  // $x.prop("color", "FF0000");
  // $x.append("The color property: " + $x.prop("color"));
  // $x.removeProp("color");
  var dee = $("#currentDate").val()
  document.cookie = document.cookie + "; path=/; mindate=" + dee + "; expires="
  console.log(dee);
  var tomorrow = new Date();
// tomorrow.setDate(dee + 1);
//   $('#calendar').fullCalendar('gotoDate',new Date('2020-05-05'));
// });

        document.getElementById("signup-btn").onclick = function () {
            location.href = "../../signUp.php";
        };   

        document.getElementById("logout-btn").onclick = function () {
          location.href = "./index.php";
        };


  /*
      var currentDate;
      function setDate(val) {
          currentDate = val;
      }
  */