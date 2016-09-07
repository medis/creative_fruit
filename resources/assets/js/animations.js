(function($) {
  animate_header();
  animate_about_text();

  // Animate header.
  function animate_header() {
    TweenMax.to('.header .text h2', 0.5,
      {css:{opacity:1},
      ease:Quad.easeInOut,
    });
    TweenMax.to('.header .text .author', 1.3,
      {css:{opacity:1},
      ease:Quad.easeInOut,
      delay: 0.3
    });
  }

  // Animate about text.
  function animate_about_text() {
    var controller = new ScrollMagic.Controller();

    new ScrollMagic.Scene({
			triggerElement: '#animate-text-trigger',
      offset: 150
		})
		.setTween('article.about .body', 0.5, {opacity: 1, y: 0})
		.addTo(controller);
  }
})(jQuery);
