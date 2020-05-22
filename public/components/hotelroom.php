<!-- side navbar for hotel -->
<div class="sidenav">
  <a href="./roomlistings.php">Hotel Homepage</a>
  <a href="">Make a Reservation</a>
  <a href="./cancelReservation.php">Cancel My Reservation</a>
  <button  onclick="document.getElementById('admin-login').style.display='block'">Administrator Login</button>
</div>

<!-- Admin Login Modal -->
<div id="admin-login" class="w3-modal w3-animate-opacity fontstyle">
    <div class="w3-modal-content" style="padding:16px;">
      <div class="w3-container">
        <i onclick="document.getElementById('admin-login').style.display='none'" class="fa fa-remove w3-xlarge w3-button w3-transparent w3-right w3-large"></i>
        <h2>Login as administrator</h2>
        <h4>Please enter your username and password :</h4>
        <p style="color:red" id="admin-err-msg"></p>
        <div>
          <p><input class="w3-input w3-border" type="text" id="admin-username" placeholder="Enter Username" required></p>
          <p><input class="w3-input w3-border" type="password" id ="admin-password" placeholder="Enter Password" required></p>
          <button type="button" id="admin-login-btn" onclick="AdminLogin()">Login</button>
        </div>
      </div>
    </div>
</div>

<!-- Hotel Display Div -->
<div class="main">

    <div id="room-container">
      <h1 id="hotel-name"></h1>
      <h2 id="location"></h2>
      <div id="roomlist"></div>
    </div>
    
    <div id ="reserve">
      <label for="start">Start date:</label>
      <input type="date" id="start" name="trip-start" value="" min="">

      <label for="end">End date:</label>
      <input type="date" id="end" name="trip-end">

       <button id="searchButton" onclick="room_div_generate('avail-room-records')">Search for Rooms</button>
    </div>

</div>  

<!-- Scripts --> 
<script type="text/javascript" src="../scripts/js/admin-account.js"></script>
<script type="text/javascript" src="../scripts/js/hotel-room.js"></script>
