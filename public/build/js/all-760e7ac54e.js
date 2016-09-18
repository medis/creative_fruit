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
  var percent = 55;


    var pie=d3.layout.pie()
            .value(function(d){return d})
            .sort(null);

    var w=300,h=320;

    var outerRadius=(w/2)-10;
    var innerRadius=outerRadius-8;


    var color = ['#ec1561','#2a3a46','#202b33'];

    //The circle is following this
    var arcDummy=d3.svg.arc()
            .innerRadius((outerRadius-innerRadius)/2+innerRadius)
            .outerRadius((outerRadius-innerRadius)/2+innerRadius)
            .startAngle(0);


    var pathinfo = [{x:0, y:0},
                    {x:0, y:30}];

    var d3line2 = d3.svg.line()
                        .x(function(d){return d.x;})
                        .y(function(d){return d.y;})
                        .interpolate("linear");


    var arcLine=d3.svg.arc()
            .innerRadius(innerRadius)
            .outerRadius(outerRadius)
            .startAngle(0);

    var svg=d3.select("#chart")
            .append("svg")
            .attr({
                width:w,
                height:h,
                class:'shadow'
            }).append('g')
            .attr({
                transform:'translate('+w/2+','+h/2+')'
            });

    var pathForeground=svg.append('path')
            .datum({endAngle:0})
            .attr({
                d:arcLine
            })
            .style({
                fill:color[0]
            });

    //Dummy Arc for Circle
    var pathDummy=svg.append('path')
            .datum({endAngle:0})
            .attr({
                d:arcDummy
            }).style({
                fill:color[0]
            });

    var endLine = svg.append('path')
            .attr("d", d3line2(pathinfo))
            .style({
                stroke:color[0],
                'stroke-width':8,
                fill:color[2]
            });

    var middleTextCount=svg.append('text')
            .datum(0)
            .text(function(d){
                return d+'%';
            })

            .attr({
                class:'middleText',
                'text-anchor':'middle',
                dy:25,
                dx:0
            })
            .style({
                fill:'#ec1561',
                'font-size':'80px'

            });


    var arcTweenOld=function(transition, percent,oldValue) {
        transition.attrTween("d", function (d) {

            var newAngle=(percent/100)*(2*Math.PI);

            var interpolate = d3.interpolate(d.endAngle, newAngle);

            var interpolateCount = d3.interpolate(oldValue, percent);


            return function (t) {
                d.endAngle = interpolate(t);
                var pathForegroundCircle = arcLine(d);

                middleTextCount.text(Math.floor(interpolateCount(t))+'%');

                var pathDummyCircle = arcDummy(d);
                var coordinate = pathDummyCircle.split("L")[1].split("A")[0];

                endLine.attr('transform', 'translate(' + coordinate + ')' + 'rotate(' + (d.endAngle * 180/Math.PI) + ')');

                return pathForegroundCircle;
            };
        });
    };

    var oldValue=0;

    var animate=function(){
        pathForeground.transition()
                .duration(750)
                .ease('cubic')
                .call(arcTweenOld,percent,oldValue);

        oldValue=percent;
        percent=(Math.random() * 60) + 20;
        setTimeout(animate,3000);
    };

    setTimeout(animate,0);
})(jQuery);

//# sourceMappingURL=all.js.map
