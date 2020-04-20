//fais un popup à l'écran (les déconseille)
//alert('coucou');

//log dans console
//console.log('coucou console');

//JQUERY = Librairie = une boîte à outils
$(document).ready(function() {
    console.log('1: jquery ready');


/*<button type="button" id="btn">CLICK ME</button>
    $('#btn').on('click', function() {
        $('#product-list td').css('font-weight', 600);
        //les td dans balise productlist, sinon si product-list, td = les deux
       $('input[type="submit"]').val('A');
       $(this).text('DONT');
    });

    /*$('.delete-btn').on('click', function() {
        $(this).parents('tr').first().detach();
    });
*/

    $('.modif').on('click', function() {
        var id = $(this).attr("data-id");
        console.log(id);
        $.post('update.php', { id:id })
            .done(function (objet) {
                var product = JSON.parse (objet);
                $('#test').val('update');
                $('#name').val(product.name);
                $('#price_total').val(product.price_total);
                $('#quantity').val(product.quantity);
            });
    });


    $('#search-form').on('submit', function(event) {
        event.preventDefault();
        $.get('ajax.php', {pk: $('#pk-search').val()}
        )
            .done(function(data) {
                $('#ajax-rsp').html(data);
            });
    });
});

