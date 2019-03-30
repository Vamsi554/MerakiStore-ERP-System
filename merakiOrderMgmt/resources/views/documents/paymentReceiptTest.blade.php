@extends('layouts.templateNoFooter')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Customer Payment Receipt #{{ $customerPayments[0]->order_id }}
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
          <b>Date: </b> {{ $customerPayments->last()->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }} <br>
          <b>Document Number: </b> {{ $order->documentNumber }} <br>
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
            <tr style="background-color: #Ffce37 !important">
              <th>S No</th>
              <th>Description</th>
              <th>HSN</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>CGST</th>
              <th>SGST</th>
              <th>Total Value</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($enquiryQuote as $quoteEntry)
                <tr>
                  <td>1</td>
                  <td>{{ $quoteEntry->product_description }}</td>
                  <td>{{ $quoteEntry->quantity }} Units</td>
                  <td>Rs.{{ $quoteEntry->cost_per_unit }}/-</td>
                  @php
                    $totAmt = $quoteEntry->cost_per_unit * $quoteEntry->quantity;
                    $indvTaxPer = $quoteEntry->gst_tax/2.0;
                    $cgst = $totAmt * $indvTaxPer/100.0;
                    $sgst = $totAmt * $indvTaxPer/100.0;
                    $finalAmount = $totAmt + $cgst + $sgst;
                  @endphp
                  <td>Rs.{{ $totAmt }}/-</td>
                  <td>Rs.{{ $cgst }}/- <sub><b>({{ $indvTaxPer }}%)</b></sub></td>
                  <td>Rs.{{ $sgst }}/- <sub><b>({{ $indvTaxPer }}%)</b></sub></td>
                  <td>Rs.{{ $finalAmount }}/-</td>
                </tr>
              @endforeach
              <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td><b>Grand Total</b></td><td><b>Rs.{{ $order->orderAmount }}/-</b></td>
              </tr>
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
            <tr style="background-color: #Ffce37 !important">
              <th style="width:15%;text-align: center;" colspan="3">Cash</th>
              <th style="text-align: center;" colspan="4">Cheque</th>
              <th style="text-align: center;" colspan="6">Online</th>
              <th style="text-align: center;">Total Amount (Cash/Cheque/Online)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><b>Cash Amount</b></td>
              <td><b>Payment Date</b></td>
              <td><b>Received From</b></td>
              <td><b>Bank Name</b></td>
              <td><b>Cheque Number</b></td>
              <td><b>Cheque Amount</b></td>
              <td><b>Cheque Date</b></td>
              <td><b>Transaction ID</b></td>
              <td><b>Bank Name</b></td>
              <td><b>Customer Account Number</b></td>
              <td><b>Meraki Account Number</b></td>
              <td><b>Transaction Amount</b></td>
              <td><b>Transaction Date</b></td>
              <td><b>Total Amount</b></td>
            </tr>
            @foreach ($customerPayments as $cusPay)
              <tr>
                <td>{{ $cusPay->cash_amount }}</td>
                <td>{{ date('d-M-Y', strtotime($cusPay->payment_date)) }}</td>
                <td>{{ $cusPay->received_from_person }}</td>
                <td>{{ $cusPay->bank_cheque }}</td>
                <td>{{ $cusPay->cheque_number }}</td>
                <td>{{ $cusPay->cheque_amount }}</td>
                <td>{{ $cusPay->cheque_date }}</td>
                <td>{{ $cusPay->transaction_id }}</td>
                <td>{{ $cusPay->bank_name }}</td>
                <td>{{ $cusPay->customer_from_account_number }}</td>
                <td>{{ $cusPay->meraki_to_account_number }}</td>
                <td>{{ $cusPay->transaction_amount }}</td>
                <td>{{ $cusPay->transaction_date }}</td>
                <td>{{ $cusPay->cash_amount + $cusPay->cheque_amount + $cusPay->transaction_amount }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <br>
      <strong>Official Stamp: </strong><br>
      <br><br><br><br><br>

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
