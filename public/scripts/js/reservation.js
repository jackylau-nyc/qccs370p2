    window.addEventListener('load', function (){
        reservations_generate();
    });

    function getData(){
    /*
    async function getData(){
        return await fetch('').then((response) => {
               return response.json();
         })
    }
    */
    
    // for display testing  only ....
        return [
                { res_id: '001001',username:'john', company : 'hoteel name 1', x_cord: [0], y_cord: [0] ,class :'cheap',price:[399],res_start:'2020-04-01',res_end:'2020-04-02'},
                { res_id: '101111',username:'david', company : 'hoteel naaaaaame 2', x_cord: [1], y_cord: [0] ,class :'deluxe',price:[699],res_start:'2020-05-01',res_end:'2020-05-06'},
                { res_id: '201222',username:'mike', company : 'hoteel nameaaaa 3', x_cord: [0], y_cord: [1] ,class :'suite',price:[999],res_start:'2020-05-11',res_end:'2020-05-22'},
            ]
    }

    async function reservations_generate(){

        var cont = document.getElementById('reservations');
        var result = await getData();

        result.forEach(function (result) {
            var res_div = document.createElement('div');
            res_div.className = 'col-sm-offset-1 col-sm-10 reservation-div';
            
            var res_id = document.createElement('h3');
            var username = document.createElement('h4');
            res_id.innerText = `Reservation Number : ${result.res_id}`;
            username.innerText = `${result.username}`;

            var left_div = document.createElement('div');
            left_div.className ='col-sm-6';
            var hotel_name = document.createElement('p');
            var hotel_cords = document.createElement('p');
            var room = document.createElement('p');
            hotel_name.innerText = `${result.company}`;
            hotel_cords.innerText = `Location : ${result.x_cord} street , ${result.y_cord} ave`;
            room.innerText = `Room Type : ${result.class}`;
            left_div.appendChild(hotel_name);
            left_div.appendChild(hotel_cords);
            left_div.appendChild(room);

            var right_div = document.createElement('div');
            right_div.className = 'col-sm-6';
            var check_in = document.createElement('p');
            var check_out = document.createElement('p');
            check_in.innerText = `Check In Date : ${result.res_start}`;
            check_out.innerText = `Check Out Date : ${result.res_end}`;
            right_div.appendChild(check_in);
            right_div.appendChild(check_out);

            var price_div = document.createElement('div');
            price_div.className = 'price';
            var price = document.createElement('p');
            price.innerText = `Price : $ ${result.price}`;
            price_div.appendChild(price);

            // Append all div in containter...
            res_div.appendChild(res_id);
            res_div.appendChild(username);
            res_div.appendChild(left_div);
            res_div.appendChild(right_div);
            res_div.appendChild(price_div);
            cont.appendChild(res_div);
        })
    }