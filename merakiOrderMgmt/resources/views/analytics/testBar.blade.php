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
        .yAxisCls text {
          fill:#Ffce37;
        }
        .xAxisCls text {

          fill:#Ffce37;
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

          var width = 900;
          var barHeight = 30;
          var height = 500;

          // Canvas
          var canvas = d3.select("svg")
                         .attr("width", width)
                         .attr("height", height);

          // X-Scale
          var xScale = d3.scaleBand()
                         .range([0, width])
                         .padding(0.2);

          // Y-Scale
          var yScale = d3.scaleLinear()
                         .range([height, 0])
                         .domain([0, 100]);

          //X-Axis
          var xAxis = d3.axisBottom()
                        .scale(xScale)
                        .tickSize(5);

          // Y-Axis
          var yAxis = d3.axisLeft()
                        .scale(yScale)
                        .tickSize(5);

          // Build the Y-Axis
          canvas.append("g")
                .attr("class", "yAxisCls")
                .attr("transform", "translate(40, 10)")
                .call(yAxis);

          // Build the X-Axis
          canvas.append("g")
                .attr("class", "xAxisCls")
                .attr("transform", "translate(0, 480)")
                .call(xAxis);

          d3.json("/jsonData/get")
            .then(function(data) {

              var bar = canvas.selectAll("g")
                              .data(data)
                              .enter()
                              .append("g")
                              .attr("transform", function(d, i) {
                                  return "translate(0, " + i*barHeight + ")";
                              });


          });
    </script>
@endsection
