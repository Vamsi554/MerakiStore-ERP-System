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
              <h3 class="box-title"> Order - <span style="color:#Ffce37;"><b>{{ $order->documentNumber }}, {{ $order->orderStatus }}</b></span></h3>
            </div>

            <div class="box-body">
              @if(Session::has('success'))
                  <div id="alertMsg" class="alert alert-success" style="display: inline-block;">
                     {{ Session::get('success') }}
                        @php
                         Session::forget('success');
                        @endphp
                   </div>
               @endif

               @if(Session::has('error'))
                   <div class="alert alert-danger" style="display: inline-block;">
                      {{ Session::get('error') }}
                         @php
                          Session::forget('error');
                         @endphp
                    </div>
                @endif

                <div class="row">
                  <div class="col-md-5">
                    <table class="table table-bordered table-striped">
                      <h4 class="box-title"> Basic Details </h4>
                        <tr>
                            <td style="width:30%">Email Address</td>
                            <td>
                              {{ $order->email }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width:30%">Document Number</td>
                            <td>
                              <b>{{ $order->documentNumber }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:30%">Creation Date</td>
                            <td>
                              {{ $order->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width:40%">Last Modified <br>Date</td>
                            <td>
                              {{ $order->updated_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width:30%">Order Amount</td>
                            <td>
                              <b>Rs.{{ $order->orderAmount }}/-</b>
                            </td>
                        </tr>
                     </table>
                  </div>
                  <div class="col-md-7">
                    <table class="table table-bordered table-striped">
                      <h4 class="box-title"> Order Details </h4>
                        <tr>
                            <td style="width:30%">Expected Delivery</td>
                            <td>
                              <b>{{ date('d-M-Y', strtotime($order->expectedDelivery)) }}</b>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:30%">Vendor Amount</td>
                            <td>
                              @if($order->vendorAmount > 0)
                                <b>{{ $order->vendorAmount }}</b>
                              @else
                                N/A
                              @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:30%">Gross Profit Margin</td>
                            <td>
                              @if($order->vendorAmount > 0)
                                <b>{{ $order->orderAmount - $order->vendorAmount }}</b>
                              @else
                                N/A
                              @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:30%">Order Details</td>
                            <td>
                              {{ $order->orderDetails }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width:30%">Order Summary</td>
                            <td>
                              {{ $order->orderSummary }}
                            </td>
                        </tr>
                     </table>
                  </div>
                </div>


               <table class="table table-bordered table-striped">
                 <h4 class="box-title"> Enquiry / Merchandise Details </h4>
                   <tr>
                       <td style="width:30%">Enquiry Details</td>
                       <td>
                         <a href="{{ URL::to('/') }}/enquiry/displayEnquiry/{{ $enquiry->id }}" class="btn btn-success" target="_blank">View Enquiry</a>
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Approved Quotation</td>
                       <td>
                         <a href="{{ URL::to('/') }}/enquiry/quotation/{{ $enquiry->id }}/{{ $enquiryQuote[0]->quotation_code }}" class="btn btn-warning" target="_blank">{{ $enquiryQuote[0]->quotation_code }}</a>
                       </td>
                   </tr>
                </table>

               <table class="table table-bordered table-striped">
                 <h4 class="box-title"> Billing Details </h4>
                   <tr>
                       <td style="width:30%">Billing Address</td>
                       <td>
                         {{ $order->billingAddress }}
                       </td>
                   </tr>
                </table>

                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> Shipment Details </h4>
                     <tr>
                         <td style="width:30%">Shipment Address</td>
                         <td>
                           {{ $order->shipmentAddress }}
                         </td>
                     </tr>
                     <tr>
                         <td style="width:30%">Contact Person at Shipment</td>
                         <td>
                           {{ $order->contactPersonAtShipment }}
                         </td>
                     </tr>
                     <tr>
                         <td style="width:30%">Contact Number at Shipment</td>
                         <td>
                           {{ $order->contactNumberAtShipment }}
                         </td>
                     </tr>
                     <tr>
                         <td style="width:30%">Concerned Lead</td>
                         <td>
                           {{ $order->concernedLead }}
                         </td>
                     </tr>
                  </table>

                  @if($order->orderStatus == 'ORDER DELIVERED' || $order->orderStatus == 'ORDER COMPLETED')
                  <table class="table table-bordered table-striped">
                    <h4 class="box-title"> Post-Order Delivery </h4>
                    <tr>
                        <td style="width:30%">Client Feedback</td>
                        <td>
                          {{ $order->clientFeedback }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Comments</td>
                        <td>
                          {{ $order->postOrderDeliveryComments }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">All Documents Verified with Client & Manager</td>
                        <td>
                          Yes
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Concerned Lead Signature</td>
                        <td>
                          {{ $order->concernedLead }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Manager Signature</td>
                        <td>
                          {{ $enquiry->name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Admin Signature</td>
                        <td>
                          {{ $order->concernedLead }}
                        </td>
                    </tr>
                  </table>
                @endif

            @if($order->orderStatus != 'ORDER COMPLETED')

              <table class="table table-bordered table-striped">
                <h4 class="box-title"> Status Updates </h4> <br>
                  <ul>
                  @foreach ($orderStatusUpdates as $statusUpdate)
                    <li> <b> On {{ $statusUpdate->creation_dttm}}, Mr. {{ $statusUpdate->user }} Added : </b> {{ $statusUpdate->comments }}</li> <br>
                  @endforeach
                  </ul>

                  <a href="#addStatusUpdateModal" class="btn btn-primary ml-5" data-toggle="modal"> Add Update </a>

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

               </table>
             @endif

                <table class="table table-bordered table-striped">
                  <h4 class="box-title"> Status Transitions </h4>
                  <tr>
                      <td style="width:30%"> Order Status</td>
                      @if($order->orderStatus == 'REQUEST FOR ORDER CONFIRMATION')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-success ml-2" type="submit">CONFIRM ORDER</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/cancel/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Cancel The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-danger ml-2" type="submit">CANCEL ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'ORDER ON HOLD')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-success ml-2" type="submit">CONFIRM ORDER</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/cancel/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Cancel The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-danger ml-2" type="submit">CANCEL ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'ORDER CANCELLED')
                        <td>
                          Order Has Been Cancelled.
                        </td>
                      @endif
                      @if($order->orderStatus == 'ORDER CONFIRMED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/confirmProformaTechPack/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Proforma Invoice And Tech Pack?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-success ml-2" type="submit">CONFIRM PROFORMA INVOICE & TECH PACK</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'PROFORMA INVOICE & TECH PACK GENERATED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/reqAdvPayment/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Continue With Advance Payment Request?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-info ml-2" type="submit">REQUEST FOR ADVANCE PAYMENT</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'REQUEST FOR ADVANCE PAYMENT')
                        <td>
                          Requested Customer To Make An Advance Payment Towards The Order
                        </td>
                      @endif
                      @if($order->orderStatus == 'REQUEST FOR PENDING PAYMENT')
                        <td>
                          Requested Customer To Make Pending Payment Towards The Order
                        </td>
                      @endif
                      @if($order->orderStatus == 'ADVANCE PAYMENT MADE. AWAITING ADMIN CONFIRMATION')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/reqAdvPayment/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Payment Made?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-info ml-2" type="submit">CONFIRM ADVANCE PAYMENT</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/reqAdvPayment/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Continue With Advance Payment Request?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-info ml-2" type="submit">RE-REQUEST FOR ADVANCE PAYMENT</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'ADVANCE PAYMENT CONFIRMED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/paymentReceipt/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Payment Receipt?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">CONFIRM PAYMENT RECEIPT</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'ADVANCE PAYMENT RECEIPT GENERATED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/purchaseOrder/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Purchase Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">CONFIRM PURCHASE ORDER</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'PURCHASE ORDER CREATED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/production/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Order To Production?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">CONFIRM ORDER TO PRODUCTION</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'ORDER SENT TO PRODUCTION')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/production/samples/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Continue with Requesting Production Samples For The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">REQUEST FOR PRODUCTION SAMPLES</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'PRODUCTION SAMPLES REQUESTED')
                        <td>
                          Production Samples Have Been Requested. Awating Production Team Response.
                        </td>
                      @endif
                      @if($order->orderStatus == 'PRODUCTION SAMPLES RECEIVED. AWAITING CUSTOMER CONFIRMATION')
                        <td>
                          Production Samples Have Been Received. Waiting for Customer Response.
                        </td>
                      @endif
                      @if($order->orderStatus == 'REVISED PRODUCTION SAMPLES RECEIVED. AWAITING CUSTOMER CONFIRMATION')
                        <td>
                          Revised Production Samples Have Been Received. Waiting for Customer Response.
                        </td>
                      @endif
                      @if($order->orderStatus == 'INCORPORATING CUSTOMER FEEDBACK. REQUEST FOR REVISED SAMPLES')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/production/revisedSamples/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Continue with Requesting Revised Production Samples For The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">REQUEST FOR REVISED PRODUCTION SAMPLES</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'REVISED PRODUCTION SAMPLES REQUESTED')
                        <td>
                          Revised Production Samples Requested.
                        </td>
                      @endif
                      @if($order->orderStatus == 'PRODUCTION SAMPLES CONFIRMED' || $order->orderStatus == 'REVISED PRODUCTION SAMPLES CONFIRMED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/production/bulkPrint/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Proceed With Bulk Printing For The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">PRODUCTION - PROCEED WITH BULK PRINTING</button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/hold/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Hold The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning ml-2" type="submit">HOLD ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'PRODUCTION BULK PRINTING CONFIRMED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/production/shipment/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Continue With Order Shipment?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">ORDER SHIPPED</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'ORDER SHIPPED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/deliveryChallan/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Continue With The Delivery Challans Generated?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">CONFIRM DELIVERY CHALLAN</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'DELIVERY CHALLAN GENERATED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/orderDelivery/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Order Delivery Is Successful?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">CONFIRM ORDER DELIVERY</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'ORDER DELIVERED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/taxInvoice/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Order Tax Invoice?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">CONFIRM TAX INVOICE</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'TAX INVOICE GENERATED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/pendingPayment/request/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Continue With Pending Payment Request With The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">REQUEST FOR PENDING PAYMENT</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'PENDING PAYMENT MADE. AWAITING ADMIN CONFIRMATION')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/fullPayment/confirm/{{ $order->id }}" onsubmit="return confirm('Are You Sure You've Received The Order Full Payment?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">CONFIRM FULL ORDER PAYMENT</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'FULL ORDER PAYMENT RECEIVED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/fullPaymentReceipt/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Confirm The Full Payment Receipt?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">CONFIRM FINAL PAYMENT RECEIPT</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'FINAL PAYMENT RECEIPT GENERATED')
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/order/admin/complete/confirm/{{ $order->id }}" onsubmit="return confirm('Do You Really Want To Conmplete The Order?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary ml-2" type="submit">COMPLETE ORDER</button>
                          </form>
                        </td>
                      @endif
                      @if($order->orderStatus == 'ORDER COMPLETED')
                        <td>
                          Order Completed.
                        </td>
                      @endif
                  </tr>
                </table>

                <table class="table table-bordered table-striped">
                  @if($order->orderStatus != 'ORDER COMPLETED')
                    <h4 class="box-title"> Action Items </h4>
                  @endif
                  @if($order->orderStatus == 'ADVANCE PAYMENT RECEIPT GENERATED')
                    <tr>
                        <td style="width:30%"> Purchase Order </td>
                        <td>
                          @if($order->purchaseOrderNumber != '///////////////')
                            <a href="{{ URL::to('/') }}/order/admin/purchaseOrder/update/{{ $order->id }}/{{ $order->enquiry_id}}/{{ $order->purchaseOrderNumber }}" class="btn btn-warning ml-2" style="width: 30%;"> Update Purchase Order </a>
                          @else
                            <a href="{{ URL::to('/') }}/order/admin/purchaseOrder/{{ $order->id }}/{{ $order->enquiry_id}}" class="btn btn-info ml-2" style="width: 30%;"> Raise Purchase Order </a>
                          @endif
                      </td>
                    </tr>
                  @endif

                  @if($order->orderStatus == 'ORDER CONFIRMED')
                    <tr>
                        <td style="width:30%"> Tech Pack </td>
                        <td>
                          <a href="{{ URL::to('/') }}/order/admin/techPack/{{ $order->id }}/{{ $order->enquiry_id }}" class="btn btn-info ml-2" style="width: 30%;">Generate Tech Pack</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%"> Proforma Invoice </td>
                        <td>
                          <a href="#proformaInvoiceModal" class="btn btn-info ml-2" style="width: 30%;" data-toggle="modal">Generate Proforma Invoice</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="proformaInvoiceModal" role="dialog" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="POST" action = "{{ URL::to('/') }}/order/admin/proformaInvoice/save/{{ $order->id }}/{{ $order->enquiry_id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"> Proforma Invoice Form </h4>
                            </div>
                            <div class="modal-body">
                              <b>Billing Address : </b> {{ $order->billingAddress }}
                              <br><br>
                              <b>Shipping Address : </b> {{ $order->shipmentAddress }}
                              <br><br>
                              <b>Client GST No : </b>
                              <input class="form-control" placeholder="Enter Client GST Number" type="text"
                              id="clientGstNum" name="clientGstNum" value="///////////////" required>
                              <br>
                              <b>Advance Payment (%) : </b>
                              <input class="form-control" placeholder="Enter Percentage Amount To Be Paid As Advance (Ranges from 0 - 50%)" type="number" id="advPayPer"
                              name="advPayPer" required>
                              <br>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @endif

                  @if($order->orderStatus != 'ORDER COMPLETED')
                    <tr>
                        <td style="width:30%"> Customer Payment Details </td>
                        <td>
                          @if(($order->orderAmount - $order->customerPayments()->sum('total_payment_amount')) > 1)
                            <a href="{{ URL::to('/') }}/order/admin/paymentReceipt/{{ $order->id }}" class="btn btn-info ml-2" style="width: 30%;">Record Customer Payments</a>
                          @else
                            Full Customer Payment Received
                          @endif
                        </td>
                    </tr>

                    @if($order->vendorAmount != 0)
                      <tr>
                          <td style="width:30%"> Vendor Payment Details </td>
                          <td>
                            @if(($order->vendorAmount - $order->vendorPayments()->sum('total_payment_amount')) > 1)
                              <a href="{{ URL::to('/') }}/order/admin/vendor/paymentReceipt/{{ $order->id }}" class="btn btn-info ml-2" style="width: 30%;">Record Vendor Payments</a>
                            @else
                              Full Vendor Payment Cleared
                            @endif
                          </td>
                      </tr>
                    @endif

                  @endif

                  @if($order->orderStatus == 'ORDER SHIPPED')
                    <tr>
                        <td style="width:30%"> Delivery Challan </td>
                        <td>
                          <a href="#deliveryChallanModal" class="btn btn-info ml-2" style="width: 30%;" data-toggle="modal">Generate Delivery Challan</a>
                        </td>
                    </tr>
                  @endif

                  @if($order->orderStatus == 'ORDER DELIVERED')
                    <tr>
                        <td style="width:30%"> Tax Invoice </td>
                        <td>
                          <a href="#taxInvoiceModal" class="btn btn-info ml-2" style="width: 30%;" data-toggle="modal">Generate Invoice</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="taxInvoiceModal" role="dialog" tabindex="-1" autocomplete="off">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="POST" action = "{{ URL::to('/') }}/order/admin/invoice/save/{{ $order->id }}/{{ $order->enquiry_id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"> Tax Invoice Form </h4>
                            </div>
                            <div class="modal-body">
                              <b>Billing Address : </b> {{ $order->billingAddress }}
                              <br><br>
                              <b>Client GST No : </b>
                              <input class="form-control" placeholder="Enter Client GST Number" type="text"
                              id="clientGstNum" name="clientGstNum" value="{{ $order->client_gst_number }}" required>
                              <br>
                              <b>Invoice Date : </b>
                              <input class="form-control" type="date" id="invoiceGenDate"
                              name="invoiceGenDate" required>
                              <br>
                              <b>Invoice Due Date : </b>
                              <input class="form-control" type="date" id="invoiceDueDate"
                              name="invoiceDueDate" required>
                              <br>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  @endif
                </table>

                <table class="table table-bordered table-striped">
                  @if($order->proformaInvoiceNumber != '///////////////')
                    <h4 class="box-title"> Order Documents </h4>
                  @endif
                  @if($order->purchaseOrderNumber != '///////////////')
                    <tr>
                        <td style="width:30%"> Purchase Order </td>
                        <td>
                          <a href="{{ URL::to('/') }}/order/admin/purchaseOrder/display/{{ $order->id }}/{{ $order->enquiry_id}}" class="btn btn-success ml-2" style="width: 30%;" target="_blank"> View Purchase Order </a>
                        </td>
                    </tr>
                  @endif
                  @if($order->proformaInvoiceNumber != '///////////////')
                    <tr>
                        <td style="width:30%"> Proforma Invoice </td>
                        <td>
                          <a href="{{ URL::to('/') }}/order/proformaInvoice/display/{{ $order->id }}/{{ $order->enquiry_id }}" class="btn btn-success ml-2" style="width: 30%;" target="_blank">View Proforma Invoice</a>
                        </td>
                    </tr>
                  @endif

                  @if($order->techPackNumber != '///////////////')
                    <tr>
                        <td style="width:30%"> Tech Pack </td>
                        <td>
                          <a href="{{ URL::to('/') }}/order/techPack/display/{{ $order->id }}/{{ $order->enquiry_id }}" class="btn btn-success ml-2" style="width: 30%;" target="_blank">View Tech Pack</a>
                        </td>
                    </tr>
                  @endif

                  @if(count($order->customerPayments()->get()) > 0)
                    <tr>
                        <td> Customer Payments </td>
                        @php
                          $customerPayments = $order->customerPayments()->select('cust_pay_code')->distinct()->get();
                        @endphp
                        <td>
                        @foreach($customerPayments as $payment)
                            <a style="width:30%;" href="{{ URL::to('/') }}/order/paymentReceipt/display/{{ $order->id }}/{{ $payment->cust_pay_code }}"
                              class="btn btn-success ml-2" target="_blank">{{ $payment->cust_pay_code }}</a>
                            <br><br>
                        @endforeach
                        </td>
                    </tr>
                  @endif
                  @if(count($order->vendorPayments()->get()) > 0)
                    <tr>
                        <td style="width:30%;"> Vendor Payments </td>
                        <td>
                          <a style="width:30%;" href="{{ URL::to('/') }}/order/admin/vendor/paymentReceipt/display/{{ $order->id }}" class="btn btn-success ml-2" target="_blank">View Vendor Payments</a>
                        </td>
                    </tr>
                  @endif
                  @if(count($order->deliveryChallans()->get()) > 0)
                    <tr>
                        <td style="width:30%"> Delivery Challan </td>
                        @php
                          $orderDeliveryChallans = $order->deliveryChallans()->select('delivery_challan_code')->distinct()->get();
                        @endphp
                        <td>
                        @foreach($orderDeliveryChallans as $deliveryChallan)
                            <a href="{{ URL::to('/') }}/order/deliveryChallan/display/{{ $order->id }}/{{ $deliveryChallan->delivery_challan_code }}" class="btn btn-success ml-2" target="_blank" style="width:30%;">DC - {{ $deliveryChallan->delivery_challan_code }}</a>
                            <br><br>
                        @endforeach
                        </td>
                    </tr>
                  @endif
                  @if($order->invoiceDate != null)
                    <tr>
                        <td style="width:30%"> Tax Invoice </td>
                        <td>
                          <a href="{{ URL::to('/') }}/order/invoice/display/{{ $order->id }}/{{ $order->enquiry_id }}" class="btn btn-success ml-2" style="width: 30%;" target="_blank">View Tax Invoice</a>
                        </td>
                    </tr>
                  @endif
                </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!-- Delivery Challan Modal -->
  <div class="modal fade" id="deliveryChallanModal" role="dialog" tabindex="-1" autocomplete="off">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action = "{{ URL::to('/') }}/order/admin/deliveryChallan/save/{{ $order->id }}/{{ $order->enquiry_id }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Delivery Challan Form </h4>
          </div>
          <div class="modal-body">
            <b>Billing Address : </b> {{ $order->billingAddress }}
            <br><br>
            <b>Delivery Address : </b> {{ $order->shipmentAddress }}
            <br><br>
            <b>Way Bill No : </b>
            <input class="form-control" placeholder="Enter Way Bill Number" type="text"
            id="wayBillNum" name="wayBillNum" required>
            <br>
            <b>Place Of Supply : </b>
            <input class="form-control" placeholder="Enter Place Of Supply" type="text"
            id="placeOfSupply" name="placeOfSupply" value="{{ $enquiry->eventPlace }}" required>
            <br>
            @php
              $orderDeliveryChallan = $order->deliveryChallans()->get();
            @endphp
            @if(count($orderDeliveryChallan) > 0)
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Production Description</th>
                    <th class="text-center">Quantity Ordered</th>
                    <th class="text-center">Quantity Delivered</th>
                    <th class="text-center">Quantity Pending</th>
                  </tr>
                </thead>
                <tbody class="table">
                  @for($m=0; $m<count($orderDeliveryChallan); $m++)
                    <tr>
                      <td>
                        <b>{{ $orderDeliveryChallan[$m]->product_description }}</b>
                      </td>
                      <td>
                        <b>{{ $orderDeliveryChallan[$m]->total_quantity }}</b>
                      </td>
                      <td>
                        <b>{{ $orderDeliveryChallan[$m]->delivered_quantity }}</b>
                      </td>
                      <td>
                        <b>{{ $orderDeliveryChallan[$m]->balance_quantity }}</b>
                      </td>
                    </tr>
                  @endfor

                  @for($n=0; $n<count($enquiryQuote); $n++)
                    <tr>
                      <td>
                        <b>{{ $enquiryQuote[$n]->product_description }}</b>
                        <input class="form-control" type="hidden" id="prodDescrDC" name="prodDescrDC[]" value="{{ $enquiryQuote[$n]->product_description }}"/>
                      </td>
                      <td>
                        <b>{{ $enquiryQuote[$n]->quantity }}</b></td>
                        <input class="form-control" type="hidden" id="orderedQtyDC" name="orderedQtyDC[]" value="{{ $enquiryQuote[$n]->quantity }}"/>
                      <td>
                        <input class="form-control" type="number" id="deliveredQty" min="0" max="{{ $orderDeliveryChallan[$n]->balance_quantity }}" name="deliveredQtyDC[]" required>
                      </td>
                    </tr>
                  @endfor
                </tbody>
              </table>
              <br>
            @else
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Production Description</th>
                    <th class="text-center">Quantity Ordered</th>
                    <th class="text-center">Quantity Delivered</th>
                  </tr>
                </thead>
                <tbody class="table">
                  @foreach($enquiryQuote as $quoteEntry)
                    <tr>
                      <td>
                        <b>{{ $quoteEntry->product_description }}</b>
                        <input class="form-control" type="hidden" id="prodDescrDC" name="prodDescrDC[]" value="{{ $quoteEntry->product_description }}"/>
                      </td>

                      <td>
                        <b>{{ $quoteEntry->quantity }}</b></td>
                        <input class="form-control" type="hidden" id="orderedQtyDC" name="orderedQtyDC[]" value="{{ $quoteEntry->quantity }}"/>
                      <td>
                        <input class="form-control" type="number" id="deliveredQty" name="deliveredQtyDC[]" min="0" max="{{ $quoteEntry->quantity }}" required>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <br>
            @endif
            <b>Mode Of Transport : </b>
            <input class="form-control" placeholder="Enter The Mode Of Transport" type="text"
            id="modeOfTransport" name="modeOfTransport" required>
            <br>
            <b>Vehicle No : </b>
            <input class="form-control" placeholder="Enter The Vehicle Number" type="text"
            id="vehicleNum" name="vehicleNum" required>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection


@section('customJs')

<script type="text/javascript">

  $(document).ready(function() {

      $("#alertMsg").delay(5000).fadeOut();
  });
</script>
@endsection
