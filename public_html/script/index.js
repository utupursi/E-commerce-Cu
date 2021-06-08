
//---------------- on small screen close big menu fro mstart  -+-----------
if(window.innerWidth < 670)  {
  $('.navigation-wrapper').addClass('closed');
}

//  --------------   close big menu on scroll
window.addEventListener('scroll', ()=> {
  // stop this function on mobile
  if(window.innerWidth < 670) return;

  // show at top hide below
  if(window.pageYOffset > 150) {
    $('.navigation-wrapper').addClass('closed');
  }
});

// section 1 - hero slider 

$(".hero-slider").slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    speed: 1300,
    arrows: false,
    dots: true,
    rtl: false,
});


// section 3 - new product slider (for section 5 6 sliders too)
function productSlick(boolean){
  if(!boolean){
$(".product-card-slider").slick({
    prevArrow: `<button class="s-btn btn-left">
        <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.704" viewBox="0 0 18.634 30.704">
        <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left" d="M2.427,16.807,16.092,3.142a1.688,1.688,0,0,1,2.386,0l1.594,1.594a1.688,1.688,0,0,1,0,2.384L9.245,18l10.83,10.881a1.687,1.687,0,0,1,0,2.384l-1.594,1.594a1.688,1.688,0,0,1-2.386,0L2.427,19.193A1.688,1.688,0,0,1,2.427,16.807Z" transform="translate(-1.933 -2.648)" />
        </svg>
  </button>`,
  nextArrow: `<button class="s-btn btn-right">
        <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.705" viewBox="0 0 18.634 30.705">
        <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left" d="M20.073,16.807,6.408,3.142a1.688,1.688,0,0,0-2.386,0L2.427,4.736a1.688,1.688,0,0,0,0,2.384L13.255,18,2.425,28.881a1.687,1.687,0,0,0,0,2.384l1.594,1.594a1.688,1.688,0,0,0,2.386,0L20.073,19.193A1.688,1.688,0,0,0,20.073,16.807Z" transform="translate(-1.933 -2.648)" />
        </svg>
  </button>`,
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 2,
    autoplay: true,
    autoplaySpeed: 1800,
    speed: 1000,
    arrows: true,
    dots: false,
    rtl: false,
    responsive: [
       {
          breakpoint: 1250,
          settings: {
            slidesToShow: 4,
          }
        },{
          breakpoint: 1000,
          settings: {
            slidesToShow: 3,
          }
       },{
          breakpoint: 750,
          settings: {
            slidesToShow: 2,
          }
        },{
          breakpoint: 500,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
});
  }
  else{
    $(".product-card-slider").not('.slick-initialized').slick({
      prevArrow: `<button class="s-btn btn-left">
          <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.704" viewBox="0 0 18.634 30.704">
          <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left" d="M2.427,16.807,16.092,3.142a1.688,1.688,0,0,1,2.386,0l1.594,1.594a1.688,1.688,0,0,1,0,2.384L9.245,18l10.83,10.881a1.687,1.687,0,0,1,0,2.384l-1.594,1.594a1.688,1.688,0,0,1-2.386,0L2.427,19.193A1.688,1.688,0,0,1,2.427,16.807Z" transform="translate(-1.933 -2.648)" />
          </svg>
    </button>`,
    nextArrow: `<button class="s-btn btn-right">
          <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.705" viewBox="0 0 18.634 30.705">
          <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left" d="M20.073,16.807,6.408,3.142a1.688,1.688,0,0,0-2.386,0L2.427,4.736a1.688,1.688,0,0,0,0,2.384L13.255,18,2.425,28.881a1.687,1.687,0,0,0,0,2.384l1.594,1.594a1.688,1.688,0,0,0,2.386,0L20.073,19.193A1.688,1.688,0,0,0,20.073,16.807Z" transform="translate(-1.933 -2.648)" />
          </svg>
    </button>`,
      infinite: true,
      slidesToShow: 5,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 1800,
      speed: 1000,
      arrows: true,
      dots: false,
      rtl: false,
      responsive: [
         {
            breakpoint: 1250,
            settings: {
              slidesToShow: 4,
            }
          },{
            breakpoint: 1000,
            settings: {
              slidesToShow: 3,
            }
         },{
            breakpoint: 750,
            settings: {
              slidesToShow: 2,
            }
          },{
            breakpoint: 500,
            settings: {
              slidesToShow: 1,
            }
          }
        ]
  });
  }
}

productSlick();