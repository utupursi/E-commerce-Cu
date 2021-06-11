// ------------- header  shadow on scroll
let navbar = document.querySelector(".header");
const locale = $('meta[name="language"]').attr('content');
window.onscroll = function () {

    if (window.pageYOffset > 100) {
        navbar.classList.add("shadowed");
    } else {
        navbar.classList.remove("shadowed");
    }
};

$('.sub-menu__list').each(function (s, el) {

    if (el.children.length > 11) {
        $(el).addClass('columns')
    }
})

// -----------  header big menu toggle show /hide
$(document).ready(function () {
    getCartCount();
});


// -----------  header big menu toggle show /hide

$('.big-menu-btn').on('click', () => {
    $('.navigation-wrapper').toggleClass('closed');
});


// -------------- header big Sub navs ---------------

$(".navigation__link").hover(
    function () {
        // save value of  link attr data-
        var subClass = $(this).attr("data-sub-nav");

        // hide all target items
        $('.sub-menu').addClass("closed");

        // show hovered links related target item
        $(".sub-" + subClass).removeClass("closed");
    },

    // on mouse out hide all submenus
    function () {
        $('.sub-menu').addClass("closed");
    },
);

// on content wrapper hover - show it
$(".sub-menu").hover(
    function () {
        // show sub which was visible before
        $(this).removeClass("closed");

        // show related nav link for this sub menu
        let thisElClass = $(this).attr("class").split(' ')[1].split('-')[1];
        $('[data-sub-nav=' + thisElClass + ']').addClass('active');

    },
    // on hover out  close all
    function () {
        $('.sub-menu').addClass("closed");

        // hide active class on related link
        $(".navigation__link").removeClass('active')
    }
);


// --------------------   header Search toggle on small screen ---------------

const formBox = document.querySelector('.navbar-search');
const formToggler = document.querySelector('.toggle-search-form');

$('.toggle-search-form').on('click', function () {

    $('.navbar-search').toggleClass('shown');
    // close big menu
    $('.navigation-wrapper').addClass('closed');
});

// close search form on outside click
// window.addEventListener('click', function (e) {
//
//     if (!formBox.contains(e.target) && (!formToggler.contains(e.target))) {
//         formBox.classList.remove('shown');
//     }
// });


/// --------------- switch tab function  --------
// on cproduct cards
function switchTab(el) {
    let id = el.previousElementSibling.textContent;
    let product = el.parentElement.parentElement.nextElementSibling;
    let div = el.parentElement.parentElement.parentElement;
    let type = el.nextElementSibling.textContent;
    let buttons = div.querySelectorAll('.tab-btn');
    buttons.forEach(item => {
        item.className = "tab-btn";
    })
    el.className = "tab-btn active";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `/${locale}/getProducts?id=${id}&type=${type}`,
        method: 'GET',
        async: false,
        success: function (data) {
            let productCard = document.createElement('div');
            productCard.className = "product-card-slider";
            product.remove();
            data.forEach(item => {
                let d = $(`<div class="card">
                        <div class="card__wrapper">
                            <div ${item.sale && item.sale_price !== null ? "" : "hidden"} class="card__banner">
                                 ${Math.round(((item.price - item.sale_price) * 100) / item.price)} %
                            </div>

                            <a href="/${locale}/catalogue/${item.category_id}/details/${item.product_id}" class="card-link">
                                <div class="card-img">
                                        <img class="img-cover"
                                             src="/storage/product/${item.product_id}/${item.file_name}"
                                             alt="">
                                </div>

                                <div class="card__info">
                                    <h2 class="card__title">
                                        ${item.title}
                                    </h2>

                                    <div class="card__pricing">
                                            <h3 ${item.sale && item.sale_price !== null ? '' : 'hidden'} class="cur-p">${item.sale_price / 100} ₾</h3>
                                            <h3 ${item.sale && item.sale_price !== null ? '' : 'hidden'} class="old-p">${item.price / 100} ₾</h3>
                                            <h3 ${item.sale && item.sale_price !== null ? 'hidden' : ''} class="cur-p">${item.price / 100} ₾ </h3>

                                    </div>

                                    <div class="card__brand">
                                       ${item.description}
                                    </div>
                                </div>
                            </a>

                            <div class="card__bottom">
                                <button class="card-add-btn" onclick="addToCart(this,${item.product_id})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18.414" height="17.008"
                                         viewBox="0 0 18.414 17.008">
                                        <g id="Icon_ionic-ios-cart" data-name="Icon ionic-ios-cart"
                                           transform="translate(-3.382 -4.493)">
                                            <path id="Path_24" data-name="Path 24"
                                                  d="M11.688,29.188a1.063,1.063,0,1,1-1.063-1.063A1.063,1.063,0,0,1,11.688,29.188Z"
                                                  transform="translate(-2.288 -8.749)"/>
                                            <path id="Path_25" data-name="Path 25"
                                                  d="M27.473,29.188a1.063,1.063,0,1,1-1.063-1.063,1.063,1.063,0,0,1,1.063,1.063Z"
                                                  transform="translate(-8.132 -8.749)"/>
                                            <path id="Path_26" data-name="Path 26"
                                                  d="M21.79,7.517a.26.26,0,0,0-.23-.186L7.137,5.936A.444.444,0,0,1,6.8,5.728a4.509,4.509,0,0,0-.54-.824c-.341-.416-.983-.4-2.161-.412a.645.645,0,0,0-.722.624.633.633,0,0,0,.691.624,5.883,5.883,0,0,1,1.151.084c.208.062.376.4.438.7a.016.016,0,0,0,0,.013c.009.053.089.452.089.456l1.771,9.37a3.444,3.444,0,0,0,.642,1.581,1.767,1.767,0,0,0,1.457.717H20.1a.629.629,0,0,0,.638-.593.617.617,0,0,0-.62-.647H9.617a.515.515,0,0,1-.368-.124,1.987,1.987,0,0,1-.509-1.151L8.55,15.1a.024.024,0,0,1,.018-.027l12.3-2.081a.259.259,0,0,0,.217-.23l.708-5.128A.253.253,0,0,0,21.79,7.517Z"/>
                                        </g>
                                    </svg>
                                    ${item.cart_text}
                                </button>
                            </div>
                        </div>

                    </div>`)
                $(productCard).append(d);
            });
            $(div).append(productCard);
            productSlick(true);
        }
    });
};


