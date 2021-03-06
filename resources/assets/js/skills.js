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
