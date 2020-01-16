$(document).ready(function() {
    $('.form_convert').submit(function(){
        event.preventDefault();
        $.ajax({
            type:'POST',
            url: 'CurrencyConverter.php',
            data: {amount: $('#get').val()},
            success: function(data) {
                $('#take').val(data);
            }
        });
    });
});
