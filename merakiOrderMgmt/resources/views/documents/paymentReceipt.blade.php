@extends('layouts.templateNoFooter')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Customer Payment Receipt #{{ $customerPayments[0]->cust_pay_code }}
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
        <center><strong>PAYMENT RECEIPT</strong></center>
        <br><br>
        <div class="col-sm-5 invoice-col">
          Received From
          <address>
            <strong>{{ $customerName }} </strong><br>
            @php
              $addressArr = explode(",", $order->billingAddress);
            @endphp
            @for($i=0; $i<count($addressArr); $i++)
              {{ $addressArr[$i] }} <br>
            @endfor
            </i></b>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Paid To
          <address>
            <strong>Mr.Abhilash Gali</strong><br>
            Meraki Enterprises<br>
            Hyderabad, Telangana<br>
            Tel: 040-48554470, 9000909109<br>
            Email: <b><i>abhilash.merakii@gmail.com</i></b><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          <b>Date: </b> {{ $customerPayments->last()->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y") }} <br>
          <b>Reference No: </b> {{ $order->documentNumber }} <br>
          <b>Receipt No: </b> {{ $customerPayments[0]->cust_pay_code }} <br>
          <br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr bgcolor="#Ffce37;">
              <th>SNo</th>
              <th>Description</th>
              <th>HSN</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Taxable Amount</th>
              @if($enquiryQuoteLinkage[0]->tax_code == 'CGST/SGST')
                <th>CGST</th>
                <th>SGST</th>
              @else
                <th>IGST</th>
              @endif
              <th>Total Amount</th>
            </tr>
            </thead>
            <tbody>
              @php
                $m = 1;
              @endphp
            @foreach($enquiryQuote as $quoteEntry)
            <tr>
              <td>{{ $m++ }}</td>
              <td>{{ $quoteEntry->product_description }}</td>
              <td>{{ $quoteEntry->hsn }}</td>
              <td>{{ $quoteEntry->quantity }} Units</td>
              <td>Rs.{{ $quoteEntry->cost_per_unit }}/-</td>
              @php
                $totAmt = $quoteEntry->cost_per_unit * $quoteEntry->quantity;
                $taxPer = $quoteEntry->gst_tax;
                $indvTaxPer = $quoteEntry->gst_tax/2.0;
                $cgst = $totAmt * $indvTaxPer/100.0;
                $sgst = $totAmt * $indvTaxPer/100.0;
                $igst = $cgst + $sgst;
                $finalAmount = $totAmt + $cgst + $sgst;
              @endphp
              <td>Rs.{{ $totAmt }}/-</td>
              @if($enquiryQuoteLinkage[0]->tax_code == 'CGST/SGST')
                <td>Rs.{{ $cgst }}/- <sub><b>({{ $indvTaxPer }}%)</b></sub></td>
                <td>Rs.{{ $sgst }}/- <sub><b>({{ $indvTaxPer }}%)</b></sub></td>
              @else
                <td>Rs.{{ $igst }}/- <sub><b>({{ $taxPer }}%)</b></sub></td>
              @endif
              <td>Rs.{{ $finalAmount }}/-</td>
            </tr>
            @endforeach
            <tr>
              <td></td><td></td><td></td><td></td><td></td><td></td>
              @if($enquiryQuoteLinkage[0]->tax_code == 'CGST/SGST')
                <td></td>
              @endif
              <td><strong>Grand Total</strong></td>
              <td><strong>Rs.{{ $order->orderAmount }}/-</strong></td></tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <strong>Payment Details</strong><br>
      <br>
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th style="text-align:center;">Cash</th>
              <th style="text-align:center;">Cheque</th>
              <th style="text-align:center;">Online</th>
              <th style="text-align:center;">Total Amount (Cash/Cheque/Online)</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($customerPayments as $cusPay)
              <tr>
                <td style="width:30%;">
                  <b>Cash Amount</b> : {{ $cusPay->cash_amount }} <br>
                  @if($cusPay->payment_date != null)
                    <b>Payment Date</b> : {{ date('d-M-Y', strtotime($cusPay->payment_date)) }} <br>
                  @endif
                  <b>Received From</b> : {{ $cusPay->received_from_person }} <br>
                </td>
                <td style="width:30%;">
                  <b>Bank Name</b> : {{ $cusPay->bank_cheque }} <br>
                  <b>Cheque Number</b> : {{ Crypt::decryptString($cusPay->cheque_number) }} <br>
                  <b>Cheque Amount</b> : {{ $cusPay->cheque_amount }} <br>
                  @if($cusPay->cheque_date != null)
                    <b>Cheque Date</b> : {{ date('d-M-Y', strtotime($cusPay->cheque_date)) }} <br>
                  @endif
                </td>
                <td style="width:30%;">
                  <b>Transaction ID</b> : {{ Crypt::decryptString($cusPay->transaction_id) }} <br>
                  <b>Bank Name</b> :  {{ $cusPay->bank_name }} <br>
                  <b>Customer Account Number</b> : {{ Crypt::decryptString($cusPay->customer_from_account_number) }} <br>
                  <b>Meraki Account Number</b> : {{ Crypt::decryptString($cusPay->meraki_to_account_number) }} <br>
                  <b>Transaction Amount</b> : {{ $cusPay->transaction_amount }} <br>
                  @if($cusPay->transaction_date != null)
                    <b>Transaction Date</b> : {{ date('d-M-Y', strtotime($cusPay->transaction_date)) }} <br>
                  @endif
                </td>
                <td>{{ $cusPay->total_payment_amount }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <strong>Official Stamp: </strong><br>


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
