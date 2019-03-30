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
        <table>
          <thead>
            <tr>
              <td>
                HEADER
              </td>
            </tr>
          </thead>
        </table>

        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <img src="{{ asset('images/merakiStoreFooterLogo.png') }}"
              class="img-fluid figure-img" alt="Meraki Store" style="width: 150px;" />
              <span style="float:right;"><p><strong>MERAKII ENTERPRISES</strong></p>
              <address>
                <p style="font-size: 15px;">
                2-18-86, Ambedkar Nagar, Uppal<br>
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
              <tr style="background-color: #Ffce37 !important">
                <th>S No</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Cost Per Unit</th>
                <th>GST Tax</th>
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
                    <td>Rs.{{ $quoteEntry->gst_tax }}/-</td>
                    <td>Rs.{{ $quoteEntry->total_amount }}/-</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <br>


      <div style="page-break-before: always; width: 100%;" class="page-header headerContent">
        <img src="{{ asset('images/merakiStoreFooterLogo.png') }}"
        class="img-fluid figure-img" alt="Meraki Store" style="width: 150px; display:none;" />
        <span style="float:right; display:none;"><p><strong>MERAKII ENTERPRISES</strong></p>
      </div>

      @php
        $key = 0
      @endphp
      @foreach ($enquiryQuote as $quoteEntryDup)

        <b>{{ $quoteEntryDup->product_description }} Features</b>
        <ul>
          <li>{{ $productCodesModel[$key]->feature_1 }}</li>
          <li>{{ $productCodesModel[$key]->feature_2 }}</li>
          <li>{{ $productCodesModel[$key]->feature_3 }}</li>
          <li>{{ $productCodesModel[$key]->feature_4 }}</li>
          <li>{{ $productCodesModel[$key]->feature_5 }}</li>
        </ul>
        <br><br>

        <b><span style="color: #Ffce37;">Product Description:</span> {{ $enquiryQuote[$key]->product_description }} </b><br><br>
        <table class="table table-bordered table-striped">
          <tr>
            <td style="width:30%;"><b>Fabric Colour</b></td><td>{{ $enquiryQuote[$key]->fabric_colour }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Art work logo</b></td><td>{{ $enquiryQuote[$key]->art_work_logo }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Front Panel</b></td><td>{{ $enquiryQuote[$key]->front_panel }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Back Panel</b></td><td>{{ $enquiryQuote[$key]->back_panel }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Finishing</b></td><td>{{ $productCodesModel[$key]->finishing }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Fitting sizes</b></td><td>{{ $productCodesModel[$key]->fitting_sizes }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Packaging</b></td><td>{{ $productCodesModel[$key]->packaging }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Inclusive</b></td>
            <td>{{ $productCodesModel[$key]->inclusive }}</td>
          </tr>
          <tr>
            <td style="width:30%"><b>Exclusive</b></td><td>{{ $productCodesModel[$key]->exclusive }}</td>
          </tr>
        </table>

        <div class="footerContent">
            <img src="{{ asset('images/footer.png') }}" class="img-fluid" alt="Footer" style="width:100%;">
        </div>

        <div style="page-break-before: always; width: 100%;" class="page-header headerContent">
          <img src="{{ asset('images/merakiStoreFooterLogo.png') }}"
          class="img-fluid figure-img" alt="Meraki Store" style="width: 150px;"/>
          <span style="float:right;"><p><strong>MERAKII ENTERPRISES</strong></p>
        </div>

        @php
          $key++
        @endphp
      @endforeach

      <br>
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
        <li>The above quotation is for the total quantites as per the requirement, if the quantity reduces
            pricing will be increased proportionatlly.
        </li>
        <li>Every product will have Merakii label to indicate our band.</li>
        <li><b>Payment Terms:</b> Require 50% as advance on the total value to start the production and the
            balance amount should be paid on or before final delivery.
        </li>
        <li><b>Delivery Schedule:</b> Require production time of 20-25 working days.</li>
      </ul>
      <br>

      <br><br><br>
      <div style="page-break-after: always; width: 100%;" class="footerContent">
          <br><br><br><br><br>
          <img src="{{ asset('images/footerLogo.png') }}" alt="Footer">
      </div>


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

      <table>
        <tfoot>
          <tr><td><img src="{{ asset('images/footer.png') }}" class="img-fluid" alt="Footer" style="width:100%;"></td></tr>
        </tfoot>
      </table>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
      </div>

      <table>
        <tfoot>
          <tr>
            <td>
              FOOTER
            </td>
          </tr>
        </tfoot>
      </table>

    </section>
    </section>


  </div>

@endsection

@section('printCss')

  <style type="text/css" media="print">
        @page
        {
            size: auto; /* auto is the initial value */
            margin: 0mm; /* this affects the margin in the printer settings */
        }
        td {
          padding-left: 10px;
        }
        thead
        {
            display: table-header-group;
        }
        tfoot
        {
            display: table-footer-group;
            position: fixed;
            bottom: 0;
        }
    </style>
    <style type="text/css" media="screen">
        thead
        {
            display: block;
        }
        tfoot
        {
            display: block;
        }
    </style>
@endsection
