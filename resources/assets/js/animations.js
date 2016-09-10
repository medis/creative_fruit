(function($) {
  animate_header();
  animate_about_text();
  animate_border('#trigger-biography', '.section-title.biography .border');
  animate_border('#trigger-skills', '.section-title.skills .border');
  animate_border('#trigger-work', '.section-title.recent-work .border');

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
			triggerElement: '#animate-text-trigger'
		})
		.setTween('article.about .body', 0.5, {opacity: 1, y: 0})
		.addTo(controller);
  }

  // Animate biography border.
  function animate_border(trigger, elem) {
    var controller = new ScrollMagic.Controller();

    new ScrollMagic.Scene({
			triggerElement: trigger,
      duration: $(window).height(),
      offset: -200
		})
		.setTween(elem, {width: '30%'})
		.addTo(controller);
  }

})(jQuery);
