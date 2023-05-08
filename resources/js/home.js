$(document).ready(function() {
    $('#miBoton').click(function() {
        $.ajax({
            type: 'POST',
            url: '/mi/ruta/de/post',
            data: {
                miDato: 'valor'
            },
            success: function(response) {
                console.log(response);
            }
        });
    });
});


