// aside  price range

/*                                 Price Range                                */
/* -------------------------------------------------------------------------- */

const priceSlider = document.getElementById('price-range')
var nodes = [
    document.getElementById('range-low-price'),
    document.getElementById('range-high-price') 
];
noUiSlider.create(priceSlider, {
    start: [nodes[0].value, nodes[1].value],
    connect: true,
    range: {
        'min': 0,
        'max': 30000
    },
    step:10,
    tooltips: false,
    
    // remove decimals
    format: {
        to: (v) => parseFloat(v).toFixed(0),
        from: (v) => parseFloat(v).toFixed(0)
    }

});

priceSlider.noUiSlider.on('update', function (values, handle) {
    var value = values[handle];

    if (handle) {
        nodes[1].value = value;
    } else {
        nodes[0].value = value;
    }
});

nodes[0].addEventListener('change', function () {
    priceSlider.noUiSlider.set([this.value, null]);
});

nodes[1].addEventListener('change', function () {
    priceSlider.noUiSlider.set([null, this.value]);
});



// category


/*                               checkbox accordions                         */
/* -------------------------------------------------------------------------- */

// --- open selected modal with hero btns
$('.catalogue__accordion-tab').on('click', function(){
    // selected el index
    let index = $('.catalogue__accordion-tab').index(this);

    // togle accoerdion content and icon
    $('.catalogue__accordion-tab').eq(index).toggleClass('closed')
    $('.catalogue__accordion-content').eq(index).toggleClass('closed')
});


$('.inputs-search').each(function (e) {
    if ($(this).is(':checked')) {
        if($(this).parent().parent().hasClass('closed')) {
            $(this).parent().parent().removeClass('closed')
        }
        if($(this).parent().parent().parent().children(':first-child').hasClass('closed')) {
            $(this).parent().parent().parent().children(':first-child').removeClass('closed')
        }
    }
})
