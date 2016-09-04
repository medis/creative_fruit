(function($) {
  function openMainMenu(elem) {
    elem.addClass('open');
  }

  function closeMainMenu(elem) {
    elem.removeClass('open');
  }

  $('document').ready(function() {
    $('nav').slicknav({
      prependTo: '#header-sticky-wrapper .slicknav-wrapper',
      label: '',
      beforeOpen: openMainMenu,
      beforeClose: closeMainMenu
    });
  });
})(jQuery);
