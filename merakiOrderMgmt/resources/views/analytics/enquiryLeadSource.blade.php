@extends('layouts.template')

@section('loadCustomJs')
  <script src="https://d3js.org/d3.v5.min.js"></script>
@endsection

@section('printCss')
  <style type="text/css">

      .highlight {
          fill: #Ffce37;
      }
      .arc text {
          fill: white;
          font-weight: bold;
          font: 14px sans-serif;
          text-anchor: middle;
      }

      .arc path {
          stroke: #fff;
      }

      .title {
          fill: teal;
          font-weight: bold;
      }
  </style>
@endsection

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Lead Source Analytics | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-body" style="height:600px;">
          <div class="row">
            <div class="col-md-4">
              <table class="table table-bordered table-striped">
                <h4 class="box-title"> Lead Sources </h4>
                  @for($i=0; $i<count($leadSourceArr); $i++)
                    <tr>
                        <td><b>{{ $leadSourceArr[$i] }}</b></td>
                        <td style="width: 40%;"><b>{{ $percentArr[$i] }} % </b></td>
                    </tr>
                  @endfor
              </table>
            </div>
            <div class="col-md-8">
              <center>
                <svg id="svgPieChart"/>
              </center>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
@endsection

@section('d3VisualizationJs')
    <script>

          var width = 500;
          var height = 500;

          // Canvas
          var canvas = d3.select("svg")
                         .attr("width", width)
                         .attr("height", height);

          var radius = Math.min(width, height)/2;

          var g = canvas.append("g")
                .attr("transform", "translate(" + width/2 + ", " + height/2 + ")");

          var pie = d3.pie().value(function(d) {
                  return d.percent;
          });

          var path = d3.arc()
                       .outerRadius(radius)
                       .innerRadius(0);

          var label = d3.arc()
                        .outerRadius(radius)
                        .innerRadius(radius - 200);

          d3.json("/leadSource/jsonData/get")
            .then(function(data) {

              var colorsArr = ['#4daf4a','#377eb8','#ff7f00','#984ea3','#e41a1c'];

              var arc = g.selectAll(".arc")
                          .data(pie(data))
                          .enter()
                          .append("g")
                          .attr("class", "arc");

              arc.append("path")
                 .attr("d", path)
                 .on("mouseover", onMouseOver)
                 .on("mouseout", onMouseOut)
                 .attr("fill", function(d, i) {
                    var k = i;
                    if(i>colorsArr.length) {
                        k = i - colorsArr.length;
                    }
                    return colorsArr[k];
                 });

              arc.append("text")
                 .attr("transform", function(d) {
                      return "translate(" + label.centroid(d) + ")";
                  })
                 .text(function(d) {
                      return d.data.source;
                  });

             });

             function onMouseOver(d, i) {
                 d3.select(this).attr("class", "highlight");
             }

             function onMouseOut(d, i) {
                 d3.select(this).attr("class", "arc");
             }

    </script>

@endsection
