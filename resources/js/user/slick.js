export function slick() {
    $(function () {
        $(document).find('.side').slick({
          infinite: true,
          slidesToShow: 5,
          slidesToScroll: 2,
          autoplay: true,
          autoplaySpeed: 3000,
          pauseOnHover: true,
          swipeToSlide: true,
          prevArrow:"<div class='control-c prev slick-prev'><i class='fa-solid fa-angle-left'></i></div>",
          nextArrow:"<div class='control-c next slick-next'><i class='fa-solid fa-angle-right'></i></div>",
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                  slidesToShow: 5,
                  slidesToScroll: 5,
              }
            },
            {
              breakpoint: 600,
              settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3
              }
            },
            {
              breakpoint: 480,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
              }
            }
        ]
        });
    });
}

