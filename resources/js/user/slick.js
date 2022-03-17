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

