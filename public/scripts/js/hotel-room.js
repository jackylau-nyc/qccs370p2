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
        document.getElementById("start").min = date;
        if(document.getElementById("start").value < date ||
          document.getElementById("start").value == "")
          document.getElementById("start").value = date;
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

function createRes(x, y, username, start, end, roomID) {

      var form = document.createElement("form");
      var element1 = document.createElement("input"); 
      var element2 = document.createElement("input");
      var element3 = document.createElement("input"); 
      var element4 = document.createElement("input"); 
      var element5 = document.createElement("input"); 
      var element6 = document.createElement("input");   

      form.method = "POST";
      form.action = "/reservation";   

      element1.value=username;
      element1.name="username";

      form.appendChild(element1);  

      element2.value=x;
      element2.name="x_cord";
      form.appendChild(element2);

      element3.value=y;
      element3.name="y_cord";
      form.appendChild(element3);

      element4.value=start;
      element4.name="startDate";
      form.appendChild(element4);

      element5.value=end;
      element5.name="endDate";
      form.appendChild(element5);

      element6.value=roomID;
      element6.name="room";
      form.appendChild(element6);

      element7.value="create-res";
      element7.name="action";
      form.appendChild(element7);

      document.body.appendChild(form);

      form.submit();

      console.log("Room Reserved");

  // return await fetch(`/reservations?username=${username}&x_cord=${x}&y_cord=${y}&room=${roomID}&startDate=${start}&endDate=${end}`, {

  // }).then((response) => {
  //   return response.json();
  // })
}

async function submitRes(roomID) {
  var params = getParams(window.location.href);
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var username = await fetch('customer?action=get-customer').then((response) => {
            return response.json();
        });
createRes(params.x, params.y, username, start, end, roomID);
}

async function getData(x, y, action){
    return await fetch(`/hotel?xcord=${x}&ycord=${y}&action=${action}`).then((response) => {
           return response.json();
     })
}

async function room_div_generate(filter){
    if(filter == "" || filter == null)
      filter = "rooms"
    var roommodal_container = document.getElementById('room-container');
    //reset
    var params = getParams(window.location.href);
    var result = await getData(params.x, params.y, filter);
    document.getElementById('hotel-name').innerText = params.franchise;
    document.getElementById('location').innerText = `Location: ${params.x} street, ${params.y} ave`;
    var roomlist = document.getElementById('roomlist');
    roomlist.innerText = "";
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

        roomlist.appendChild(col_div);
    })
}