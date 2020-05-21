function SignUp(){
    var signup_user = document.getElementById('signup-username').value;
    var signup_pw = document.getElementById('signup-password').value;
    var signup_confirm_pw = document.getElementById('signup-confirm-password').value;

    if( signup_user == "" || signup_pw == "" || signup_confirm_pw == ""){
      document.getElementById('signup-msg').innerText = " Please fill in all fields"
    } else if( signup_pw != signup_confirm_pw ){
      document.getElementById('signup-msg').innerText = " Passwords not match!"
    } else {
        $.ajax({
        method:"POST",
        url:"/signup",
        data:{ username: signup_user, password:signup_pw },
        })
        .done(function(response){

          if (response.includes("Success")){
              $('#signup-msg').text("Your account has been successfully created, please wait, you'll be redirected in a 3 few seconds");
              
              setTimeout(function(){
                window.location.href = "/reservation.php";
            }, 3000);    
          }
          else{
            $('#signup-msg').text(response);
          }
          
        })
        .fail(function(response){
          $('#signup-msg').text(response);
        })
    }
}