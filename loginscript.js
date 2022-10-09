$(document).ready(function () {
    $("form").submit(function (event) {
        var formData = {
            email: $("#email").val(),
            password: $("#password").val(),
            action:$("#action").val(),
        };
  
      $.ajax({
        type: "POST",
        url: "function.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);
        if(!data.success){
            if(data.errors.email){
                alert(data.errors.email);
            }else if(data.errors.password){
                alert(data.errors.password);
            }else if(data.errors.verify){
                alert(data.errors.verify);
            }
        }else if(data.redis_key == data.name){
            // alert(data.redis_key);
            localStorage.setItem("name", data.name);
            // localStorage.setItem("email", data.email);
            window.location.href = 'index.php';
        }else{
          alert("Something is wrong");
          window.location.href = 'login.html';
        }
      }).fail(function() {
        alert("Sorry. Server unavailable. ");
      });
  
      event.preventDefault();
    });
});
