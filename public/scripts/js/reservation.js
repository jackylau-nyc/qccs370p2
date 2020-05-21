    window.addEventListener('load', function (){
        reservations_generate();
    });

    async function getData(){
        var username = await fetch('customer?action=get-customer').then((response) => {
            return response.json();
        });
        var defaultDate = '2010-10-10';
        var data = { 
            "action": "get-reservations", 
            "customer": username, 
            "date": defaultDate
        };
        var url = `customer?date=${data.date}&action=${data.action}&username=${data.customer}`;
        console.log(url);
        return await fetch(url).then((response) => {
            return response.json();
        });
    }

    async function reservations_generate(){

        var cont = document.getElementById('reservations');
        var result = await getData();
        console.log(result);
        if(result == false){
            return false; 
        }
        result.forEach(function (result) {
            var res_div = document.createElement('div');
            res_div.className = 'col-sm-offset-1 col-sm-10 reservation-div';
            
            var res_id = document.createElement('h3');
            var username = document.createElement('h4');
            res_id.innerText = `Reservation Number : ${result.resID}`;
            username.innerText = `${result.username}`;

            var left_div = document.createElement('div');
            left_div.className ='col-sm-6';
            var hotel_name = document.createElement('p');
            var hotel_cords = document.createElement('p');
            var room = document.createElement('p');
            hotel_name.innerText = `${result.company}`;
            hotel_cords.innerText = `Location : ${result.location}`;
            room.innerText = `Room Type : ${result.class}`;
            left_div.appendChild(hotel_name);
            left_div.appendChild(hotel_cords);
            left_div.appendChild(room);

            var right_div = document.createElement('div');
            right_div.className = 'col-sm-6';
            var check_in = document.createElement('p');
            var check_out = document.createElement('p');
            check_in.innerText = `Check In Date : ${result.startDate}`;
            check_out.innerText = `Check Out Date : ${result.endDate}`;
            right_div.appendChild(check_in);
            right_div.appendChild(check_out);

            // var price_div = document.createElement('div');
            // price_div.className = 'price';
            // var price = document.createElement('p');
            // price.innerText = `Price : $ ${result.price}`;
            // price_div.appendChild(price);

            // Append all div in containter...
            res_div.appendChild(res_id);
            res_div.appendChild(username);
            res_div.appendChild(left_div);
            res_div.appendChild(right_div);
         //   res_div.appendChild(price_div);
            cont.appendChild(res_div);
        });
    }
