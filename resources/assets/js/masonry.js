(function ($) {
  if ($('.masonry').length) {
    $('.masonry').imagesLoaded(function() {
      $('.masonry').masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        gutter: 10
      });
    });

    // Hover.
    $(".grid-item a").hover(over, out);

    // Focus.
    $('.grid-item a').focus( function(e) {
      over(e, $(this));
    });

    $('.grid-item a').blur( function(e) {
      out(e, $(this));
    });

    function over(e, $elem) {
      if (typeof $elem == 'undefined') {
        $elem = $(this);
      }
      TweenMax.to($elem.find('img'), 0.2,
        {css:{scale:1.3},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.find('.background'), 0.2,
        {css:{opacity:0.7},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.find('.text-wrapper'), 0.2,
        {css:{opacity:1},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.find('i'), 0.3,
        {css:{fontSize:50, rotation: 720},
        ease:Quad.easeInOut
      });
    }

    function out(e, $elem) {
      if (typeof $elem == 'undefined') {
        $elem = $(this);
      }
      TweenMax.to($elem.find('img'), 0.2,
        {css:{scale:1},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.find('.background'), 0.2,
        {css:{opacity:0},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.find('.text-wrapper'), 0.2,
        {css:{opacity:0},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.find('i'), 0.3,
        {css:{fontSize:0, rotation: -720},
        ease:Quad.easeInOut
      });
    }

  }
})(jQuery);
