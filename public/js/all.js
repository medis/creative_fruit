if (typeof Dropzone !== 'undefined') {
    Dropzone.autoDiscover = false;
}
(function ($) {
    if (typeof Dropzone == 'undefined') {
        return false;
    }
    var uploaded_files = [];
    var baseUrl = "/fileentry";
    var token = $('.token').val();
    var myDropzone = new Dropzone("div#upload-widget", {
        url: baseUrl+"/upload",
        addRemoveLinks: true,
        params: {
            _token: token
        },
        removedfile: function(file) {
            for (var i=0; i < uploaded_files.length; i++) {
                if (uploaded_files[i].name == file.name) {
                    var id = uploaded_files[i].id;
                    $.ajax({
                        type: 'POST',
                        url: baseUrl + '/delete',
                        data: {id: id, _token: token},
                        indexValue: i,
                        dataType: 'html',
                        success: function(data){
                            uploaded_files.splice(this.indexValue, 1);
                            genereateFilesList();
                        }
                    });
                }
            }
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response){
            uploaded_files.push({
                id: response.id,
                name: file.name
            });
            //$('.sortable_img li:last-of-type').data('file', file);
            genereateFilesList();
        }
    });
    Dropzone.options.uploadWidget = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        accept: function(file, done) {
        },
    };

    // files variable is set from server side.
    if (uploaded_files.length == 0 && files.length) {
        for (var i=0; i < files.length; i++) {
            // Create the mock file:
            var mockFile = { name: files[i].filename, size: files[i].size };
            // Call the default addedfile event handler
            myDropzone.emit("addedfile", mockFile);
            // And optionally show the thumbnail of the file:
            //myDropzone.emit("thumbnail", mockFile, files[i].url);
            myDropzone.createThumbnailFromUrl(mockFile, files[i].url);
            // Make sure that there is no progress bar, etc...
            myDropzone.emit("complete", mockFile);

            uploaded_files.push({
                id: files[i].id,
                name: files[i].filename
            });
            genereateFilesList();
        }
    }

    $(document).ready(function() {
      $("#upload-widget").sortable({
        items:'.dz-preview',
        cursor: 'move',
        opacity: 0.5,
        containment: "parent",
        distance: 20,
        tolerance: 'pointer',
        update: function(e, ui){
          genereateFilesList();
        }
      });
    });

    function genereateFilesList() {
        var list = [];
        $('#upload-widget .dz-preview').each(function() {
            var filename = $(this).find('.dz-filename').text();
            for (var i=0; i < uploaded_files.length; i++) {
                if (uploaded_files[i].name == filename) {
                    list.push(uploaded_files[i].id);
                    break;
                }
            }
        });
        $('input[name="files"]').val(list.join());
    }
})(jQuery);

(function ($) {
  if ($('.lt-ie10 .masonry').length) {
    $('.masonry').imagesLoaded(function() {
      $('.masonry').masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        gutter: 10
      });
    });
  }

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
})(jQuery);

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

(function($) {
  $(document).ready(function(){
    $("#header").sticky({topSpacing:0});
  });
})(jQuery);

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

