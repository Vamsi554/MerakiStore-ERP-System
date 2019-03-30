@extends('layouts.template')

@section('loadCustomJs')
  <script src="https://d3js.org/d3.v5.min.js"></script>
@endsection

@section('printCss')
  <style type="text/css">
        #svgBarChart {
          text-align: center;
        }

        svg rect {
          fill: #Ffce37;
        }
        svg text{
          fill:white;
          font:15px sans-serif;
          font-weight: bold;
          text-anchor:end;
        }
  </style>
@endsection

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Clients vs Orders | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-body">
          <svg id="svgBarChart"/>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('d3VisualizationJs')
    <script>

          var width = 800;
          var scaleFactor = 10;
          var barHeight = 30;
          var height = 500;

          // Canvas
          var canvas = d3.select("svg")
                         .attr("width", width)
                         .attr("height", height);
          // X-Scale
          var xScale = d3.scaleBand().range([0, width]).padding(0.5);
          // Y-Scale
          var yScale = d3.scaleLinear().range([height, 0]);

          d3.json("/jsonData/get")
            .then(function(data) {

              var bar = canvas.selectAll("g")
                              .data(data)
                              .enter()
                              .append("g")
                              .attr("transform", function(d, i) {
                                  return "translate(0, " + i*barHeight + ")";
                              });

              xScale.domain(data.map(function(d) {
                  return d.client;
              }));

              yScale.domain([0, d3.max(data, function(d) {
                  return d.orders;
              })]);

              var xAxis = d3.axisBottom(xScale);

              canvas.append("g").call(xAxis);


              bar.append("rect")
                 .attr("width", function(d) {
                   return xScale(d.orders);
                 })
                 .attr("height", barHeight - 1);

              bar.append("text")
                .attr("x", function(d) { return (xScale(d.orders) - 2); })
                .attr("y", barHeight / 2)
                .attr("dy", ".5em")
                .text(function(d) { return d.orders + "%"; });

          });
    </script>
@endsection
