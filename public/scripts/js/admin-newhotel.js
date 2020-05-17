function AddHotel() {
    // form datas .. 
    var x_cord = document.getElementById('x_cord').value;
    var y_cord = document.getElementById('y_cord').value;
    var standard_num = document.getElementById('standard').value;
    var standard_rate = document.getElementById('standard-rate').value;
    var deluxe_num = document.getElementById('deluxe').value;
    var deluxe_rate = document.getElementById('deluxe-rate').value;
    var suite_num = document.getElementById('suite').value;
    var suite_rate = document.getElementById('suite-rate').value;
    
    // Checking Location inputs ... 
    if ( x_cord == "" || y_cord == "" ) {
      document.getElementById('location-err-msg').innerText = "Please fill in all fields"
    }
    else if ( x_cord < 0 || x_cord > 100 || y_cord < 0 || y_cord > 100) {
      document.getElementById('location-err-msg').innerText = "Invalid Inputs : street and ave must between 0 - 100 "
    }
    // Checking Room inputs ... 
    else if ( standard_num == "" || standard_rate == "" || deluxe_num == "" || deluxe_rate == ""|| suite_num == "" || suite_rate == ""){
      document.getElementById('room-err-msg').innerText = "Please fill in all fields"
    } 
    else {
      document.getElementById('location-err-msg').innerText = "Success"
      /*
        $.ajax({
        method:"POST",
        url:"",
        processData: false,
        contentType: false,
        data:{ x_cord : x_cord , 
               y_cord : y_cord ,
               standard_num : standard_num,
               standard_rate : standard_rate,
               deluxe_num : deluxe_num,
               deluxe_rate : deluxe_rate,
               suite_num : suite_num,
               standard_rate : suite_rate,
               },
        })
        .done(function(){
          document.getElementById('signup-msg').innerText = " Your Account has been create !"
        })
        .fail(function(){
          document.getElementById('err-msg').innerText = "ajax Unknown Errors"
        })*/
    }
  }