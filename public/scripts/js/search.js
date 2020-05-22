/**
 * Interprets and gathers search parameters. 
 * 
    console.log(term);
    console.log(searchMode );
    console.log(date);
    console.log(action);
    
 */

async function searchQuery(){
    let term = $("#search").val();
    let searchMode = $("#searchMode option:selected").val();
    let date = $("#depart").val();
    let action = "tbd"; 
    
     switch(searchMode) {
         case "gt":
           action = "find-rooms-gt";
           break;
         case "lt":
            action = "find-rooms-lt";
           break;
        case "ge":
            action = "find-rooms-ge";
            break;
        case "le":
            action = "find-rooms-le";
            break;
        case "eq":
            action = "find-rooms-eq";
            break;
        case "comp":
            action = "find-by-company";
            break;
    }
    performSearch(action, term, date);
}

async function performSearch(action, term, date){
    let results = await performQuery(action, term, date);   
    //showResults(results); 
}

async function performQuery(action, term, date){
    var url = `/search?action=${encodeURIComponent(action)}&price=${encodeURIComponent(term)}&date=${encodeURIComponent(date)}`;
    var res = await fetchAsync(url); 
    return res;
}


async function showResults(result){

    var container = $("#results");
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

        container.appendChild(col_div);
    })
}




async function fetchAsync (url) {
    console.log(url);
    let response = await fetch(url);
    let data = await response;
    console.log(data.text());
    return await data;
  }
  


