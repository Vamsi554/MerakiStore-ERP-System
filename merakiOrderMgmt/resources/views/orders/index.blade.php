@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        {{ $title }}
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order | Meraki Store</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(Session::has('success'))
                  <div id="alertMsg" class="alert alert-success" style="display: inline-block;">
                     {{ Session::get('success') }}
                        @php
                         Session::forget('success');
                        @endphp
                   </div>
               @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SNo</th>
                  <th>Organization</th>
                  <th>Order Status</th>
                  <th>Expected Delivery</th>
                  <th>Merchandise</th>
                  <th>Note</th>
                  <th>Action</th>
                  <th>View</th>
                  <th>Track</th>
                </tr>
                </thead>
                <tbody>
                @php
                  $sNo = 1
                @endphp
                @foreach ($orders as $order)
                  <tr>
                    <td>{{ $sNo++ }}</td>
                    <td>{{ $order->orderDetails }}</td>
                    <td>{{ $order->orderStatus }}</td>
                    @php
                      $createDate = $order->orderCreDttm;
                      $deliveryDate = $order->expectedDelivery;
                      $currentDate = \Carbon\Carbon::now("Asia/Kolkata");
                      $diff = abs(strtotime($deliveryDate) - strtotime($currentDate));
                      $years = floor($diff / (365*60*60*24));
                      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    @endphp
                    <td style="width:10%;">
                      {{ date('d-M-Y', strtotime($order->expectedDelivery)) }} <br><br>
                      @if($years > 0)
                        @if($years > 1)
                          {{ $years }} Years and
                        @else
                          {{ $years }} Year and
                        @endif
                      @endif
                      @if($months > 0)
                        @if($months > 1)
                          {{ $months }} Months and
                        @else
                          {{ $months }} Month and
                        @endif
                      @endif
                      @if($days > 0)
                        @if($days > 1)
                          {{ $days }} Days Left.
                        @else
                          {{ $days }} Day Left.
                        @endif
                      @endif
                    <td>{{ $order->orderSummary }} <br><br><b><i> Amount : Rs.{{ $order->orderAmount }}/- </i></b></td>
                    <td>
                      <a href="#addStatusUpdateModal" class="btn btn-primary ml-2" data-toggle="modal">Note</a>

                      <div class="modal fade" id="addStatusUpdateModal" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="POST" action = "{{ URL::to('/') }}/order/statusUpdate/save/{{ $order->id }}" autocomplete="off">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"> Add Status Update To This Order </h4>
                              </div>
                              <div class="modal-body">
                                <b>Document Number : </b> {{ $order->documentNumber }}
                                <br><br>
                                <b>Summary : </b> {{ $order->orderDetails }}
                                <br><br>
                                <b>Merchandise : </b> {{ $order->orderSummary }}
                                <br><br>
                                <b>Status : </b> {{ $order->orderStatus }}
                                <br><br>
                                <b>Note : </b> <br><br>
                                <textarea rows="4" cols="50" class="form-control" type="text" id="orderStatusUpdate"
                                name="orderStatusUpdate" size="100" style="width:100%!important"
                                value="{{ old('sampleDetailsComments') }}" required></textarea>
                                <br>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                    </td>
                    <td>
                      <a href="{{ URL::to('/') }}/order/updateOrder/{{ $order->id }}" class="btn btn-warning ml-2">Update</a>
                    </td>
                    <td>
                      <a href="{{ URL::to('/') }}/order/displayOrder/{{ $order->id }}" class="btn btn-info ml-2">View</a>
                    </td>
                    <td>
                      <a href="{{ URL::to('/') }}/order/lifecycle/{{ $order->id }}/{{ $order->enquiry_id }}" class="btn btn-success ml-2" target="_blank">Lifecycle</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <h4 class="text-capitalize"> Start creating new order by filling out the enquiry form below </h4>
      <br/>

      <a href="{{ URL::to('/') }}/enquiry/createEnquiry" class="btn btn-primary ml-2">Create Enquiry</a>

    </section>
  </div>

@endsection


@section('customJs')

<script type="text/javascript">

  $(document).ready(function() {

      $("#alertMsg").delay(5000).fadeOut();
  });
</script>
@endsection
