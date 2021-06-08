// preview img 

//---------- change main img by thumbs

const imgThumbs = $('.img-thumb');
const bigImgs = $('.big-img-box');


imgThumbs.click(function (event) {
    let i = $(this).index();

    // clear all
    bigImgs.removeClass("shown");
    imgThumbs.removeClass("active");

    // apply on one
    $(bigImgs[i]).addClass("shown");
    $(this).addClass("active");

});


// -------- zoom big img (open modal)

const pictureModal = $('.picture-modal');

bigImgs.click(function () {

    let innerImgSrc = $(this).find('img').eq(0).attr('src');
    
    // open modal + show img
    $("#modal-img").attr('src', innerImgSrc);
    pictureModal.addClass("visible");
});

// close modal
pictureModal.click( ()=> {
    pictureModal.removeClass("visible");
});