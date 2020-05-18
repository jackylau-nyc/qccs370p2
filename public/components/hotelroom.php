<!-- side navbar for hotel -->
<div class="sidenav">
  <a href="./hotel.php">Hotel Homepage</a>
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

    <div>
      <h1 id="hotel1reservations">Hotel Name</h1>
      <div>
        
      </div>
    </div>
    
    <div id ="reserve">
      
    </div>

    <div id="hotel1reservations"></div>

</div>  

<!-- Scripts --> 
<script type="text/javascript">
function AdminLogin(){
    var admin_username = document.getElementById('admin-username').value;
    var admin_password = document.getElementById('admin-password').value;

    if( admin_username == "" || admin_password == "" ){
        document.getElementById('admin-err-msg').innerText = "Please fill in all fields"
    } else {
        $.ajax({
          method:"POST",
          url:"/admin-signin",
          processData: false,
          contentType: false,
          data : { username: admin_username , password: admin_password },
        })
        .done(function(){
           location.href = "./adminHome.php";
        })
        .fail(function(){
            document.getElementById('admin-err-msg').innerText = "Denied access."
        })
    }
}
</script>
