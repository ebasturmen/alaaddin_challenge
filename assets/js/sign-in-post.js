$(document).ready(function() {
    $('#signin-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'http://localhost/controllers/login.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var json_response = $.parseJSON(response);
                if (json_response.status === 200) {
                    window.location.href = 'http://localhost/';
                }
                else {
                    alert('Invalid Credentials');
                }
            }
        });
    });
});