(function($) {
  if (typeof ScrollMagic == 'undefined') {
    return;
  }
  
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

(function($) {
  if (!$('.skills-wrapper .skill-chart').length) {
    return;
  }

  var Skill = function(selector, colours, percent, text, delay) {
    this.selector = selector;
    this.colours = colours;
    this.percent = percent;
    this.text = text;
    this.delay = delay;

    this.pie = d3.layout.pie()
      .value(function(d){return d})
      .sort(null);

    this.w = 230;
    this.h = 230;

    this.outerRadius = (this.w/2.3)-10;
    this.innerRadius = this.outerRadius-12;

    this.arc=d3.svg.arc()
      .innerRadius(0)
      .outerRadius((this.outerRadius-this.innerRadius)/12+this.innerRadius)
      .startAngle(0)
      .endAngle(2*Math.PI);

    //The line is following this
    this.arcDummy=d3.svg.arc()
      .innerRadius((this.outerRadius-this.innerRadius)/2+this.innerRadius)
      .outerRadius((this.outerRadius-this.innerRadius)/2+this.innerRadius)
      .startAngle(0);

    this.d3line2 = d3.svg.line()
      .x(function(d){return d.x;})
      .y(function(d){return d.y;})
      .interpolate("linear");


    this.arcLine=d3.svg.arc()
      .innerRadius(this.innerRadius + 1)
      .outerRadius(this.outerRadius)
      .startAngle(0);

    this.svg=d3.select(this.selector)
      .append("svg")
      .attr({
          width: this.w,
          height: this.h,
          class:'shadow'
      }).append('g')
      .attr({
          transform:'translate('+this.w/2+','+this.h/2+')'
      });

    this.vertrical_line_path = [
      {x:0, y: -this.h/2 + 2},
      {x:0, y: this.h/2 - 2}
    ];

    this.vertrical_line = this.svg.append('path')
      .attr("d", this.d3line2(this.vertrical_line_path))
      .style({
          stroke: this.colours[0],
          'stroke-width': 4,
          'stroke-linecap': 'round',
          fill: this.colours[0]
      });

    //background
    this.path = this.svg.append('path')
      .attr({
          d: this.arc
      })
      .style({
          fill: this.colours[1]
      });

    this.pathForeground = this.svg.append('path')
      .datum({endAngle:0})
      .attr({
          d: this.arcLine
      })
      .style({
          fill: this.colours[0]
      });

    //Dummy Arc for Circle
    this.pathDummy = this.svg.append('path')
      .datum({endAngle:0})
      .attr({
          d: this.arcDummy
      }).style({
          fill: this.colours[0]
      });

    this.pathinfo = [{x:0, y:3},
                    {x:0, y:-20}];

    this.endLine = this.svg.append('path')
      .attr("d", this.d3line2(this.pathinfo))
      .style({
          stroke: this.colours[0],
          'stroke-width':4,
          'stroke-linecap': 'round',
          fill: this.colours[0],
          'opacity': 0
      });

    this.middleTextTitle = this.svg.append('text')
      .datum(0)
      .text(this.text)
      .attr({
          class: 'middleText',
          'text-anchor': 'middle',
          dy: 25,
          dx: 0
      })
      .style({
          fill: this.colours[0],
          'font-size':'70px',
          'opacity': 0,
          'font-weight': 'bold'
      });

    this.middleTextCount = this.svg.append('text')
      .datum(0)
      .text(function(d){
          return d+'%';
      })

      .attr({
          class: 'middleText',
          'text-anchor': 'middle',
          dy: 15,
          dx: 0
      })
      .style({
          fill: this.colours[0],
          'font-size':'50px'
      });
  }

  Skill.prototype.arcTweenOld = function(transition, self, percent, oldValue) {
    transition.attrTween("d", function (d) {
      var newAngle= -1 * (percent/100)*(2*Math.PI);
      var interpolate = d3.interpolate(d.endAngle, newAngle);
      var interpolateCount = d3.interpolate(oldValue, percent);
      return function (t) {
        d.endAngle = interpolate(t);
        var pathForegroundCircle = self.arcLine(d);
        self.middleTextCount.text(Math.floor(interpolateCount(t))+'%');
        var pathDummyCircle = self.arcDummy(d);
        var coordinate = pathDummyCircle.split("L")[1].split("A")[0];
        self.endLine.style('opacity', 1).attr('transform', 'translate(' + coordinate + ')' + 'rotate(' + (d.endAngle * 180/Math.PI) + ')');
        return pathForegroundCircle;
      };
    });
  };

  Skill.prototype.animate_process = function(self) {
    var oldValue = 0;
    self.pathForeground.transition()
      .duration(750)
      .ease('cubic')
      .call(self.arcTweenOld, self, self.percent, oldValue);

    self.middleTextCount.transition()
      .delay(1500)
      .duration(750)
      .style('opacity', 0);

    self.middleTextTitle.transition()
      .delay(2250)
      .duration(500)
      .style('opacity', 1);

    oldValue = self.percent;
    self.percent = (Math.random() * 60) + 20;
  }

  Skill.prototype.animate = function() {
    var self = this;
    setTimeout(function() {
      self.animate_process(self);
    }, self.delay);
  }

  var ended = false;
  var controller = new ScrollMagic.Controller();
  var skills = [];
  var timeout = 700;
  var i = 0;
  var delay = 0;
  $('.skills-wrapper .skill-chart').each(function() {
    delay = timeout * i++;
    skills.push(new Skill('#' + $(this).attr('id'), JSON.parse($(this).attr('data-colors')), $(this).attr('data-percent'), $(this).attr('data-text'), delay));
  });

  new ScrollMagic.Scene({
    triggerElement: '#trigger-skills'
  })
  .addTo(controller)
  .on("start", function (e) {
    if (!ended) {
      for (var i=0; i < skills.length; i++) {
        skills[i].animate();
      }
      ended = true;
    }
	});
})(jQuery);

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

//# sourceMappingURL=all.js.map
