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
              <h3 class="box-title"> Order - <span style="color:#Ffce37;"><b>{{ $order->documentNumber }}</b></span></h3>
            </div>

            <div class="box-body">
               <table class="table table-bordered table-striped">
                 <h4 class="box-title"> Order Details </h4>
                   <tr>
                       <td style="width:30%">Email Address</td>
                       <td>
                         {{ $order->email }}
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Document Number</td>
                       <td>
                         {{ $order->documentNumber }}
                       </td>
                   </tr>
                   <tr>
                      <td style="width:30%">Order Status</td>
                      <td>
                        {{ $order->orderStatus }}
                      </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Expected Delivery</td>
                       <td>
                         {{ $order->expectedDelivery }}
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Order Amount</td>
                       <td>
                         {{ $order->orderAmount }}
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

                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> Payment Details </h4>
                       <tr class="{{ $errors->has('totalOrderValue') ? 'has-error' : '' }}">
                           <td style="width:30%">Total Order Value (Rs) </td>
                           <td>
                             <input class="form-control" placeholder="Enter Total Order Value" type="text" id="totalOrderValue"
                             name="totalOrderValue" size="27" style="width:100%!important" value="{{ old('totalOrderValue') }}" >
                             <span class="text-danger">{{ $errors->first('totalOrderValue') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('advancePayment') ? 'has-error' : '' }}">
                           <td style="width:30%">Advance Payment Received (Rs) </td>
                           <td>
                             <input class="form-control" placeholder="Enter Advance Payment Amount" type="text" id="advancePayment"
                             name="advancePayment" size="27" style="width:100%!important" value="{{ old('advancePayment') }}" >
                             <span class="text-danger">{{ $errors->first('advancePayment') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('advancePmtRcvdDate') ? 'has-error' : '' }}">
                           <td style="width:30%">Advance Payment Received Date</td>
                           <td>
                             <input class="form-control" placeholder="Enter Advance Payment Received Date" type="date" id="advancePmtRcvdDate"
                             name="advancePmtRcvdDate" size="27" style="width:100%!important" value="{{ old('advancePmtRcvdDate') }}" >
                             <span class="text-danger">{{ $errors->first('advancePmtRcvdDate') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('advancePaymentMode') ? 'has-error' : '' }}">
                           <td style="width:30%">Advance Payment Mode</td>
                           <td>
                             <input class="form-control" placeholder="Enter Advance Payment Mode" type="text" id="advancePaymentMode"
                             name="advancePaymentMode" size="27" style="width:100%!important" value="{{ old('advancePaymentMode') }}" >
                             <span class="text-danger">{{ $errors->first('advancePaymentMode') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('transactionId') ? 'has-error' : '' }}">
                           <td style="width:30%">Transaction ID</td>
                           <td>
                             <input class="form-control" placeholder="Enter Transaction ID" type="text" id="transactionId"
                             name="transactionId" size="27" style="width:100%!important" value="{{ old('transactionId') }}" >
                             <span class="text-danger">{{ $errors->first('transactionId') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('creditAcntName') ? 'has-error' : '' }}">
                           <td style="width:30%">Credited Account Name</td>
                           <td>
                             <input class="form-control" placeholder="Person who received Cash" type="text" id="creditAcntName"
                             name="creditAcntName" size="27" style="width:100%!important" value="{{ old('creditAcntName') }}" >
                             <span class="text-danger">{{ $errors->first('creditAcntName') }}</span>
                           </td>
                       </tr>

                        <tr class="{{ $errors->has('chequeNumber') ? 'has-error' : '' }}">
                            <td style="width:30%">Cheque Number</td>
                            <td>
                              <input class="form-control" placeholder="Enter Cheque Number" type="text" id="chequeNumber"
                              name="chequeNumber" size="27" style="width:100%!important" value="{{ old('chequeNumber') }}">
                              <span class="text-danger">{{ $errors->first('chequeNumber') }}</span>
                            </td>
                        </tr>

                        <tr class="{{ $errors->has('bank') ? 'has-error' : '' }}">
                            <td style="width:30%">Bank</td>
                            <td>
                              <input class="form-control" placeholder="Enter Bank Details" type="text" id="bank"
                              name="bank" size="27" style="width:100%!important" value="{{ old('bank') }}">
                              <span class="text-danger">{{ $errors->first('bank') }}</span>
                            </td>
                        </tr>

                        <tr class="{{ $errors->has('duePmt') ? 'has-error' : '' }}">
                            <td style="width:30%">Due Payment</td>
                            <td>
                              <input class="form-control" placeholder="Enter Due Payment" type="text" id="duePmt"
                              name="duePmt" size="27" style="width:100%!important" value="{{ old('duePmt') }}" >
                              <span class="text-danger">{{ $errors->first('duePmt') }}</span>
                            </td>
                        </tr>

                        <tr class="{{ $errors->has('finalPmtExptDate') ? 'has-error' : '' }}">
                            <td style="width:30%">Final Payment Expected Date</td>
                            <td>
                              <input class="form-control" placeholder="Enter Final Payment Expected Date" type="text" id="finalPmtExptDate"
                              name="finalPmtExptDate" size="27" style="width:100%!important" value="{{ old('finalPmtExptDate') }}" >
                              <span class="text-danger">{{ $errors->first('finalPmtExptDate') }}</span>
                            </td>
                        </tr>
                  </table>

                  <table class="table table-bordered table-striped">
                    <h4 class="box-title"> Production Status - Client Updates </h4>
                        <tr class="{{ $errors->has('fabricShadeConf') ? 'has-error' : '' }}">
                            <td style="width:30%">Confirmation regarding the Fabric Shade</td>
                            <td>
                              <select class="form-control" style="width: 100%;" id="fabricShadeConf"
                              name="fabricShadeConf" value="{{ old('fabricShadeConf') }}">
                               <option selected="selected">No</option>
                               <option>Yes</option>
                              </select>
                              <span class="text-danger">{{ $errors->first('fabricShadeConf') }}</span>
                            </td>
                        </tr>

                        <tr class="{{ $errors->has('printedDesignConf') ? 'has-error' : '' }}">
                            <td style="width:30%">Confirmation regarding the Printed Design</td>
                            <td>
                              <select class="form-control" style="width: 100%;" id="printedDesignConf"
                              name="printedDesignConf" value="{{ old('printedDesignConf') }}">
                               <option selected="selected">No</option>
                               <option>Yes</option>
                              </select>
                              <span class="text-danger">{{ $errors->first('printedDesignConf') }}</span>
                            </td>
                        </tr>

                        <tr class="{{ $errors->has('techPackProdChanges') ? 'has-error' : '' }}">
                            <td style="width:30%">Tech Pack Product Changes (If Any) </td>
                            <td>
                              <input class="form-control" placeholder="Details w.r.t changes made for Design/Quality/Colour/Count" type="text" id="techPackProdChanges"
                              name="techPackProdChanges" size="27" style="width:100%!important" value="{{ old('techPackProdChanges') }}" >
                              <span class="text-danger">{{ $errors->first('techPackProdChanges') }}</span>
                            </td>
                        </tr>

                        <tr class="{{ $errors->has('techPackChangesAck') ? 'has-error' : '' }}">
                            <td style="width:30%">Tech Pack Changes Acknowledged with Client</td>
                            <td>
                              <select class="form-control" style="width: 100%;" id="techPackChangesAck"
                              name="techPackChangesAck" value="{{ old('techPackChangesAck') }}">
                               <option selected="selected">No</option>
                               <option>Yes</option>
                              </select>
                              <span class="text-danger">{{ $errors->first('techPackChangesAck') }}</span>
                            </td>
                        </tr>
                   </table>

                   <table class="table table-bordered table-striped">
                     <h4 class="box-title"> Shipment Status </h4>
                         <tr class="{{ $errors->has('shipmentAddress') ? 'has-error' : '' }}">
                             <td style="width:30%">Shipment Address</td>
                             <td>
                               <input class="form-control" placeholder="Enter Shipment Address" type="text" id="shipmentAddress"
                               name="shipmentAddress" size="27" style="width:100%!important" value="{{ old('shipmentAddress') }}" >
                               <span class="text-danger">{{ $errors->first('shipmentAddress') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('duePaymentCollected') ? 'has-error' : '' }}">
                             <td style="width:30%">Due Payment Collected at Delivery</td>
                             <td>
                               <select class="form-control" style="width: 100%;" id="duePaymentCollected"
                               name="duePaymentCollected" value="{{ old('duePaymentCollected') }}">
                                <option selected="selected">No</option>
                                <option>Yes</option>
                               </select>
                               <span class="text-danger">{{ $errors->first('duePaymentCollected') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('duePaymentCollNote') ? 'has-error' : '' }}">
                             <td style="width:30%">Due Payment Collection Note</td>
                             <td>
                               <input class="form-control" placeholder="Enter Due Payment Collection Note" type="text" id="duePaymentCollNote"
                               name="duePaymentCollNote" size="27" style="width:100%!important" value="{{ old('duePaymentCollNote') }}" >
                               <span class="text-danger">{{ $errors->first('duePaymentCollNote') }}</span>
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

                         <tr class="{{ $errors->has('prodSampleReturned') ? 'has-error' : '' }}">
                             <td style="width:30%">Product Samples Collected back from Client</td>
                             <td>
                               <select class="form-control" style="width: 100%;" id="prodSampleReturned"
                               name="prodSampleReturned" value="{{ old('prodSampleReturned') }}">
                                <option selected="selected">No</option>
                                <option>Yes</option>
                               </select>
                               <span class="text-danger">{{ $errors->first('prodSampleReturned') }}</span>
                             </td>
                         </tr>
                    </table>

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

                          <tr class="{{ $errors->has('docsVerified') ? 'has-error' : '' }}">
                              <td style="width:30%">All Documents Verified with Client & Manager</td>
                              <td>
                                <select class="form-control" style="width: 100%;" id="docsVerified"
                                name="docsVerified" value="{{ old('docsVerified') }}">
                                 <option selected="selected">No</option>
                                 <option>Yes</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('docsVerified') }}</span>
                              </td>
                          </tr>

                          <tr class="{{ $errors->has('concernedLeadSignature') ? 'has-error' : '' }}">
                              <td style="width:30%">Concerned Lead Signature</td>
                              <td>
                                <input class="form-control" placeholder="Enter Concerned Lead Signature" type="text" id="concernedLeadSignature"
                                name="concernedLeadSignature" size="27" style="width:100%!important" value="{{ old('concernedLeadSignature') }}" >
                                <span class="text-danger">{{ $errors->first('concernedLeadSignature') }}</span>
                              </td>
                          </tr>

                          <tr class="{{ $errors->has('managerSignature') ? 'has-error' : '' }}">
                              <td style="width:30%">Manager Signature</td>
                              <td>
                                <input class="form-control" placeholder="Enter Manager Signature" type="text" id="managerSignature"
                                name="managerSignature" size="27" style="width:100%!important" value="{{ old('managerSignature') }}" >
                                <span class="text-danger">{{ $errors->first('managerSignature') }}</span>
                              </td>
                          </tr>

                          <tr class="{{ $errors->has('adminSignature') ? 'has-error' : '' }}">
                              <td style="width:30%">Admin Signature</td>
                              <td>
                                <input class="form-control" placeholder="Enter Admin Signature" type="text" id="adminSignature"
                                name="adminSignature" size="27" style="width:100%!important" value="{{ old('adminSignature') }}" >
                                <span class="text-danger">{{ $errors->first('adminSignature') }}</span>
                              </td>
                          </tr>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
