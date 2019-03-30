@extends('layouts.templateNoFooter')

@section('loadCustomJs')
  <style type="text/css">
      .column {
        float: left;
        width: 50%;
        padding: 10px;
      }
  </style>
@endsection

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Quotation #{{ $quoteCd }}
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
          <h4 class="text-center"><strong> QUOTATION LETTER </strong></h4>
          <p style="float:right"><strong>Date:</strong> {{ date("d-M-Y", strtotime($enquiryQuote[0]->quoteCreDttm)) }}</p>
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
          <strong>Sub: {{ $enquiry->eventName }} Merchandise Kit Quotation Details.</strong><br>
          <br>
          <p> Dear Sir/Madam, <br><br>

              Merakii is a one stop destination for all your Merchandise needs be it for college or corporate events.
              With the objective of providing our customers with a range of customised products, our Team at Merakii work
              round the clock striving for perfection and punctuality, while also ensuring affordable pricing!
              <br><br>
              With reference to the requirement mentioned from your side, please go through the attached quotation as requested and our sales executive will get in touch with you in
              the next 48 hrs to guide you through the remaining process.
          </p>
        </div>
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>SNo</th>
              <th>Product</th>
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
              @foreach ($enquiryQuote as $quoteEntry)
                <tr>
                  <td>1</td>
                  <td>{{ $quoteEntry->product_description }}</td>
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
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  @if($enquiryQuoteLinkage[0]->tax_code == 'CGST/SGST')
                    <td></td>
                    <td></td>
                  @else
                    <td></td>
                  @endif
                  <td><b>Grand Total</b></td>
                  <td><b>Rs.{{ $finalAmount }}/-</b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>

      <h4>{{ $enquiryQuote[0]->product_description }} Features</h4>

      <div class="row">
        <div class="column">
          <h4 class="box-title">Product Features</h4>
          <ul>
            <li>Product Style: {{ $enquiryRequirements[0]->product_style }}</li>
            <li>Material: {{ $enquiryRequirements[0]->material }}</li>
            <li>Quality: {{ $enquiryRequirements[0]->quality }}</li>
            <li>Fabric: {{ $enquiryRequirements[0]->fabric }}</li>
            <li>Colour: {{ $enquiryRequirements[0]->colour }}</li>
            @if ($enquiryRequirements[0]->additional_features != 'N/A')
              <li>Additional Features: {{ $enquiryRequirements[0]->additional_features }}</li>
            @endif
          </ul>
        </div>
        <div class="column">
          <h4 class="box-title">Product Customizations</h4>
          <ul>
            <li>Print Methods: {{ $enquiryRequirements[0]->product_style }}</li>
            <li>Print Placements: {{ $enquiryRequirements[0]->material }}</li>
            <li>Print Area: {{ $enquiryRequirements[0]->quality }}</li>
            <li>Measurements: {{ $enquiryRequirements[0]->fabric }}</li>
            @if ($enquiryRequirements[0]->additional_customizations != 'N/A')
              <li>Additional Customization: {{ $enquiryRequirements[0]->additional_customizations }}</li>
            @endif
          </ul>
        </div>
      </div>

      <div style="page-break-before: always; width: 100%;" class="page-header headerContent">
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
      </div>

      <h4>Conditions</h4>
      <ul>
        <li>Finishing: {{ $enquiryRequirements[0]->finishing }}</li>
        <li>Packaging: {{ $enquiryRequirements[0]->packaging }}</li>
        <li>Inclusive: {{ $enquiryRequirements[0]->inclusive }}</li>
        <li>Exclusive: {{ $enquiryRequirements[0]->exclusive }}</li>
      </ul>
      <br>
      <h4>Terms & Conditions</h4>
      <ul>
        <li>Price mentioned for the above products is inclusive of material and fabrication, GST, art work
            embroidery charges and shipment charges (Single location).
        </li>
        <li>Excludes all the other details apart from Inclusives mentioned.</li>
        <li>Order will be processed based on the sample approved from the authorised person from the
            client side. Specifications mentioned in this particular document is only for the price mentioned above.</li>
        <li>Final production will take place only on the bases of sample approved irrespective of the
            specifications mentioned in this particular quotation.
        </li>
        @if ($enquiryQuoteLinkage[0]->specific_terms_1 != 'N/A')
          <li>{{ $enquiryQuoteLinkage[0]->specific_terms_1 }}</li>
        @endif
        @if ($enquiryQuoteLinkage[0]->specific_terms_2 != 'N/A')
          <li>{{ $enquiryQuoteLinkage[0]->specific_terms_2 }}</li>
        @endif
        @if ($enquiryQuoteLinkage[0]->specific_terms_3 != 'N/A')
          <li>{{ $enquiryQuoteLinkage[0]->specific_terms_3 }}</li>
        @endif
        @if ($enquiryQuoteLinkage[0]->specific_terms_4 != 'N/A')
          <li>{{ $enquiryQuoteLinkage[0]->specific_terms_4 }}</li>
        @endif
        @if ($enquiryQuoteLinkage[0]->specific_terms_5 != 'N/A')
          <li>{{ $enquiryQuoteLinkage[0]->specific_terms_5 }}</li>
        @endif
        <li>The above quotation is for the total quantites as per the requirement, if the quantity reduces
            pricing will be increased proportionatlly.
        </li>
        <li>Every product will have Merakii label to indicate our band.</li>
        <li><b>Payment Terms:</b> Require {{ $enquiryQuoteLinkage[0]->advance_payment_percentage }}% as advance on the total value to start the production and the
            balance amount should be paid on or before final delivery.
        </li>
        <li><b>Delivery Schedule:</b> Require production time of {{ $enquiryQuoteLinkage[0]->min_production_days }} working days.</li>
      </ul>

      @if ($enquiryQuoteLinkage[0]->additional_notes != 'N/A')
        <h4>Additional Notes</h4>
        <ul>
          <li>{{ $enquiryQuoteLinkage[0]->additional_notes }}</li>
        </ul>
      @endif

      <div class="row">
        <div class="col-xs-12">
          <p>
            For any legal issues, it is subjected to Hyderabad Judiciary only.<br>
            This Quotation is prepared to our best.
          </p>
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
