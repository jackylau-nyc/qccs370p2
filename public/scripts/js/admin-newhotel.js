
  function AddHotel() {

    var x_cord = document.getElementById('x_cord').value;
    var y_cord = document.getElementById('y_cord').value;
    var company_name = document.getElementById('company_name').value;

    if ( x_cord == "" || y_cord == "" || company_name == "" ) {
      document.getElementById('addHotel-err-msg').innerText = "Please fill in all fields"
    }
    else if ( x_cord < 0 || x_cord > 100 || y_cord < 0 || y_cord > 100) {
      document.getElementById('addHotel-err-msg').innerText = "Invalid Inputs : street and ave must between 0 - 100 "
    }
    else {
        $.ajax({
        method:"POST",
        url:"/add-hotel",
        processData: false,
        contentType: false,
        data:{ x_cord : x_cord , 
              y_cord : y_cord ,
              company_name : company_name
              },
        })
        .done(function(){
          document.getElementById('addHotel-err-msg').innerText = `New Hotel at ${x_cord} street , ${y_cord} Ave is Successfully Added !`;
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
        url:"/add-room",
        processData: false,
        contentType: false,
        data:{ x_cord : x_cord , 
               y_cord : y_cord ,
               class : room_class,
               price : price
              },
        })
        .done(function(){
          document.getElementById('addRoom-err-msg').innerText = `A $${price} ${room_class} Room Successfully Added to Hotel at ${x_cord} street , ${y_cord} Ave`;
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
          url:"/add-rooms",
          processData: false,
          contentType: false,
          data:{ x_cord : x_cord , 
                 y_cord : y_cord ,
                 class : room_class,
                 price : price,
                 amount : amount
                },
          })
          .done(function(){
            document.getElementById('addRooms-err-msg').innerText = `${amount} $${price} ${room_class} Rooms are successfully added to Hotel at ${x_cord} street , ${y_cord} Ave`;
          })
          .fail(function(){
            document.getElementById('addRooms-err-msg').innerText = "ajax Unknown Errors"
          })
      }
  }