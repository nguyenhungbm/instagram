  $('.mySlides').slick({
    infinite: true,
    slidesToShow: 8,
    slidesToScroll: 4,
    autoplay:false,
    arrows:true,
    
    responsive: [
        {
      breakpoint: 800,
      settings: {
      slidesToShow: 6,
    slidesToScroll: 3,
      }
      },

      {
        breakpoint: 650,
        settings: {
        slidesToShow: 5,
      slidesToScroll: 2,
        }
        },

    

      {
        breakpoint: 350,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        }}
      
      ]



  });