// ----------------- add to cart aniamtion  -------------
$('.card-add-btn').on('click', function cartAnimate() {
    $(".nav-cart-img").addClass('shake');
    setTimeout(function () {
        $(".nav-cart-img").removeClass('shake');
    }, 1000)
});


//  --------- Step Down/ Up --------  purchase steps  1 2 3 4

// increase qty
function QuantityPlus(el, $id) {
    var qtyInput = $(el).parent('.qty').find("input");
    // increase by 1
    let newVal = parseInt($(qtyInput).val()) + 1;
    // qtyInput.val(newVal);

    addcartcount($id, +1);

};

// decrease qty
function QuantityMinus(el, $id) {

    var qtyInput = $(el).parent('.qty').find("input");

    // decrease if its > 1
    if ($(qtyInput).val() == 1) return;

    let newVal = parseInt($(qtyInput).val()) - 1;
    // qtyInput.val(newVal);
    addcartcount($id, -1);

};


///--------- check all chekcboxes (cart ) purchase step 1 ---------------
$('#check-all').on('click', function () {

    if ($('#check-all').is(':checked')) {
        $('.cart__card .checkbox input').prop("checked", true);
    } else {
        $('.cart__card .checkbox input').prop("checked", false);
    }
})

//-------------  payment-infos accordions -------------------------------

$('.bank-acc-accordion__btn').on('click', function () {
    let index = $('.bank-acc-accordion__btn').index(this);

    //clear all
    $('.bank-acc-accordion__btn').removeClass('open');
    $('.bank-acc-accordion__content').removeClass('open');

    // show one
    $('.bank-acc-accordion__btn').eq(index).addClass('open');
    $('.bank-acc-accordion__content').eq(index).addClass('open');
})

function addToCart(el, $id) {
    addToCartAjax($id);
};

function addToCartAjax($id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `/${locale}/addtocart/` + $id,
        method: 'GET',
        success: function (data) {
            if (data.status == true) {
                getCartCount();
            }
        }
    });
}

