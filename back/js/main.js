$(document).ready(function () {

    $('#olchov').on('change', function () {

        let olchov = $('#olchov').val();
        let product = $('#product').val();
        let hajim = $('#hajim').val();

        // mashina, olchov, hajimni olish 
        $.ajax({
            url: "../includes/ajax.php",
            type: "POST",
            data: {
                olchov: olchov,
                hajim: hajim,
                product: product,
            },
            success: function (data) {
                $("#result").html(data);
            }
        });

    });

});