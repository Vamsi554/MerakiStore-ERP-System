@extends('layouts.templateNoFooter')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tech Pack #{{ $order->techPackNumber }}
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
      </div>

      <div class="row invoice-info">
        <div class="col-xs-12">
          <h4 class="text-center"><strong> TECH PACK </strong></h4>
          <p style="float:right"><strong>Date:</strong> {{ date("d-M-Y", strtotime($enquiryRequirements[0]->tech_pack_date)) }}</p>
          <strong>To,</strong><br>
          {{ $enquiry->name }},<br>
          {{ $enquiry->organizationName }},<br>
          {{ $enquiry->eventName }},<br>
          {{ $enquiry->eventPlace }}.<br>
          <br>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <strong>Kind Attn: </strong> Mr/Mrs. {{ $enquiry->name }}, {{ $enquiry->designation }} <br>
          Mob. No. {{ $enquiry->phone }} <br>
          <br>
          <strong>Sub: {{ $enquiry->eventName }} Merchandise Kit Tech Pack Details.</strong><br>
          <br>
          <p> Dear Sir/Madam, <br><br>

              Merakii is a one stop destination for all your Merchandise needs be it for college or corporate events.
              With the objective of providing our customers with a range of customised products, our Team at Merakii work
              round the clock striving for perfection and punctuality, while also ensuring affordable pricing!
              <br><br>
              With reference to the requirement mentioned from your side, please go through the below tech pack details for the order.
          </p>

          <table class="table table-bordered table-striped">
            <thead>
              <tr bgcolor="#Ffce37;">
                <th>Merchandise</th>
                <th>Technical Details</th>
                <th>Estimated Delivery</th>
                <th>BreakUp Details</th>
              </tr>
            </thead>
            <tbody>
            @for($f=0; $f<count($enquiryRequirements); $f++)
              <tr>
                <td>{{ $enquiryRequirements[$f]->product_description }}</td>
                <td>
                  @php
                    $enquiryReq = $enquiryRequirements[$f];
                  @endphp
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
                <td>{{ date("d-M-Y", strtotime($enquiryRequirements[$f]->est_delivery)) }}</td>
                @php
                  $breakUpDtlsArr = explode(",", $enquiryRequirements[$f]->breakup_details);
                @endphp
                <td style="width:25%;">
                  <ul>
                    @for($m=0; $m<count($breakUpDtlsArr); $m++)
                      <li>{{ $breakUpDtlsArr[$m] }}</li>
                    @endfor
                  </ul>
                </td>
              </tr>
            @endfor
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">

          With Regards<br>
          <b>Meraki Enterprises</b>
          <br><br>
          (Abhilash Gali)<br>
          Manager-Sales Department<br>
          +91 9000 909 109<br>
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

      td {
        padding-left: 10px;
      }

      @page
      {
          size: auto;   /* auto is the initial value */
          margin: 0mm 0mm 0mm 0mm;  /* this affects the margin in the printer settings */
      }

      @media print {
        body {-webkit-print-color-adjust: exact !important;}

        .headerContent {
          display: block;
        }
      }

      @media screen {

        .headerContent {
          display: none;
        }
      }
  </style>

@endsection
