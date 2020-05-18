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

    <div id="room-container">
      <h1>Hotel Name</h1>
      <div id ="rooms">

        <h3>Room Type<h3>
          <h5>Price<h5>
      </div>
    </div>
    
    <div id ="reserve">
      <label for="start">Start date:</label>

      <input type="date" id="start" name="trip-start"
       value=""
       min="" max="">

      <label for="start">End date:</label>
      <input type="date" id="start" name="trip-end"
       value="">

       <button id="searchButton">Search for Rooms</button>
    </div>

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

    window.addEventListener('load', function (){
    hotel_div_generate();
});



async function getData(){
    return await fetch('/hotel').then((response) => {
           return response.json();
     })
}


async function room_div_generate(){

    var roommodal_container = document.getElementById('id');
    var result = await getData();  

    result.forEach(function (result) {
        var col_div = document.createElement('div');
        col_div.className = 'col-md-4';
        
        var hotel_div = document.createElement('div');
        hotel_div.classList.add("room-div");

        var title = document.createElement('h1');
        var roomclass = document.createElement('span');
        roomclass.className = 'class';
        var hotel = document.createElement('span');
        price.className = 'price';

        // franchise name and hotel name 
        roomclass.innerText = `${result.company}`;
        price.innerText = `${result.company}`;
    
        title.appendChild(roomclass);
        title.appendChild(price);

        // ( i , j ) locations
        var des = document.createElement('p');
        des.className = 'hotel-descript';
        des.innerText = `Location : ${result.x_cord} street , ${result.y_cord} ave`;
    
        // Visit Us button 
        var btn_padding = document.createElement('div');
        btn_padding.className ='button-padding';
        var btn = document.createElement('a');
        btn.className ="button button-text";
        btn.href = "./hotel.php"
        btn.innerHTML ="Visit Us";
        btn_padding.appendChild(btn);

        col_div.appendChild(hotel_div);
        hotel_div.appendChild(title);
        hotel_div.appendChild(des);
        hotel_div.appendChild(btn_padding);

        hotelmodal_container.appendChild(col_div);
    })
}
}
</script>
