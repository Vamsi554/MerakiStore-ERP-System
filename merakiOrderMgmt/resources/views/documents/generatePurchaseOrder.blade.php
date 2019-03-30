@extends('layouts.templateNoFooter')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Purchase Order #{{ $vendorPurchaseOrderDtls[0]->purchase_order_code }}
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
      </div>

      <div class="row invoice-info">
        <div class="col-xs-12">
          <h4 class="text-center"><strong> PURCHASE ORDER </strong></h4>
          <p style="float:right"><strong>Date:</strong> {{ date("d-M-Y", strtotime($vendorPurchaseOrderDtls[0]->poCreDttm)) }}</p>
          <strong>To,</strong><br>
          {{ $vendorDtls[0]->vendor_name }},<br>
          {{ $vendorDtls[0]->vendor_company }},<br>
          {{ $vendorDtls[0]->vendor_address1 }},{{ $vendorDtls[0]->vendor_address2 }},<br>
          {{ $vendorDtls[0]->street }}, {{ $vendorDtls[0]->city }},<br>
          {{ $vendorDtls[0]->state }} - {{ $vendorDtls[0]->zipcode }}<br>
          <b>TIN No: </b> {{ $vendorDtls[0]->vendor_TIN }} / <b> CST: </b> {{ $vendorDtls[0]->vendor_CST }}<br>
          <br>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <strong>Kind Attn: </strong> Mr/Mrs. {{ $vendorDtls[0]->vendor_name }}, Mob. No. {{ $vendorDtls[0]->vendor_phone }} <br>
          <br>
          <strong>Sub: {{ $enquiry->eventName }} Merchandise Kit Purchase Order Details.</strong><br>
          <br>
          <p> Dear Sir/Madam, <br><br>

              Merakii is a one stop destination for all your Merchandise needs be it for college or corporate events.
              With the objective of providing our customers with a range of customised products, our Team at Merakii work
              round the clock striving for perfection and punctuality, while also ensuring affordable pricing!
              <br><br>
              We are placing our order for below merchandise on the following specifications, terms and conditions
          </p>
        </div>
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr bgcolor="#Ffce37;">
              <th>SNo</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Taxable Amount</th>
              <th>GST Tax</th>
              <th>Total Amount</th>
            </tr>
            </thead>
            <tbody>
              @php
                $k = 1;
              @endphp
              @foreach ($vendorPurchaseOrderDtls as $vendorPOEntry)
                <tr>
                  <td>{{ $k++ }}</td>
                  <td>{{ $vendorPOEntry->product_description }}</td>
                  <td>{{ $vendorPOEntry->quantity }} Units</td>
                  <td>Rs.{{ $vendorPOEntry->cost_per_unit }}/-</td>
                  @php
                    $totAmt = $vendorPOEntry->cost_per_unit * $vendorPOEntry->quantity;
                    $taxPer = $vendorPOEntry->gst_tax;
                    $gst = $totAmt * $taxPer/100.0;
                    $finalAmount = $totAmt + $gst;
                  @endphp
                  <td>Rs.{{ $totAmt }}/-</td>
                  <td>Rs.{{ $gst }}/- <br><sub><b>({{ $taxPer }}%)</b></sub></td>
                  <td>Rs.{{ $finalAmount }}/-</td>
                </tr>
              @endforeach
              <tr>
                <td></td><td></td><td></td><td></td><td></td>
                <td><strong>Grand Total</strong></td>
                <td><strong>Rs.{{ $vendorAmount }}/-</strong></td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>

      <div style="page-break-before: always; width: 100%;" class="page-header headerContent">
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
      </div>

      @for($key=0; $key<count($enquiryRequirements); $key++)

        <h4>{{ $enquiryRequirements[$key]->product_description }} Features</h4>
        <br><br>
        <h4>Product Features</h4>
        <table class="table table-bordered table-striped">
          <tr>
            <td style="width:30%;"><b>Product Style</b></td><td>{{ $enquiryRequirements[$key]->product_style }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Material</b></td><td>{{ $enquiryRequirements[$key]->material }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Quality</b></td><td>{{ $enquiryRequirements[$key]->quality }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Fabric</b></td><td>{{ $enquiryRequirements[$key]->fabric }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Colour</b></td><td>{{ $enquiryRequirements[$key]->colour }}</td>
          </tr>
          @if ($enquiryRequirements[$key]->additional_features != 'N/A')
            <td style="width:30%"><b>Additional Features</b></td><td>{{ $enquiryRequirements[$key]->additional_features }}</td>
          @endif
        </table>
        <br>
        <h4>Product Customizations</h4>
        <table class="table table-bordered table-striped">
          <tr>
            <td style="width:30%;"><b>Print Methods</b></td><td>{{ $enquiryRequirements[$key]->print_methods }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Print Placements</b></td><td>{{ $enquiryRequirements[$key]->print_placements }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Print Area</b></td><td>{{ $enquiryRequirements[$key]->print_area }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Measurements</b></td><td>{{ $enquiryRequirements[$key]->measurements }}</td>
          </tr>
          @if ($enquiryRequirements[$key]->additional_customizations != 'N/A')
            <td style="width:30%"><b>Additional Customization</b></td>
            <td>{{ $enquiryRequirements[$key]->additional_customizations }}</td>
          @endif
        </table>
        <br>
        <h4>Conditions</h4>
        <table class="table table-bordered table-striped">
          <tr>
            <td style="width:30%;"><b>Finishing</b></td><td>{{ $enquiryRequirements[$key]->finishing }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Packaging</b></td><td>{{ $enquiryRequirements[$key]->packaging }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Inclusive</b></td><td>{{ $enquiryRequirements[$key]->inclusive }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Exclusive</b></td><td>{{ $enquiryRequirements[$key]->exclusive }}</td>
          </tr>
        </table>

        <div style="page-break-before: always; width: 100%;" class="page-header headerContent">
          <img src="{{ asset('images/merakiStoreFooterLogo.png') }}"
          class="img-fluid figure-img" alt="Meraki Store" style="width: 150px;"/>
          <span style="float:right;"><p><strong>MERAKII ENTERPRISES</strong></p>
            <address>
              <p style="font-size: 15px;">
              D.No:101, Near SR Club, Sri Nagar Colony<br>
              Hyderabad, Telangana<br>
              Tel: 040-48554470, 9000909109<br><br>
              Email: <b><i>abhilash.merakii@gmail.com</i></b><br>
            </p>
        </div>

      @endfor

      <br>
      <h4>Terms & Conditions</h4>
      <ul>
        @for($c=0; $c<count($vendorTermsConditions); $c++)
          <li>{{ $vendorTermsConditions[$c] }}</li>
        @endfor
      </ul>
      <br>
      <h4>Additional Notes</h4>
      <ul>
        <li>{{ $vendorNotes }}</li>
      </ul>

      <div class="row">
        <div class="col-xs-12">

          <br>
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
          margin: 0mm;  /* this affects the margin in the printer settings */
      }

      @media print {
        body {-webkit-print-color-adjust: exact !important;}

        .headerContent {
          display: block;
        }

        .footerContent {
          display: block;
        }
      }

      @media screen {

        .headerContent {
          display: none;
        }

        .footerContent {
          display: none;
        }
      }

  </style>

@endsection
