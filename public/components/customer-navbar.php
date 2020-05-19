<div class="navbar navfont">
    <a href="#home"><input id="currentDate" type="date" value="" onChange="setDate(this.value);"/></a>
    <a class ="loginbtn" href ="./index.php">Home</a>
    <!-- Search Engine -->
    <a class ="loginbtn" href ="../search.php"> Search</a>
    <!-- Logout Page -->
    <button class="logoutbtn pull-right" onclick="document.getElementById('logout').style.display='block'">Log out</button>
  </div>

  <!-- Log Out Pop Up Modal -->
  <div id="logout" class="w3-modal w3-animate-opacity navfont">
    <div class="w3-modal-content" style="padding:16px">
      <div class="w3-container">
        <i onclick="document.getElementById('logout').style.display='none'" class="fa fa-remove w3-xlarge w3-button w3-transparent w3-right w3-large"></i>
        <h2 class="w3-wide navfont">Log Out</h2>
        <h4>Are you sure that you want to Log out ?</h4>
        <br>
        <form method="post" action="">
          <button id = "logout-btn" class="navButton" name="logout_button">Log Out</button>
        </form>
        <button class="navButton" onclick="document.getElementById('logout').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