function getCartCount() {
    $.ajax({
        url: `/${locale}/getcartcount/`,
        method: 'GET',
        success: function (data) {
            if (data.status == true) {
                $('#cart-count').text(data.count)
                $('#cart_count').text(data.count)
                $('#sub-total').text(data.total)
                $('#total-price').text(`$ ${data.total+5}`)
                $('#cart_price').text(`${data.total}₾`)

                $('#step_product_price').text(`${data.total}₾`)
                $('#step_product_total').text(`${data.total}₾`)

                $('#step_2_product_price').text(`${data.total}₾`)
                $('#step_2_product_total').text(`${data.total}₾`)

                $('#step_3_product_price').text(`${data.total}₾`)
                $('#step_3_product_total').text(`${data.total}₾`)

                $('#cart_total').text(`${data.total}₾`)
                data.products.forEach((el) => {
                    $(`#step-product-count-${el.id}`).val(el.quantity)
                    $(`#step-2-product-count-${el.id}`).val(el.quantity)
                    $(`#step-3-product-count-${el.id}`).val(el.quantity)

                    $(`#product-count-${el.id}`).val(el.quantity)
                    if (el.sale !== '') {
                        $(`#cart_product_price-${el.id}`).text(`$ ${(el.sale) / 100}`)
                        $(`#cart_product_total-${el.id}`).text(`$ ${(el.sale / 100) * el.quantity}`)
                        $(`#cart_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                        $(`#cart_2_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                        $(`#cart_3_product_total-step-${el.id}`).text(`${(el.sale / 100) * el.quantity}₾`)
                    } else {
                        $(`#cart_product_price-${el.id}`).text(`${(el.price) / 100}₾`)
                        $(`#cart_product_total-${el.id}`).text(`${(el.price / 100) * el.quantity}₾`)
                        $(`#cart_product_total-step-${el.id}`).text(`${(el.price / 100) * el.quantity}₾`)
                        $(`#cart_2_product_total-step-${el.id}`).text(`${(el.price / 100) * el.quantity}₾`)
                        $(`#cart_3_product_total-step-${el.id}`).text(`${(el.price / 100) * el.quantity}₾`)
                    }
                })
            }
        }
    });
}

function addcartcount($id, $type) {
    console.log(22);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `/${locale}/addcartcount/` + $id + "/" + $type,
        method: 'GET',
        success: function (data) {
            if (data.status == true) {
                getCartCount();
            }
        }
    });
}

function removefromcart(id) {
    // $("input[name='product-select']:checked").each(function () {
    //     items.push(parseInt($(this).val()))
    // })
    if (id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/${locale}/removefromcart`,
            method: 'GET',
            data: {
                id
            },
            success: function (data) {
                if (data.status === true) {
                    $(`#cart-container-${id}`).remove();
                    getCartCount();
                }
            }
        });
    }
}


function stepTwo(count) {
    console.log(count);
    let section2 = document.querySelector('.section-2');
    let section1 = document.querySelector('.section-1');
    if (count > 0) {
        section2.hidden = false;
        section1.hidden = true;
    }

}

function stepThree() {
    let section2 = document.querySelector('.section-2');
    let section1 = document.querySelector('.section-1');
    let section3 = document.querySelector('.section-3');
    let name = document.querySelector('#name');
    let surname = document.querySelector('#surname');
    let email = document.querySelector('#email');
    let phone = document.querySelector('#phone');
    let details = document.querySelector('#details');


    name.className = (name.value === '') ? "error-message" : '';
    surname.className = (surname.value === '') ? "error-message" : '';
    email.className = (email.value !== "" && validateEmail(email.value)) ? "" : 'error-message';
    phone.className = (phone.value !== "") ? "" : 'error-message';

    let error = section2.querySelector('.error-message');
    if (!error) {
        section2.hidden = true;
        section1.hidden = true;
        section3.hidden = false;
    }


}

function stepFour() {
    let section2 = document.querySelector('.section-2');
    let section1 = document.querySelector('.section-1');
    let section3 = document.querySelector('.section-3');
    let section4 = document.querySelector('.section-4');
    let banks = document.querySelector('input[name="product_delivery"]:checked');
    let deliveryAddress = document.querySelector('#delivery-address');
    if (banks.value === "location") {
        if (deliveryAddress.value !== "") {
            section2.hidden = true;
            section1.hidden = true;
            section3.hidden = true;
            section4.hidden = false;
        }

    } else {
        section2.hidden = true;
        section1.hidden = true;
        section3.hidden = true;
        section4.hidden = false;
    }

}

function showVoltaForm(title) {
    let voltaForm = document.querySelector('.volta-installment-form');
    if (title !== "Volta Loan") {
        voltaForm.className = "volta-installment-form hidden";
    } else {
        voltaForm.className = "volta-installment-form";
    }
}

