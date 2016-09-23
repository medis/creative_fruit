(function($) {
  if (!$('button[name="add-skill"]').length) {
    return;
  }

  $('button[name="add-skill"]').click(function() {
    var $elem = $('table tbody tr').last().clone();
    $('table tbody').append($elem);
    var number = -1;
    var myRe = /.*\[(\d+)\]/;
    $('table tbody tr').last().find('input').each(function() {
      $(this).val('');
      // Get new number.
      if (number == -1) {
        number = parseInt(myRe.exec($(this).attr('name'))[1]) + 1;
      }
    });
    // Update index in new row.
    if (number != -1) {
      set_number($elem, number);
      /*$elem.find('.text').attr('name', 'text[' + number + ']');
      $elem.find('.percent').attr('name', 'percent[' + number + ']');
      $elem.find('.color-0').attr('name', 'color[' + number + '][0]');
      $elem.find('.color-1').attr('name', 'color[' + number + '][1]');*/
    }

    return false;
  });

  $('button[name="delete"]').click(function() {
    $(this).parents('tr').remove();
    update_row_numbers();
    return false;
  });

  function update_row_numbers() {
    var number = 0;
    $('table tbody tr').each(function() {
      set_number($(this), number++);
    });
  }

  // Update element number.
  function set_number($elem, number) {
    $elem.find('.text').attr('name', 'text[' + number + ']');
    $elem.find('.percent').attr('name', 'percent[' + number + ']');
    $elem.find('.color-0').attr('name', 'color[' + number + '][0]');
    $elem.find('.color-1').attr('name', 'color[' + number + '][1]');
  }

  // Return a helper with preserved width of cells
  var fixHelper = function(e, ui) {
    ui.children().each(function() {
      $(this).width($(this).width());
    });
    return ui;
  };

  // Draggable.
  $('table tbody').sortable({
    helper: fixHelper,
    handle: '.handle',
    stop: function (event, ui) {
      update_row_numbers();
    }
  }).disableSelection();
})(jQuery);
