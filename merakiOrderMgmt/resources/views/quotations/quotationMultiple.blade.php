@extends('layouts.templateNoFooter')

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
              @php
                $index = 1
              @endphp
              @foreach ($enquiryQuote as $quoteEntry)
                <tr>
                  <td>{{ $index++ }}</td>
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
            D.No:101, Near SR Club, Sri Nagar Colony<br>
            Hyderabad, Telangana<br>
            Tel: 040-48554470, 9000909109<br><br>
            Email: <b><i>abhilash.merakii@gmail.com</i></b><br>
          </p>
      </div>

      @for($key=0; $key<count($enquiryQuote); $key++)

        <h4>{{ $enquiryQuote[$key]->product_description }} Features</h4>
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
        <li>Price mentioned for the above Hoodie is inclusive of material and fabrication, GST 5%, art work
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
      <br>
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
          <br><br>
          With Regards<br>
          <b>Meraki Enterprises</b>
          <br><br><br><br>
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
