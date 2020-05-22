
window.addEventListener('load', function (){
    getData();
});

async function getData(){
    const company = await getCompany();
    const result  = await mainReq(company);
    hotel_div_generate(result);
}

async function hotel_div_generate(result){

    var hotelmodal_container = document.getElementById('id');
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


async function getCompany(){
    var url = "/ses-admin-company";
    var comp = await fetchAsync(url);
    return  comp[0].company;
}


async function fetchAsync (url) {
    console.log(url);
    let response = await fetch(url);
    let data = await response.json();
    console.log(data);
    return await data;
  }
  

  async function mainReq(company){
    var data = {    
        action: "get-company-hotels",
    };
    var url = `/admin?action=${encodeURIComponent(data.action)}&company=${encodeURIComponent(company)}`;
    var res = await fetchAsync(url); 
    return res;
}