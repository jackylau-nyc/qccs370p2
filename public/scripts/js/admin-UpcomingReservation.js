
async function getData(){
    var company = "Howard Resorts";
    var date = "2019-09-01";
    var data = {
        action: "get-upcoming-res",
        company: company, 
        date: date,
    };
    var url = `/admin?action=${data.action}&company=${data.company}&date=${data.date}`;
    return await fetch(url).then((response) => {
        var sol = response.json();
        console.log(sol);
        return sol;
  });

}


async function allReservations(){
      
    document.getElementById('admin-view').innerHTML = "";
    var date = document.getElementById('myDate').Value;

    var cont = document.getElementById('admin-view');
    var result = await getData();
    
    if (result.includes("No")){
        alert("This company has no upccoming reservations");
        throw new FatalError("Something went badly wrong!");
    }

      result.forEach(function (result) {
      var res_div = document.createElement('div');
      res_div.className ='row';
      var res_id = document.createElement('h3');
      res_id.innerText = `Reservation Number : ${result.reservation_id}`;

      var left_div = document.createElement('div');
      left_div.className ='col-sm-3';
      var hotel_name = document.createElement('p');
      var hotel_cords = document.createElement('p');
      var roomtype = document.createElement('p');
      hotel_name.innerText = `${result.company}`;
      hotel_cords.innerText = `Location : ${result.x_cord} street , ${result.y_cord} ave`;
      roomtype.innerText = `Room Type : ${result.class}`;
      left_div.appendChild(hotel_name);
      left_div.appendChild(hotel_cords);
      left_div.appendChild(roomtype);

      var mid_div = document.createElement('div');
      mid_div.className = 'col-sm-3';
      var check_in = document.createElement('p');
      var check_out = document.createElement('p');
      check_in.innerText = `Check In Date : ${result.res_start}`;
      check_out.innerText = `Check Out Date : ${result.res_end}`;
      mid_div.appendChild(check_in);
      mid_div.appendChild(check_out);


      var right_div = document.createElement('div');
      right_div.className = 'col-sm-3';
      var username = document.createElement('p');
      var price = document.createElement('p');
      username.innerText = `Customer : ${result.customer_username}`;
      price.innerText = `Price : $${result.price}`;
      right_div.appendChild(username);
      right_div.appendChild(price);
    
      // Append all div in containter...
      res_div.appendChild(res_id);
      res_div.appendChild(left_div);
      res_div.appendChild(mid_div);
      res_div.appendChild(right_div);
      cont.appendChild(res_div);
  })
  }
