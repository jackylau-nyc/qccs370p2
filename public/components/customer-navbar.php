<div class="navbar navfont">
    <!-- Logout Page -->
    <button class="loginbtn pull-right" onclick="document.getElementById('logout').style.display='block'">Log out</button>
  </div>

  <!-- Log Out Pop Up Modal -->
  <div id="logout" class="w3-modal w3-animate-opacity navfont">
    <div class="w3-modal-content" style="padding:16px">
      <div class="w3-container">
        <i onclick="document.getElementById('logout').style.display='none'" class="fa fa-remove w3-xlarge w3-button w3-transparent w3-right w3-large"></i>
        <h2 class="w3-wide navfont">Log Out</h2>
        <h4>Are you sure that you want to Log out ?</h4>
        <br>
        <button id = "logout-btn" class="navButton">Log Out</button>
        <button class="navButton" onclick="document.getElementById('logout').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>

  <!-- Bootstrap Dependencies-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script>

        document.getElementById("logout-btn").onclick = function () {
            location.href = "./index.php";
        };

  </script>