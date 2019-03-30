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
                           <td style="width:30%">Modified Date</td>
                           <td>
                             {{ $order->updated_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}
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
                           <td style="width:30%">Order Amount</td>
                           <td>
                             <b>Rs.{{ $order->orderAmount }}/-</b>
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
                 <h4 class="box-title"> Requirement Details </h4>
                   <input type="hidden" id="reqCount" name="reqCount">
                   <table class="table table-bordered table-hover" id="tab_logic">
                     <thead>
                       <tr>
                         <th class="text-center">Product Details</th>
                         <th class="text-center">Art Work Design</th>
                         <th class="text-center">Customization Details</th>
                         <th class="text-center">Additional Details</th>
                       </tr>
                     </thead>
                     <tbody>
                     <?php $i = 0; ?>
                       @foreach ($enquiryRequirements as $enquiryReq)
                         <tr id='addr<?php echo $i; ?>'>
                           <td style="width:22%;">
                             <b>Category</b> : {{ $enquiryReq->product_category }} <br><br>

                             <b>Description</b> : {{ $enquiryReq->product_description }} <br><br>

                             @if($enquiryReq->status == 'Approved')
                               <span class="label label-success">Approved</span>
                             @elseif ($enquiryReq->status == 'Hold')
                               <span class="label label-warning">Hold</span>
                             @else
                               <span class="label label-danger">Cancel</span>
                             @endif
                           </td>
                           <td style="width:15%;">
                             {{ $enquiryReq->art_work_notes }}
                           </td>
                           <td style="width: 32%;">
                             <b>Product Features</b>
                             <ul>
                               <li>Product Style : @if($enquiryReq->product_style == '0' || $enquiryReq->product_style == null) N/A @else {{ $enquiryReq->product_style }} @endif</li>
                               <li>Material : @if($enquiryReq->material == '0' || $enquiryReq->material == null) N/A @else {{ $enquiryReq->material }} @endif</li>
                               <li>Quantity : @if($enquiryReq->quantity == '0' || $enquiryReq->quantity == null) N/A @else {{ $enquiryReq->quantity }} @endif</li>
                               <li>Quality : @if($enquiryReq->quality == '0' || $enquiryReq->quality == null) N/A @else {{ $enquiryReq->quality }} @endif</li>
                               <li>Fabric: @if($enquiryReq->fabric == '0' || $enquiryReq->fabric == null) N/A @else {{ $enquiryReq->fabric }} @endif</li>
                               @if($enquiryReq->additional_features != '0' && $enquiryReq->additional_features != null && $enquiryReq->additional_features != 'N/A')
                                 <li>{{ $enquiryReq->additional_features }}<li>
                               @endif
                             </ul>

                             <b>Product Customizations</b>
                             <ul>
                               <li>Colour: @if($enquiryReq->colour == '0' || $enquiryReq->colour == null) N/A @else {{ $enquiryReq->colour }} @endif</li>
                               <li>Print Methods: @if($enquiryReq->print_methods == '0' || $enquiryReq->print_methods == null) N/A @else {{ $enquiryReq->print_methods }} @endif</li>
                               <li>Print Placements: @if($enquiryReq->print_placements == '0' || $enquiryReq->print_placements == null) N/A @else {{ $enquiryReq->print_placements }} @endif</li>
                               <li>Print Area: @if($enquiryReq->print_area == '0' || $enquiryReq->print_area == null) N/A @else {{ $enquiryReq->print_area }} @endif</li>
                               <li>Measurements: @if($enquiryReq->measurements == '0' || $enquiryReq->measurements == null) N/A @else {{ $enquiryReq->measurements }} @endif</li>
                               @if($enquiryReq->additional_customizations != '0' && $enquiryReq->additional_customizations != null && $enquiryReq->additional_customizations != 'N/A')
                                 <li>{{ $enquiryReq->additional_customizations }}<li>
                               @endif
                             </ul>
                           </td>
                           <td>
                             <b>Finishing</b> : @if($enquiryReq->finishing == '0' || $enquiryReq->finishing == null) N/A @else {{ $enquiryReq->finishing }} @endif <br><br>
                             <b>Packaging</b> : @if($enquiryReq->packaging == '0' || $enquiryReq->packaging == null) N/A @else {{ $enquiryReq->packaging }} @endif <br><br>
                             <b>Inclusive</b> : @if($enquiryReq->inclusive == '0' || $enquiryReq->inclusive == null) N/A @else {{ $enquiryReq->inclusive }} @endif <br><br>
                             <b>Exclusive</b> : @if($enquiryReq->exclusive == '0' || $enquiryReq->exclusive == null) N/A @else {{ $enquiryReq->exclusive }} @endif <br><br>
                           </td>
                         </tr>
                         <?php $i++; ?>
                       @endforeach
                     </tbody>
                   </table>
               </table>

               <table class="table table-bordered table-striped">
                 <h4 class="box-title"> Billing Details </h4>
                   <tr>
                       <td style="width:30%">Billing Address</td>
                       <td>
                         <b>{{ $order->billingAddress }}</b>
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

              @if($order->orderStatus != 'ORDER COMPLETED')

                  <table class="table table-bordered table-striped" id="orderStatusUpdate">
                    <h4 class="box-title"> Status Updates </h4> <br>
                      <ul>
                      @foreach ($orderStatusUpdates as $statusUpdate)
                        <li> <b> On {{ $statusUpdate->creation_dttm}}, Mr. {{ $statusUpdate->user }} Added : </b> {{ $statusUpdate->comments }}</li> <br>
                      @endforeach
                      </ul>

                      <a href="#addStatusUpdateModal" class="btn btn-primary ml-2" data-toggle="modal"> Add Update </a>

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

                <table class="table table-bordered table-striped">
                  @if($order->proformaInvoiceNumber != '///////////////')
                    <h4 class="box-title"> Order Documents </h4>
                  @endif
                  @if($order->purchaseOrderNumber != '///////////////')
                    <tr>
                        <td> Purchase Order </td>
                        <td>
                          <a style="width:30%;" href="{{ URL::to('/') }}/order/admin/purchaseOrder/display/{{ $order->id }}/{{ $order->enquiry_id}}" class="btn btn-success ml-2" target="_blank"> View Purchase Order </a>
                        </td>
                    </tr>
                  @endif
                  @if($order->proformaInvoiceNumber != '///////////////')
                    <tr>
                        <td> Proforma Invoice </td>
                        <td>
                          <a style="width:30%;" href="{{ URL::to('/') }}/order/proformaInvoice/display/{{ $order->id }}/{{ $order->enquiry_id }}" class="btn btn-success ml-2" target="_blank">View Proforma Invoice</a>
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
                        <td> Vendor Payments </td>
                        <td>
                          <a style="width:30%;" href="{{ URL::to('/') }}/order/admin/vendor/paymentReceipt/display/{{ $order->id }}" class="btn btn-success ml-2" target="_blank">View Vendor Payments</a>
                        </td>
                    </tr>
                  @endif
                  @if(count($order->deliveryChallans()->get()) > 0)
                    <tr>
                        <td> Delivery Challan </td>
                        @php
                          $orderDeliveryChallans = $order->deliveryChallans()->select('delivery_challan_code')->distinct()->get();
                        @endphp
                        <td>
                        @foreach($orderDeliveryChallans as $deliveryChallan)
                            <a style="width:30%;" href="{{ URL::to('/') }}/order/deliveryChallan/display/{{ $order->id }}/{{ $deliveryChallan->delivery_challan_code }}" class="btn btn-success ml-2" target="_blank">DC- {{ $deliveryChallan->delivery_challan_code }}</a>
                            <br><br>
                        @endforeach
                        </td>
                    </tr>
                  @endif
                  @if($order->invoiceDate != null)
                    <tr>
                        <td> Tax Invoice </td>
                        <td>
                          <a style="width:30%;" href="{{ URL::to('/') }}/order/invoice/display/{{ $order->id }}/{{ $order->enquiry_id }}" class="btn btn-success ml-2" target="_blank">View Tax Invoice</a>
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

@endsection
