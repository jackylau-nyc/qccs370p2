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
    room_div_generate();
});



async function getData(){
    return await fetch('/hotel').then((response) => {
           // console.log(response.json());
           // return response.json();
           return [{
            "room_num": "1",
            "class": "Deluxe",
            "price": "999.00"
          },
          {
            "room_num": "2",
            "class": "Deluxe",
            "price": "999.00"
          },
          {
            "room_num": "3",
            "class": "Deluxe",
            "price": "999.00"
          }]
     })
}


async function room_div_generate(){

    var roommodal_container = document.getElementById('room-container');
    var result = await getData();  

    result.forEach(function (result) {
        var col_div = document.createElement('div');
        col_div.className = 'col-md-4';
        
        var room_div = document.createElement('div');
        room_div.classList.add("room-div");

        var roomnum = document.createElement('h1');
        var roomclass = document.createElement('span');
        roomclass.className = 'roomclass';
        var price = document.createElement('span');
        price.className = 'price';

        // franchise name and hotel name 
        roomnum.innerText = `${result.room_num}`;
        roomclass.innerText = `${result.class}`;
        price.innerText = `${result.price}`;
    
        roomnum.appendChild(roomclass);
        roomnum.appendChild(price);

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

        col_div.appendChild(room_div);
        room_div.appendChild(roomnum);
        room_div.appendChild(des);
        room_div.appendChild(btn_padding);

        roommodal_container.appendChild(col_div);
    })
}
}
</script>
