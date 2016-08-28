(function($) {
  if ($('input[type="radio"][name="type"]').length) {
    // Hide on page load.
    if ($('input[type="radio"][name="type"][checked="checked"]').val() != 'video') {
      $('.form-item-video').parent().hide();
    }

    $('input[type="radio"][name="type"]').change(function() {
      if ($(this).val() == 'video') {
        $('.form-item-video').parent().show();
      } else {
        $('.form-item-video').parent().hide();
      }
    });
  }
})(jQuery);
