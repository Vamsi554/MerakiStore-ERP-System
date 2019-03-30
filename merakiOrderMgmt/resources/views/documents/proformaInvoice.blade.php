@extends('layouts.templateNoFooter')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Proforma Invoice #{{ $order->proformaInvoiceNumber }}
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
              D.No:101, Near SR Club, Sri Nagar Colony<br>
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
        <h4 class="text-center"><strong> PROFORMA INVOICE </strong></h4>
        <div class="col-sm-4 invoice-col">
          <b>Bill To</b>
          <address>
            @php
              $billAddrArr = explode(",", $order->billingAddress);
            @endphp
            @for($i=0; $i<count($billAddrArr); $i++)
              {{ $billAddrArr[$i] }} <br>
            @endfor
            </i></b><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-5 invoice-col">
          <b>Proforma No: </b> {{ $order->proformaInvoiceNumber }}<br>
          <b>Date: </b> {{ \Carbon\Carbon::now("Asia/Kolkata")->format("d-M-Y") }} <br>
          <b>Reference No: </b> {{ $order->documentNumber }}<br>
          <b>Due Date: </b> {{ \Carbon\Carbon::now("Asia/Kolkata")->format("d-M-Y") }} <br>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          <b>GSTIN: </b> 36BOPPG4920P1ZD <br>
          <b>PAN: </b> BOPPG4920 <br>
          <b>Client GST No: </b> {{ $order->client_gst_number }} <br>
        </div>
      </div>

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
      @if($order->advancePaymentPercentage != 0)
        @php
          $advPayAmt = $order->orderAmount * $order->advancePaymentPercentage / 100.0 ;
        @endphp
        <strong>Advance To Pay ({{ $order->advancePaymentPercentage }}%): </strong> Rs.{{ $advPayAmt  }}/-
        <span style="float:right;"><strong>Balance To Pay ({{ 100 - ($order->advancePaymentPercentage) }}%): </strong> Rs.{{ $order->orderAmount - $advPayAmt }}/- </span> <br>
      @endif

      <h4>Terms and Conditions</h4>
      <ul>
        <li>Our responsibility ceases as soon as goods delivered in your premises.</li>
        <li>We will recognize only official receipt.</li>
        <li>Goods once sold cannot be returned or exchanged.</li>
        <li>Full Payment must be made to us on the presentation of the Invoice otherwise interest will be charged @18% P.A.</li>
        <li>All disputes shall be subjected to Hyderabad jurisdiction only.</li>
        <li>We reserved to ourselves the right to demand payment of this bill any time before due date.</li>
        <li>All cheques /drafts to be made in favour of <b>"MERAKII ENTERPRISES"</b>, Payable at Hyderabad.</li>
        <li>Mention the Invoice No at the back of your cheque / draft.</li>
      </ul>

      <div class="row">
        <div class="col-xs-4">
          <p class="lead">Bank Details</p>
          <p><strong>A/C Holder:</strong> Merakii Enterprises</p>
          <p><strong>A/C No:</strong> 50200031105382 </p>
          <p><strong>Bank:</strong> HDFC </p>
          <p><strong>Branch:</strong> Srinagar colony, Hyderabad</p>
          <p><strong>IFSC Code:</strong> HDFC0001554 </p>
        </div>
        <div class="col-xs-4">
          <p class="lead">GSTIN: 36BOPPG4920P1ZD </p>
          <p>I/We hereby certify that our
            registration certificate under
            the Telangana Goods and Services Tax Act. 2017.</p>
        </div>
        <div class="col-xs-4">
          <p class="lead">Authorised Signatory</p>
        </div>
      </div>

      @if(count($enquiryQuote) == 1)
        <br><br><br><br><br>
      @endif

      @if(count($enquiryQuote) == 2)
        <br><br><br><br>
      @endif

      <footer class="text-center">
        Copyright &copy; 2018 Meraki Stores. All rights reserved.
      </footer>

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

      @page
      {
          size: auto;   /* auto is the initial value */
          margin: 0mm 0mm 0mm 0mm;  /* this affects the margin in the printer settings */
      }

      @media print {
        body {-webkit-print-color-adjust: exact !important;}

      }

  </style>

@endsection
