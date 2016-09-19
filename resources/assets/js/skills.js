(function($) {
  var ended = false;
  var controller = new ScrollMagic.Controller();
  new ScrollMagic.Scene({
    triggerElement: '#trigger-skills'
  })
  .addTo(controller)
  .on("start", function (e) {
    if (!ended) {
      if ($('.skills-wrapper .skill-chart').length) {
        var timeout = 700;
        var i = 0;
        $('.skills-wrapper .skill-chart').each(function() {
          var delay = timeout * i++;
          skill('#' + $(this).attr('id'), JSON.parse($(this).attr('data-colors')), $(this).attr('data-percent'), $(this).attr('data-text'), delay);
        });
      }
      ended = true;
    }
	})
  /*.on("start end", function (e) {
    $("#lastHit").text(e.type == "start" ? "top" : "bottom");
  });*/
  function skill(selector, color, percent, text, delay) {
    var pie=d3.layout.pie()
      .value(function(d){return d})
      .sort(null);

    var w=230,h=230;

    var outerRadius=(w/2.3)-10;
    var innerRadius=outerRadius-12;

    var arc=d3.svg.arc()
      .innerRadius(0)
      .outerRadius((outerRadius-innerRadius)/12+innerRadius)
      .startAngle(0)
      .endAngle(2*Math.PI);

    //The line is following this
    var arcDummy=d3.svg.arc()
      .innerRadius((outerRadius-innerRadius)/2+innerRadius)
      .outerRadius((outerRadius-innerRadius)/2+innerRadius)
      .startAngle(0);

    var d3line2 = d3.svg.line()
      .x(function(d){return d.x;})
      .y(function(d){return d.y;})
      .interpolate("linear");


    var arcLine=d3.svg.arc()
      .innerRadius(innerRadius + 1)
      .outerRadius(outerRadius)
      .startAngle(0);

    var svg=d3.select(selector)
      .append("svg")
      .attr({
          width:w,
          height:h,
          class:'shadow'
      }).append('g')
      .attr({
          transform:'translate('+w/2+','+h/2+')'
      });

    var vertrical_line_path = [
      {x:0, y: -h/2 + 2},
      {x:0, y: h/2 - 2}
    ];

    var vertrical_line = svg.append('path')
      .attr("d", d3line2(vertrical_line_path))
      .style({
          stroke:color[0],
          'stroke-width':4,
          'stroke-linecap': 'round',
          fill:color[0]
      });

    //background
    var path=svg.append('path')
      .attr({
          d:arc
      })
      .style({
          fill:color[1]
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

    var pathinfo = [{x:0, y:3},
                    {x:0, y:-20}];

    var endLine = svg.append('path')
      .attr("d", d3line2(pathinfo))
      .style({
          stroke:color[0],
          'stroke-width':4,
          'stroke-linecap': 'round',
          fill:color[0],
          'opacity': 0
      });

    var middleTextTitle=svg.append('text')
      .datum(0)
      .text(text)
      .attr({
          class:'middleText',
          'text-anchor':'middle',
          dy: 25,
          dx:0
      })
      .style({
          fill: color[0],
          'font-size':'70px',
          'opacity': 0,
          'font-weight': 'bold'
      });

    var middleTextCount=svg.append('text')
      .datum(0)
      .text(function(d){
          return d+'%';
      })

      .attr({
          class:'middleText',
          'text-anchor':'middle',
          dy: 15,
          dx:0
      })
      .style({
          fill: color[0],
          'font-size':'50px'
      });


    var arcTweenOld=function(transition, percent,oldValue) {
      transition.attrTween("d", function (d) {
        var newAngle= -1 * (percent/100)*(2*Math.PI);
        var interpolate = d3.interpolate(d.endAngle, newAngle);
        var interpolateCount = d3.interpolate(oldValue, percent);
        return function (t) {
          d.endAngle = interpolate(t);
          var pathForegroundCircle = arcLine(d);
          middleTextCount.text(Math.floor(interpolateCount(t))+'%');
          var pathDummyCircle = arcDummy(d);
          var coordinate = pathDummyCircle.split("L")[1].split("A")[0];
          endLine.style('opacity', 1).attr('transform', 'translate(' + coordinate + ')' + 'rotate(' + (d.endAngle * 180/Math.PI) + ')');
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

      middleTextCount.transition()
        .delay(1500)
        .duration(750)
        .style('opacity', 0);

      middleTextTitle.transition()
        .delay(2250)
        .duration(500)
        .style('opacity', 1);

      oldValue=percent;
      percent=(Math.random() * 60) + 20;
    };

    setTimeout(animate, delay);
  }
})(jQuery);
