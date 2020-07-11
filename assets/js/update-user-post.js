$(document).ready(function() {
    $('#update-user-form').submit(function(e) {
        e.preventDefault();
        $('#response-message').hide();
        var form_data=JSON.stringify($(this).serializeObject());

        $.ajax({
            type: "PUT",
            url: 'http://localhost/api/update.php',
            contentType : 'application/json',
            data: form_data,
            success: function(response)
            {
                JSON.stringify(response);
                $('#response-message').show();
                $('#response-message').text(response.message);
            }
        });
    });
});

$.fn.serializeObject = function(){

    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};