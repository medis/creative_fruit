(function($) {
  if ($('.carousel').length) {
    $(document).ready(function(){
      $('.carousel').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        speed: 500,
        autoplay: true
      });
    });
  }
})(jQuery);
