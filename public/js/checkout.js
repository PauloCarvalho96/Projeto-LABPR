var stripe = Stripe('pk_test_8VRQrJDx0lPm9K7Po5fLq0oD00VDRq6v1B');

var $form = $('#checkout-form');

$form.submit(function(event){
    $('#charge-error').addClass('hidden');
    $form.find('button').prop('disabled',true);
    Stripe.card.createToken({
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        ecp_year: $('#card-expiry-year').val(),
        name: $('#name').val()
    },stripeResponseHandler);
    return false;
});

function stripeResponseHandler(status,response){
    if(response.error){
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text(response.error.message);
        $form.find('button').prop('disabled',false);
    }else{
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));

        // submit the form
        $form.get(0).submit();
    }
}

