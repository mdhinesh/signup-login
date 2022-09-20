<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    function submitData(){
        $(document).ready(function(){
            var data = {
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                action: $('#action').val(),
            };
            $.ajax({
            url: 'function.php',
            type: 'post',
            data: data,
            success: function(response){
                alert(response);
                if(response == 'Login successful'){
                    window.location.reload();
                }
            }
         });
        });
    }
</script>