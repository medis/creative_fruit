(function ($) {
  if ($('.masonry').length) {
    /*$('.masonry').imagesLoaded(function() {
      $('.masonry').masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        gutter: 10
      });
    });*/

    function over(e, $elem) {
      if (typeof $elem == 'undefined') {
        $elem = $(this);
      }
      TweenMax.to($elem.children('img'), 0.2,
        {css:{scale:1.3},
        ease:Quad.easeInOut,
        force3D:true
      });
      TweenMax.to($elem.children('.background'), 0.2,
        {css:{opacity:0.7},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.children('.text-wrapper'), 0.2,
        {css:{opacity:1},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.find('i'), 0.3,
        {css:{fontSize:50, rotation: 360},
        ease:Quad.easeInOut,
        force3D:true
      });
    }

    function out(e, $elem) {
      if (typeof $elem == 'undefined') {
        $elem = $(this);
      }
      TweenMax.to($elem.children('img'), 0.2,
        {css:{scale:1},
        ease:Quad.easeInOut,
        force3D:true
      });
      TweenMax.to($elem.children('.background'), 0.2,
        {css:{opacity:0},
        ease:Quad.easeInOut,
      });
      TweenMax.to($elem.children('.text-wrapper'), 0.2,
        {css:{opacity:0},
        ease:Quad.easeInOut
      });
      TweenMax.to($elem.find('i'), 0.3,
        {css:{fontSize:0, rotation: -360},
        ease:Quad.easeInOut,
        force3D:true
      });
    }

    // Hover.
    $("a.grid-item").hover(over, out);

    // Focus.
    $('a.grid-item').focus( function(e) {
      over(e, $(this));
    });

    $('a.grid-item').blur( function(e) {
      out(e, $(this));
    });

  }
})(jQuery);
