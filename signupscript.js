$(document).ready(function () {
    $("form").submit(function (event) {
      var formData = {
        name: $("#name").val(),
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
            if(data.errors.name){
                alert(data.errors.name);
            }else if(data.errors.email){
                alert(data.errors.email);
            }else if(data.errors.password){
                alert(data.errors.password);
            }else if(data.errors.verify){
                alert(data.errors.verify);
            }
        }else{
            alert("User registered");
        }
      }).fail(function() {
        alert("Sorry. Server unavailable. ");
      });
  
      event.preventDefault();
    });
  });