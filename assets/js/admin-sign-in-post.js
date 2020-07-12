$(document).ready(function () {
    $('#admin_signin-form').submit(function (e) {
        e.preventDefault();
        $('#response-message').hide();
        $.ajax({
            type: "POST",
            url: 'http://localhost/controllers/admin-login.php',
            data: $(this).serialize(),
            success: function (response) {
                var json_response = $.parseJSON(response);
                if (json_response.status === 200) {
                    window.location.href = 'http://localhost/admin/dashboard.php';
                } else {
                    alert(json_response.message);
                }
            },
            error: function (xhr, status, error) {

                var json_response = JSON.parse(xhr.responseText);
                $('#response-message').show();
                $('#response-message').text(json_response.message);
            }

        });
    });
});