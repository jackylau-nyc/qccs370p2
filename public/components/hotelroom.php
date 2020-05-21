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
    </div>
    
    <div id ="reserve">
      <label for="start">Start date:</label>
      <input type="date" id="start" name="trip-start" min="" onChange="reserveMin()">

      <label for="start">End date:</label>
      <input type="date" id="end" name="trip-end">

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
}

window.addEventListener('load', function (){
  room_div_generate();
});

var reserveMin = function (){
    if (document.cookie.length > 0) {
        var str = document.cookie.split(";");
        var date;
        for(var i in str){
          if(str[i].includes("min_date=")){
            date = str[i].replace("min_date=","").trim()
            break;
          }
        }
        document.getElementById("start").value = date;
        document.getElementById("start").min = date;
    }
}

var getParams = function (url) {
  var params = {};
  var parser = document.createElement('a');
  parser.href = url;
  var query = parser.search.substring(1);
  var vars = query.split('&');
  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split('=');
    params[pair[0]] = decodeURIComponent(pair[1]);
  }
  return params;
};

async function getData(x, y, action){
    return await fetch(`/hotel?xcord=${x}&ycord=${y}&action=${action}`).then((response) => {
           return response.json();
     })
}


async function room_div_generate(){

    var roommodal_container = document.getElementById('room-container');
    var params = getParams(window.location.href);
    var result = await getData(params.x, params.y, "rooms");
    document.getElementById('hotel-name').innerText = params.franchise;
    document.getElementById('location').innerText = `Location: ${params.x} street, ${params.y} ave`;
    result.forEach(function (result) {
        var col_div = document.createElement('div');
        col_div.className = 'col-md-4';
        
        var room_div = document.createElement('div');
        room_div.classList.add("rooms");

        // Room number
        var roomnum = document.createElement('h3');
        roomnum.className = 'roomnum';
        roomnum.innerText = `${result.room_num}`;

        // Class of the room
        var roomclass = document.createElement('span');
        roomclass.className = 'roomclass';
        roomclass.innerText = `${result.class}`;

        // Price of room
        var price = document.createElement('span');
        price.className = 'price';
        price.innerText = " : $" + `${result.price}`;
        
        room_div.appendChild(roomnum);
        room_div.appendChild(roomclass);
        room_div.appendChild(price);

        // ( i , j ) locations
        var des = document.createElement('p');
        des.className = 'hotel-descript';
        // des.innerText = `Location : ${result.x_cord} street , ${result.y_cord} ave`;

        col_div.appendChild(room_div);
        room_div.appendChild(des);

        roommodal_container.appendChild(col_div);
    })
}
</script>
