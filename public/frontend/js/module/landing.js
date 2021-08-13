$(document).on('ready', function() {
  $('.blog-slider').slick({
    centerPadding: '0px',
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    arrows: true,
    autoplaySpeed: 1000,
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          arrows: true,
          centerPadding: '0px',
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 991,
        settings: {
          arrows: true,
          centerPadding: '0px',
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: true,
          centerPadding: '0px',
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

});