window.addEventListener('load', function (){
    hotel_div_generate();
});

async function getData(){
    return await fetch('/map').then((response) => {
           return response.json();
     })
}


async function hotel_div_generate(){

    var hotelmodal_container = document.getElementById('id');
    var result = await getData();

    result.forEach(function (result) {
        var col_div = document.createElement('div');
        col_div.className = 'col-md-4';
        
        var hotel_div = document.createElement('div');
        hotel_div.classList.add("hotel-div");

        var title = document.createElement('h1');
        var franchise = document.createElement('span');
        franchise.className = 'franchise';
        var hotel = document.createElement('span');
        hotel.className = 'hotel-name';

        // franchise name and hotel name 
        franchise.innerText = `${result.company}`;
        hotel.innerText = `${result.company}`;
    
        title.appendChild(franchise);
        title.appendChild(hotel);

        // ( i , j ) locations
        var des = document.createElement('p');
        des.className = 'hotel-descript';
        des.innerText = `Location : ${result.x_cord} street , ${result.y_cord} ave`;
    
        // Visit Us button 
        var btn_padding = document.createElement('div');
        btn_padding.className ='button-padding';
        var btn = document.createElement('a');
        btn.className ="button button-text";
        btn.href = "./roomlistings.php"
        btn.innerHTML ="Visit Us";
        btn_padding.appendChild(btn);

        col_div.appendChild(hotel_div);
        hotel_div.appendChild(title);
        hotel_div.appendChild(des);
        hotel_div.appendChild(btn_padding);

        hotelmodal_container.appendChild(col_div);
    })
}