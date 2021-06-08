
// ---------------------- step 3 - delivery methods  -----------------------------

$('input[type=radio][name=product_delivery]').change(function() {
   // console.log($(this).val())

    if($('#is-delivery').is(':checked')) {
        $('.delivery-location').removeClass('hidden');

    }else {
        $('.delivery-location').addClass('hidden');
    }
});

// submit form  > if location is typed or not chosen
$('#submit-delivery').on('click', function() {

    // submit if location is typed
    if( $('#is-delivery').is(':checked') && $('#delivery-address').val() !== "" ) {

        $('#delivery-form').submit()
    }else {
        $('.delivery-location').css('border', '1px solid red');
    }

    // take from center
    if( $('#is-widthdraw').is(':checked') ) {
        $('#delivery-form').submit()
    }
});




// ---------------------- step 4 - paymenth methods  -----------------------------

$('input[type=radio][name=payment_method]').change(function() {
    console.log($(this).val());

    // card pay > bank
    if($('#card-pay').is(':checked')) {
        $('.card-payment').removeClass('hidden')
    }else {
        $('.card-payment').addClass('hidden')
    }
    // installment pay > bank
    if($('#installment-pay').is(':checked')) {
        $('.installment-payment').removeClass('hidden')
    }else {
        $('.installment-payment').addClass('hidden')
    }

 });


// if installment  === volta installment > show form ----

$('input[type=radio][name=installment-bank]').change(function() {
    // show form
    // if( $('#volta-installment').is(':checked') ) {
    //     $('.volta-installment-form').removeClass('hidden');
    // }

 });



 // submit form  >  if volta instalment is full or not choosen
$('#submit-payment').on('click', function() {

    let isEmpty = false;

    // if isntalment is chosen . check  form
    if( $('#volta-installment').is(':checked') ){

        $('.volta-installment__input input').each(function() {
            let element = $(this);
            if (element.val() == "") {
                isEmpty = true;
            }
        });
        // display msg  if inputs are empty
        if( isEmpty ) {
            $('.pls-fill-all').removeClass('hidden');
        }
    }
    // subbmit if instalment is chosen and iputs are filed
    if ( $('#volta-installment').is(':checked') && !isEmpty ) {
        $('#payment-form').submit()
    }

    // subbmit if volta instalment is not chosen
    if( !$('#volta-installment').is(':checked')) {
       $('#payment-form').submit()
    }

});
