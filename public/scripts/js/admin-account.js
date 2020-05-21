function AdminLogin(){
    var admin_username = document.getElementById('admin-username').value;
    var admin_password = document.getElementById('admin-password').value;

    if( admin_username == "" || admin_password == "" ){
        document.getElementById('admin-err-msg').innerText = "Please fill in all fields"
    } else {
        $.ajax({
          method:"POST",
          url:"/admin-signin",
          data : { username: admin_username , 
                   password:   admin_password 
            },
        })
    .done(function(response){
        console.log(admin_password);
            console.log(response);
            if (response.includes("Success")){
                location.href = "./adminHome.php";
            } else{
                document.getElementById('admin-err-msg').innerText= response;
            }
        })
        .fail(function(){
            document.getElementById('admin-err-msg').innerText = "Denied access."
        })
    }
}