function validateVoltaForm() {

    let banks = document.querySelector('input[name="installment_bank"]:checked');
    let loanMethod = document.querySelector('input[id="installment-pay"]');
    let agreement = document.querySelector('#loan_agreement');
    let form = document.querySelector('#purchase-form')
    if (banks.className === "input-volta" && loanMethod.checked) {
        let voltaInputs = document.querySelectorAll('.volta-installment__input');
        let countErrors = 0;
        voltaInputs.forEach(item => {
            let input = item.querySelector('input');
            if (input.id === "loan_phone" || input.id === "loan_job_phone" || input.id === "loan_family_phone" || input.id === "family_2_phone" ||
                input.id === "loan_employee_phone" || input.id === "loan_friend_phone") {
                if (input.value.length !== 9) {
                    input.className = 'error-message';
                    countErrors++;
                } else {
                    input.className = '';

                }
            } else if (input.id === "loan_personal_number" && input.value.length !== 11) {
                input.className = 'error-message';
                countErrors++;
            } else {
                if (input.value === "") {
                    input.className = 'error-message';
                    countErrors++;
                } else {
                    input.className = '';
                }
            }
        })
        if (countErrors === 0 && agreement.checked === true) {
            form.submit();
        }
    } else {
        form.submit();
    }

}

function go(number) {
    let section2 = document.querySelector('.section-2');
    let section1 = document.querySelector('.section-1');
    let section3 = document.querySelector('.section-3');
    let section4 = document.querySelector('.section-4');
    if (number === 1) {
        section2.hidden = true;
        section3.hidden = true;
        section4.hidden = true;
        section1.hidden = false;
    }
    if (number === 2) {
        section1.hidden = true;
        section3.hidden = true;
        section4.hidden = true;
        section2.hidden = false;
    }

    if (number === 3) {
        section1.hidden = true;
        section4.hidden = true;
        section2.hidden = true;
        section3.hidden = false;
    }

}


function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function phoneNumber(phone) {
    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    if ((phone.value.match(phoneno))) {
        return true;
    } else {
        return false;
    }
}

// -------- search results ----

// show result  on focus
$('.navbar-search').find('input').on('focus', function () {
    $('.navbar-search__results').addClass('shown');
    $('.navbar-search').addClass('active');
})

// close on outside click
$(document).click(function (e) {
    if ($(e.target).closest('.navbar-search').length === 0
        && $(e.target).closest('.navbar-search__results').length === 0) {
        $('.navbar-search__results').removeClass('shown');
        $('.navbar-search').removeClass('active');
    }
})

let search = document.querySelector('#search-input');

function getProducts(el) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let searchDiv = document.querySelector('.navbar-search__results');
    searchDiv.innerHTML = "";
    if (el.value !== "") {
        clearTimeout($(this).data('timer'));
        let timer = setTimeout(function () {
            $.ajax({
                url: `/${locale}/searchProducts?keyword=${el.value}`,
                method: 'GET',
                async: false,
                success: function (data) {

                    if (data.length === 0) {
                        let empty = $('<div class="navbar-search__empty">ვერაფერი მოიძებნა</div>');
                        $(searchDiv).append(empty);
                    } else {
                        data.forEach(item => {
                            let content = $(`
                    <a href="/${locale}/catalogue/${item.category_id}/details/${item.id}" class="navbar-search__item">
                            <span class="navbar-search__item-img">
                                <img  src="/storage/product/${item.id}/${item.files[0].name}" alt="">
                            </span>

                        <div class="navbar-search__item-info">
                            <h2>${item.available_language.length > 0 ? item.available_language[0].title : ""}</h2>
                            <p>${item.category_language.length > 0 ? item.category_language[0].title : ""}</p>
                        </div>
                        <div class="navbar-search__item-price">
                        ${item.sale && item.sale_price !== null ? item.sale_price / 100 : item.price / 100}₾
                        </div>
                    </a>
                 `)
                            $(searchDiv).append(content);
                        });
                    }
                }
            });
        }, 300);
        $(this).data('timer', timer);
    }

}

function myFunction() {
    copyTextToClipboard(location.href);
}

function copyTextToClipboard(text) {
    var textArea = document.createElement("textarea");

    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;
    textArea.style.width = '2em';
    textArea.style.height = '2em';

    textArea.style.padding = 0;
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
    textArea.style.background = 'transparent';


    textArea.value = text;

    document.body.appendChild(textArea);

    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
    } catch (err) {
        console.log('Oops, unable to copy');
    }

    document.body.removeChild(textArea);
}

