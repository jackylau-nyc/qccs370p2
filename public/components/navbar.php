  <div class="navbar navfont">
    <a href="#home"><input id="currentDate" type="date" value="" onChange="setDate(this.value);reserveMin();"/></a>
    <a class ="loginbtn" href ="./index.php">Home</a>
    <!-- Search Engine -->
    <a class ="loginbtn" href ="../search.php"> Search</a>
    <a class ="loginbtn" href ="./cust-reservation">Reservation</a>

  <!--Signup Page and Login Modal-->
  <?php (isset($_SESSION["username"])) ?  include __DIR__."/signed-cust-nav.php" : include __DIR__."/cust-nav.php" ;?>


  </div>