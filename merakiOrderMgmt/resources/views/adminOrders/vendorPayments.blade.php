@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Vendor Orders | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Vendor Order - <span style="color:#Ffce37;"><b>{{ $order->documentNumber }}</b></span></h3>
            </div>

            <div class="box-body">
              @if(Session::has('error'))
                  <div class="alert alert-danger" style="display: inline-block;">
                     {{ Session::get('error') }}
                        @php
                         Session::forget('error');
                        @endphp
                   </div>
               @endif

               <table class="table table-bordered table-striped">
                 <h4 class="box-title"> Vendor Details </h4>
                   <tr>
                       <td style="width:30%">Vendor Name</td>
                       <td>
                         {{ $vendorPoLink[0]->vendor_code }}
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Order Document Number</td>
                       <td>
                         {{ $order->documentNumber }}
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Purchase Order Document Number</td>
                       <td>
                         {{ $vendorPoLink[0]->purchase_order_code }}
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Creation Date</td>
                       <td>
                         {{ $order->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Last Modified Date</td>
                       <td>
                         {{ $order->updated_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Expected Delivery</td>
                       <td>
                         {{ date('d-M-Y', strtotime($order->expectedDelivery)) }}
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%">Vendor Payment Amount</td>
                       <td>
                         Rs.{{ $vendorPoLink[0]->vendor_payment_amount }}/-
                       </td>
                   </tr>
                   <tr>
                       <td style="width:30%"><b>Vendor Payment Due Amount</b></td>
                       <td>
                         <b>Rs.{{ $vendorPendingDueAmt }}/-</b>
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

          <form method="POST" action="{{ URL::to('/') }}/order/admin/vendor/paymentReceipt/save/{{ $order->id }}" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h4 class="box-title"> Vendor Payment Details </h4>
                <b> Following are the details to be added into the system which are payments made to the vendors by Meraki Enterprises </b>
                <table class="table table-bordered table-striped">
                  <h4 class="box-title"> Cash <input type="checkbox"
                    onchange="document.getElementById('cashAmount').disabled = !this.checked;
                    document.getElementById('paymentDate').disabled = !this.checked;
                    document.getElementById('paidToPer').disabled = !this.checked;"/>
                  </h4>

                    <tr class="{{ $errors->has('cashAmount') ? 'has-error' : '' }}">
                        <td style="width:30%">Amount</td>
                        <td>
                          <input class="form-control" type="number" step="any" id="cashAmount" name="cashAmount" size="27"
                          style="width:100%!important" value="{{ old('cashAmount') }}" required disabled>
                          <span class="text-danger">{{ $errors->first('cashAmount') }}</span>
                        </td>
                    </tr>
                    <tr class="{{ $errors->has('paymentDate') ? 'has-error' : '' }}">
                        <td style="width:30%">Payment Date</td>
                        <td>
                          <input class="form-control" type="date" id="paymentDate" name="paymentDate" size="27"
                          style="width:100%!important" value="{{ old('paymentDate') }}" required disabled>
                          <span class="text-danger">{{ $errors->first('paymentDate') }}</span>
                        </td>
                    </tr>
                    <tr class="{{ $errors->has('paidToPer') ? 'has-error' : '' }}">
                        <td style="width:30%">Paid To</td>
                        <td>
                          <input class="form-control" type="text" placeholder="Name of the Person to whom Cash is Paid" id="paidToPer" name="paidToPer" size="27"
                          style="width:100%!important" value="{{ old('paidToPer') }}" required disabled>
                          <span class="text-danger">{{ $errors->first('paidToPer') }}</span>
                        </td>
                    </tr>
                  </table>

                  <table class="table table-bordered table-striped">
                    <h4 class="box-title"> Cheque Details
                      <input type="checkbox"
                        onchange="document.getElementById('bankName').disabled = !this.checked;
                        document.getElementById('chequeNumber').disabled = !this.checked;
                        document.getElementById('chequeAmount').disabled = !this.checked;
                        document.getElementById('chequeDate').disabled = !this.checked;"/>
                    </h4>
                      <tr class="{{ $errors->has('bankName') ? 'has-error' : '' }}">
                          <td style="width:30%">Bank Name</td>
                          <td>
                            <input class="form-control" placeholder="Enter the Bank Name" type="text" id="bankName"
                            name="bankName" size="27" style="width:100%!important" value="{{ old('bankName') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('bankName') }}</span>
                          </td>
                      </tr>

                      <tr class="{{ $errors->has('chequeNumber') ? 'has-error' : '' }}">
                          <td style="width:30%">Cheque Number</td>
                          <td>
                            <input class="form-control" placeholder="Enter the Cheque Number" type="text" id="chequeNumber"
                            name="chequeNumber" size="27" style="width:100%!important" value="{{ old('chequeNumber') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('chequeNumber') }}</span>
                          </td>
                      </tr>

                      <tr class="{{ $errors->has('chequeAmount') ? 'has-error' : '' }}">
                          <td style="width:30%">Cheque Amount</td>
                          <td>
                            <input class="form-control" type="number" step="any" id="chequeAmount" name="chequeAmount" size="27"
                            style="width:100%!important" value="{{ old('chequeAmount') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('chequeAmount') }}</span>
                          </td>
                      </tr>

                      <tr class="{{ $errors->has('chequeDate') ? 'has-error' : '' }}">
                          <td style="width:30%">Cheque Date</td>
                          <td>
                            <input class="form-control" type="date" id="chequeDate" name="chequeDate" size="27"
                            style="width:100%!important" value="{{ old('chequeDate') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('chequeDate') }}</span>
                          </td>
                      </tr>
                  </table>

                  <table class="table table-bordered table-striped">
                    <h4 class="box-title"> Online Transaction Details
                      <input type="checkbox"
                        onchange="document.getElementById('transactionId').disabled = !this.checked;
                        document.getElementById('transactionBankName').disabled = !this.checked;
                        document.getElementById('vendorAccountNumber').disabled = !this.checked;
                        document.getElementById('merakiAccountNumber').disabled = !this.checked;
                        document.getElementById('transactionAmount').disabled = !this.checked;
                        document.getElementById('transactionDate').disabled = !this.checked;"/>
                    </h4>
                      <tr class="{{ $errors->has('transactionId') ? 'has-error' : '' }}">
                          <td style="width:30%">Transaction ID</td>
                          <td>
                            <input class="form-control" placeholder="Enter the Transaction ID" type="text" id="transactionId"
                            name="transactionId" size="27" style="width:100%!important" value="{{ old('transactionId') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('transactionId') }}</span>
                          </td>
                      </tr>

                      <tr class="{{ $errors->has('transactionBankName') ? 'has-error' : '' }}">
                          <td style="width:30%">Bank Name</td>
                          <td>
                            <input class="form-control" placeholder="Enter the Bank Name" type="text" id="transactionBankName"
                            name="transactionBankName" size="27" style="width:100%!important" value="{{ old('transactionBankName') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('transactionBankName') }}</span>
                          </td>
                      </tr>
                      <tr class="{{ $errors->has('merakiAccountNumber') ? 'has-error' : '' }}">
                          <td style="width:30%">Meraki Account Number</td>
                          <td>
                            <input class="form-control" placeholder="Enter the Meraki Account Number" type="number" id="merakiAccountNumber"
                            name="merakiAccountNumber" size="27" style="width:100%!important" value="{{ old('merakiAccountNumber') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('merakiAccountNumber') }}</span>
                          </td>
                      </tr>
                      <tr class="{{ $errors->has('vendorAccountNumber') ? 'has-error' : '' }}">
                          <td style="width:30%">Vendor Account Number</td>
                          <td>
                            <input class="form-control" placeholder="Enter the Vendor Account Number" type="number" id="vendorAccountNumber"
                            name="vendorAccountNumber" size="27" style="width:100%!important" value="{{ old('vendorAccountNumber') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('vendorAccountNumber') }}</span>
                          </td>
                      </tr>
                      <tr class="{{ $errors->has('transactionAmount') ? 'has-error' : '' }}">
                          <td style="width:30%">Transaction Amount</td>
                          <td>
                            <input class="form-control" type="number" step="any" id="transactionAmount" name="transactionAmount" size="27"
                            style="width:100%!important" value="{{ old('transactionAmount') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('transactionAmount') }}</span>
                          </td>
                      </tr>
                      <tr class="{{ $errors->has('transactionDate') ? 'has-error' : '' }}">
                          <td style="width:30%">Transaction Date</td>
                          <td>
                            <input class="form-control" type="date" id="transactionDate" name="transactionDate" size="27"
                            style="width:100%!important" value="{{ old('transactionDate') }}" required disabled>
                            <span class="text-danger">{{ $errors->first('transactionDate') }}</span>
                          </td>
                      </tr>
                 </table>

                 <button class="btn btn-primary" type="submit">Add Payment</button>
               </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
