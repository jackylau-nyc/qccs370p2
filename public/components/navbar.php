  <div class="navbar navfont">
    <a href="#home"><input id="currentDate" type="date" value="" onChange="setDate(this.value);"/></a>
    <a class ="loginbtn" href ="./index.php">Home</a>
    <!-- Search Engine -->
    <a class ="loginbtn" href ="../search.php"> Search</a>
    <!--Signup Page -->
    <a class ="loginbtn pull-right" href ="./signUp.php">Sign Up</a>
    <button class="loginbtn pull-right" onclick="document.getElementById('login').style.display='block'">Login</button>
  </div>

  <!-- Login Pop Up Modal -->
  <div id="login" class="w3-modal w3-animate-opacity navfont">
    <div class="w3-modal-content" style="padding:16px;">
      <div class="w3-container">
        <i onclick="document.getElementById('login').style.display='none'" class="fa fa-remove w3-xlarge w3-button w3-transparent w3-right w3-large"></i>
        <h2 class="w3-wide navfont">Login</h2>
        <h4>Login with your username and password :</h4>
        <p style="color:red" id="err-msg"></p>
        <div>
          <p><input class="w3-input w3-border" type="text" id="username" placeholder="Enter Username" required></p>
          <p><input class="w3-input w3-border" type="password" id ="password" placeholder="Enter Password" required></p>
          <button type="button" class="navButton" id="login-btn" onclick="Signin()">Login</button> <button class="navButton" id="signup-btn">No account ? Sign up!</button>
        </div>
      </div>
    </div>
  </div>
<script>
  window.onload(() => {keepMin()});
</script>