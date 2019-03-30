@extends('layouts.template')

@section('loadCustomJs')
  <script src="https://d3js.org/d3.v5.min.js"></script>
@endsection

@section('printCss')
  <style type="text/css">
        #svgBarChart {
          text-align: center;
        }
        .bar {
            fill: #ffae42;
        }

        .highlight {
            fill: steelblue;
        }

        .barText {
            fill: #727376;
            font:20px sans-serif;
            font-weight: bold;
            text-anchor:end;
        }
        svg text{
          fill:white;
          font:15px sans-serif;
          font-weight: bold;
          font-style: italic;
          text-anchor:end;
        }
        .yAxisCls text {
          fill:#727376;
          shape-rendering: crispEdges;
        }
        .xAxisCls text {
          fill:#727376;
          font-size: 12px;
          text-transform: uppercase;
          text-anchor:middle;
          shape-rendering: crispEdges;
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
        <div class="box-body" style="height:600px;">
          <svg id="svgBarChart"/>
        </div>
      </div>

      <div class="modal fade" id="customersOrderTrackModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Order </h4>
              </div>
              <div class="modal-body">
                <b>S No : <span id="sNo"></span></b>
                <br><br>
                <b>Client : <span id="client"></span></b>
                <br><br>
                <b>Order Percentage : <span id="ordersPer"></span></b>
                <br><br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
        </div>
      </div>

    </section>
  </div>
@endsection

@section('d3VisualizationJs')
    <script>

          var width = 920;
          var height = 520;

          // Canvas
          var canvas = d3.select("svg")
                         .attr("width", width)
                         .attr("height", height);

          // X-Scale
          var xScale = d3.scaleBand()
                         .range([0, width])
                         .padding(0.3);

          // Y-Scale
          var yScale = d3.scaleLinear()
                         .range([500, 0])
                         .domain([0, 100]);

          var g = canvas.append("g")
                .attr("transform", "translate(0, 0)");

          d3.json("/jsonData/get")
            .then(function(data) {

              xScale.domain(data.map(function(d) {
                return d.client;
              }));

              //X-Axis
              var xAxis = d3.axisBottom()
                            .scale(xScale)
                            .tickSize(5);

              // Build the X-Axis
              g.append("g")
                    .attr("class", "xAxisCls")
                    .attr("transform", "translate(20, 500)")
                    .call(xAxis)
                    .selectAll("text")
                    .attr("transform", "rotate(0)")
                    .style("text-anchor", "middle");

              // Y-Axis
              var yAxis = d3.axisLeft()
                            .scale(yScale)
                            .tickSize(5);

              // Build the Y-Axis
              g.append("g")
                    .attr("class", "yAxisCls")
                    .attr("transform", "translate(40, 10)")
                    .call(yAxis);

              var bar = g.selectAll(".bar")
                              .data(data)
                              .enter()
                              .append("g")
                              .attr("transform", "translate(35, 0)");

              bar.append("text")
                 .attr("class", "barText")
                 .attr("x", function(d) {
                   return xScale(d.client) + 50;
                 })
                 .attr("y", function(d) {
                   return yScale(d.orders) - 20 - 10;
                 })
                 .text(function(d) {
                    return "" + (d.orders+5) + "%";
                 });

              bar = bar.append("a")
                       .attr("href", "#customersOrderTrackModal")
                       .attr("data-toggle", "modal")
                       .attr("data-id", function(d, i) {
                         return i;
                       });

              bar.append("rect")
              .attr("class", "bar")
              .attr("id", function(d, i) {
                  return i;
              })
              .on("mouseover", onMouseOver)
              .on("mouseout", onMouseOut)
              .on("click", onBarClick)
              .attr("x", function(d) {
                return xScale(d.client);
              })
              .attr("y", function(d) {
                return yScale(d.orders) - 20;
              })
              .attr("width", d3.min([40, xScale.bandwidth()]))
              .attr("height", function(d) {
                return height - yScale(d.orders);
              });
          });

          function onMouseOver(d, i) {
              d3.select(this).attr("class", "highlight");
          }

          function onMouseOut(d, i) {
              d3.select(this).attr("class", "bar");
          }

          function onBarClick(d, i) {

              d3.select("#sNo").text(i+1);
              var clientsArr = <?php echo json_encode($clientsArr); ?>;
              var ordersArr = <?php echo json_encode($ordersArr); ?>;

              d3.select("#sNo").text(i+1);
              d3.select("#client").text(clientsArr[i]);
              d3.select("#ordersPer").text(ordersArr[i]);
          }

    </script>

@endsection
