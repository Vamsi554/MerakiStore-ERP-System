@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Order | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Order Form </h3>
            </div>

            <div class="box-body">
              @if(Session::has('success'))
                  <div class="alert alert-success" style="display: inline-block;">
                     {{ Session::get('success') }}
                        @php
                         Session::forget('success');
                        @endphp
                   </div>
               @endif

               <form method="POST" action="{{ URL::to('/') }}/order/addOrder/{{ $enquiry->id }}/{{ $quotationId }}" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="enquiryId" id="enquiryId" value="{{ $enquiry->id }}" >
                 <input type="hidden" name="orderCreDttm" id="orderCreDttm" value="{{ Carbon\Carbon::now()->toDateString() }}">

                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> Order Details </h4>
                       <tr class="{{ $errors->has('email') ? 'has-error' : '' }}">
                           <td style="width:30%">Email Address</td>
                           <td>
                             <input class="form-control" placeholder="Enter Email Address" type="email" id="email"
                             name="email" size="27" style="width:100%!important" value="{{ $enquiry->email }}" readonly="readonly">
                             <span class="text-danger">{{ $errors->first('email') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('documentNumber') ? 'has-error' : '' }}">
                           <td style="width:30%">Document Number</td>
                           <td>
                             <input class="form-control" placeholder="Enter Document Number" type="text" id="documentNumber"
                             name="documentNumber" size="27" style="width:100%!important" value="{{ $enquiry->documentNumber }}" readonly="readonly">
                             <span class="text-danger">{{ $errors->first('documentNumber') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('eventDate') ? 'has-error' : '' }}">
                           <td style="width:30%">Event Date</td>
                           <td>
                             <input class="form-control" type="text" id="eventDate"
                             name="eventDate" size="27" style="width:100%!important" value="{{ date('d-M-Y', strtotime($enquiry->eventDate)) }}" readonly="readonly">
                             <span class="text-danger">{{ $errors->first('eventDate') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('orderStatus') ? 'has-error' : '' }}">
                          <td style="width:30%">Order Status</td>
                          <td>
                            <select class="form-control" style="width: 100%;" id="orderStatus"
                            name="orderStatus" value="{{ old('orderStatus') }}">
                             <option selected="selected">REQUEST FOR ORDER CONFIRMATION</option>
                             <option>HOLD</option>
                             <option>CANCEL</option>
                           </select>
                            <span class="text-danger">{{ $errors->first('orderStatus') }}</span>
                          </td>
                       </tr>

                       <tr class="{{ $errors->has('expectedDelivery') ? 'has-error' : '' }}">
                           <td style="width:30%">Expected Delivery</td>
                           <td>
                             <input class="form-control" placeholder="Expected Delivery Date" type="date" id="expectedDelivery"
                             name="expectedDelivery" size="27" style="width:100%!important" value="{{ old('expectedDelivery') }}" required>
                             <span class="text-danger">{{ $errors->first('expectedDelivery') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('orderAmount') ? 'has-error' : '' }}">
                           <td style="width:30%">Order Amount</td>
                           <td>
                             <input class="form-control" placeholder="Order Amount" type="text" id="orderAmount"
                             name="orderAmount" size="27" style="width:100%!important" value="{{ $orderAmount }}" readonly="readonly">
                             <span class="text-danger">{{ $errors->first('orderAmount') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('orderDetails') ? 'has-error' : '' }}">
                           <td style="width:30%">Order Details</td>
                           <td>
                             <input class="form-control" placeholder="Order Details" type="text" id="orderDetails"
                             name="orderDetails" size="27" style="width:100%!important" value="{{ $orderDetails }}" readonly="readonly">
                             <span class="text-danger">{{ $errors->first('orderDetails') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('orderSummary') ? 'has-error' : '' }}">
                           <td style="width:30%">Order Summary</td>
                           <td>
                             <input class="form-control" placeholder="Order Summary" type="text" id="orderSummary"
                             name="orderSummary" size="27" style="width:100%!important" value="{{ $orderSummary }}" readonly="readonly">
                             <span class="text-danger">{{ $errors->first('orderSummary') }}</span>
                           </td>
                       </tr>
                  </table>

                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Billing/Shipment Details </h4>

                           <tr class="{{ $errors->has('billingAddress') ? 'has-error' : '' }}">
                               <td style="width:30%">Billing Address</td>
                               <td>
                                 <input class="form-control" placeholder="Organization Name / Address Line 1 / Address Line 2 / Address Line 3 / Pin Code" type="text" id="billingAddress"
                                 name="billingAddress" size="27" style="width:100%!important" value="{{ old('billingAddress') }}" required>
                                 <span class="text-danger">{{ $errors->first('billingAddress') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('shipmentAddress') ? 'has-error' : '' }}">
                               <td style="width:30%">Shipment Address</td>
                               <td>
                                 <input class="form-control" placeholder="Organization Name / Address Line 1 / Address Line 2 / Address Line 3 / Pin Code" type="text" id="shipmentAddress"
                                 name="shipmentAddress" size="27" style="width:100%!important" value="{{ old('shipmentAddress') }}" required>
                                 <span class="text-danger">{{ $errors->first('shipmentAddress') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('shipmentContactPerson') ? 'has-error' : '' }}">
                               <td style="width:30%">Contact Person</td>
                               <td>
                                 <input class="form-control" placeholder="Contact Person At Shipment Address" type="text" id="shipmentContactPerson"
                                 name="shipmentContactPerson" size="27" style="width:100%!important" value="{{ old('shipmentContactPerson') }}" required>
                                 <span class="text-danger">{{ $errors->first('shipmentContactPerson') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('shipmentContactNumber') ? 'has-error' : '' }}">
                               <td style="width:30%">Contact Number</td>
                               <td>
                                 <input class="form-control" placeholder="Contact Number At Shipment Address" type="text" id="shipmentContactNumber"
                                 name="shipmentContactNumber" size="27" style="width:100%!important" value="{{ old('shipmentContactNumber') }}" required>
                                 <span class="text-danger">{{ $errors->first('shipmentContactNumber') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('concernedLead') ? 'has-error' : '' }}">
                               <td style="width:30%">Concerned Lead Person</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Concerned Lead Person" type="text" id="concernedLead"
                                 name="concernedLead" size="27" style="width:100%!important" value="{{ $enquiry->concernedLeadPerson }}" readonly="readonly">
                                 <span class="text-danger">{{ $errors->first('concernedLead') }}</span>
                               </td>
                           </tr>
                      </table>

                      <!-- Commenting Code for Order Creation -->
                      <table class="table table-bordered table-striped">
                        <h4 class="box-title"> Post-Order Delivery </h4>
                            <tr class="{{ $errors->has('commentsPostDelivery') ? 'has-error' : '' }}">
                                <td style="width:30%">Comments</td>
                                <td>
                                  <input class="form-control" placeholder="Enter Comments Post Delivery" type="text" id="commentsPostDelivery"
                                  name="commentsPostDelivery" size="27" style="width:100%!important" value="{{ old('commentsPostDelivery') }}" >
                                  <span class="text-danger">{{ $errors->first('commentsPostDelivery') }}</span>
                                </td>
                            </tr>

                            <tr class="{{ $errors->has('clientFeedback') ? 'has-error' : '' }}">
                                <td style="width:30%">Client Feedback</td>
                                <td>
                                  <input class="form-control" placeholder="Enter Client Feedback" type="text" id="clientFeedback"
                                  name="clientFeedback" size="27" style="width:100%!important" value="{{ old('clientFeedback') }}" >
                                  <span class="text-danger">{{ $errors->first('clientFeedback') }}</span>
                                </td>
                            </tr>

                            <tr class="{{ $errors->has('concernedLead') ? 'has-error' : '' }}">
                                <td style="width:30%">Concerned Lead Person</td>
                                <td>
                                  <input class="form-control" placeholder="Enter Concerned Lead Person" type="text" id="concernedLead"
                                  name="concernedLead" size="27" style="width:100%!important" value="{{ $enquiry->concernedLeadPerson }}" disabled>
                                  <span class="text-danger">{{ $errors->first('concernedLead') }}</span>
                                </td>
                            </tr>
                      </table>

                  <button class="btn btn-primary" type="submit">Create Order</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
