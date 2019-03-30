@extends('layouts.templateNoFooter')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Vendor Payment Receipt #{{ $vendorPayments[0]->order_id }}
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="{{ asset('images/merakiStoreFooterLogo.png') }}"
            class="img-fluid figure-img" alt="Meraki Store" style="width: 150px;" />
            <span style="float:right;"><p><strong>MERAKII ENTERPRISES</strong></p>
            <address>
              <p style="font-size: 15px;">
              D.No:101, Near SR Club, Sri Nagar Colony <br>
              Hyderabad, Telangana<br>
              Tel: 040-48554470, 9000909109<br><br>
              Email: <b><i>abhilash.merakii@gmail.com</i></b><br>
            </p>
          </span>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

      <div class="row invoice-info">
        <center><strong>VENDOR PAYMENT DETAILS</strong></center>
        <br><br>

        <b>Vendor Name</b> : {{ $vendorPoLink[0]->vendor_code }} <br><br>
        <b>Purchase Order Number</b> : {{ $vendorPoLink[0]->purchase_order_code }} <br><br>
        <b>Vendor Payment Amount</b> : {{ $vendorPoLink[0]->vendor_payment_amount }} <br><br>

        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-bordered">
              <thead>
              <tr style="background-color: #Ffce37 !important">
                <th style="text-align:center;">Cash</th>
                <th style="text-align:center;">Cheque</th>
                <th style="text-align:center;">Online</th>
                <th style="text-align:center;">Total Amount (Cash/Cheque/Online)</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($vendorPayments as $venPay)
                <tr>
                  <td style="width:30%;">
                    <b>Cash Amount</b> : {{ $venPay->cash_amount }} <br>
                    @if($venPay->payment_date != null)
                      <b>Payment Date</b> : {{ date('d-M-Y', strtotime($venPay->payment_date)) }} <br>
                    @endif
                    <b>Paid To</b> : {{ $venPay->paid_to_person }} <br>
                  </td>
                  <td style="width:30%;">
                    <b>Bank Name</b> : {{ $venPay->bank_cheque }} <br>
                    <b>Cheque Number</b> : {{ Crypt::decryptString($venPay->cheque_number) }} <br>
                    <b>Cheque Amount</b> : {{ $venPay->cheque_amount }} <br>
                    @if($venPay->cheque_date != null)
                      <b>Cheque Date</b> : {{ date('d-M-Y', strtotime($venPay->cheque_date)) }} <br>
                    @endif
                  </td>
                  <td style="width:30%;">
                    <b>Transaction ID</b> : {{ Crypt::decryptString($venPay->transaction_id) }} <br>
                    <b>Bank Name</b> :  {{ $venPay->bank_name }} <br>
                    <b>Meraki Account Number</b> : {{ Crypt::decryptString($venPay->meraki_from_account_number) }} <br>
                    <b>Vendor Account Number</b> : {{ Crypt::decryptString($venPay->vendor_to_account_number) }} <br>
                    <b>Transaction Amount</b> : {{ $venPay->transaction_amount }} <br>
                    @if($venPay->transaction_date != null)
                      <b>Transaction Date</b> : {{ date('d-M-Y', strtotime($venPay->transaction_date)) }} <br>
                    @endif
                  </td>
                  <td>{{ $venPay->total_payment_amount }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
      </div>

    </section>
    </section>

  </div>

@endsection

@section('printCss')

  <style type="text/css">

      html { overflow-x: hidden; }

      @page
      {
          size: auto;   /* auto is the initial value */
          margin: 0mm;  /* this affects the margin in the printer settings */
      }

      @media print {
        body {
          -webkit-print-color-adjust: exact !important;
          margin: 0mm;
          size: auto;
        }
      }

  </style>

@endsection
