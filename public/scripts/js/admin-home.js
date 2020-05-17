
window.addEventListener('load', function (){
    hotel_div_generate();
});

async function getData(){
    //return await fetch('').then((response) => {
    //       return response.json();
    // })
     return [
            { company : 'Howard Resorts', x_cord: [0], y_cord: [0] },
            { company : 'Howard Resorts', x_cord: [0], y_cord: [1] },
            { company : 'Howard Resorts', x_cord: [0], y_cord: [2] },
            { company : 'Howard Resorts', x_cord: [0], y_cord: [2]}
            ]
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
        var hotel = document.createElement('span');
        hotel.className = 'hotel-name';
        hotel.innerText = `${result.company}`;
        title.appendChild(hotel);

        // ( i , j ) locations
        var des = document.createElement('p');
        des.className = 'hotel-descript';
        des.innerText = `Location : ${result.x_cord} street , ${result.y_cord} ave`;

        col_div.appendChild(hotel_div);
        hotel_div.appendChild(title);
        hotel_div.appendChild(des);

        hotelmodal_container.appendChild(col_div);
    })
}