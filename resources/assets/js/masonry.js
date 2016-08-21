(function ($) {
  if ($('.masonry').length) {
    $('.masonry').masonry({
      itemSelector: '.grid-item',
      percentPosition: true,
      gutter: 10
    });
  }
})(jQuery);
