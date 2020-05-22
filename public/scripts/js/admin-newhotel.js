
  function AddHotel() {
    var company = await fetch('/ses-admin-company').then((response) => {
      return response.json().company;
    });
    var x_cord = document.getElementById('x_cord').value;
    var y_cord = document.getElementById('y_cord').value;

    if ( x_cord == "" || y_cord == "" ||) {
      document.getElementById('addHotel-err-msg').innerText = "Please fill in all fields"
    }
    else if ( x_cord < 0 || x_cord > 100 || y_cord < 0 || y_cord > 100) {
      document.getElementById('addHotel-err-msg').innerText = "Invalid Inputs : street and ave must between 0 - 100 "
    }
    else {
        $.ajax({
        method:"POST",
        url:"/admin",
        data:{ action: "add-hotel", 
               x_cord : x_cord , 
               y_cord : y_cord ,
               company_name : company
            },
        })
        .done(function(res){
          document.getElementById('addHotel-err-msg').innerText = res; // `New Hotel at ${x_cord} street , ${y_cord} Ave is Successfully Added !`;
        })
        .fail(function(){
          document.getElementById('addHotel-err-msg').innerText = "ajax Unknown Errors"
        })
    }
  }

  function AddRoom() {

    var x_cord = document.getElementById('addRoom_x_cord').value;
    var y_cord = document.getElementById('addRoom_y_cord').value;
    var room_class = document.getElementById('addRoom_class').value;
    var price = document.getElementById('rate').value;

    if ( x_cord == "" || y_cord == "" || price == "" ) {
      document.getElementById('addRoom-err-msg').innerText = "Please fill in all fields"
    }
    else if ( x_cord < 0 || x_cord > 100 || y_cord < 0 || y_cord > 100) {
      document.getElementById('addRoom-err-msg').innerText = "Invalid Inputs : street and ave must between 0 - 100 "
    }
    else {
        $.ajax({
        method:"POST",
        url:"/admin",
        data:{ x_cord : x_cord , 
               y_cord : y_cord ,
               class : room_class,
               price : price,
               action: "add-room"
              },
        })
        .done(function(res){
          document.getElementById('addRoom-err-msg').innerText = res;
        })
        .fail(function(){
          document.getElementById('addRoom-err-msg').innerText = "ajax Unknown Errors"
        })
    }
  }

  function AddRooms() {

      var x_cord = document.getElementById('addRooms_x_cord').value;
      var y_cord = document.getElementById('addRooms_y_cord').value;
      var room_class = document.getElementById('addRooms_class').value;
      var amount = document.getElementById('amount').value;
      var price = document.getElementById('rooms_rate').value;

      if ( x_cord == "" || y_cord == "" || price == "" || amount == "" ) {
        document.getElementById('addRooms-err-msg').innerText = "Please fill in all fields"
      }
      else if ( x_cord < 0 || x_cord > 100 || y_cord < 0 || y_cord > 100) {
        document.getElementById('addRooms-err-msg').innerText = "Invalid Inputs : street and ave must between 0 - 100 "
      }
      else {
          $.ajax({
          method:"POST",
          url:"/admin",
          data:{ x_cord : x_cord , 
                 y_cord : y_cord ,
                 class : room_class,
                 price : price,
                 amount : amount,
                 action: "add-rooms"
                },
          })
          .done(function(res){
            document.getElementById('addRooms-err-msg').innerText = res;
          })
          .fail(function(){
            document.getElementById('addRooms-err-msg').innerText = "ajax Unknown Errors"
          })
      }
  }