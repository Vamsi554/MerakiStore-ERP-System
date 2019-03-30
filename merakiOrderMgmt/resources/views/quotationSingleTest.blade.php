@extends('layouts.templateNoFooter')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Quotation #{{ $id }}
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
          <p style="float:right"><strong>Date:</strong> 22/08/2018 </p>
          <strong>To,</strong><br>
          ISB,<br>
          ISB Leader Summit 2017,<br>
          Hyderabad.<br>
          <br>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <strong>Kind Attn: </strong> Mrs. Surya Tej, Chief Co-ordinator (Events & Operations) <br>
          Mob. No. 9633645369 <br>
          <br>
          <strong>Sub: ISB Leader Summit 2017 Merchandise Kit Quotation Details.</strong><br>
          <br>
          <strong>Sub: Quotation for Notepads and Pen.</strong><br>
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
              <tr>
                <td>1</td>
                <td>Zipper Hoodie Export Quality</td>
                <td>115 Units</td>
                <td>Rs.1200/-</td>
                <td>Rs.60/-</td>
                <td>Rs.1260/-</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>

      <b>Zipper Hoodie Features</b>
      <ul>
        <li>Material 360-380 gsm</li>
        <li>Metal Zipper</li>
        <li>All colors are poly/cotton blend</li>
        <li>Double-needed stitched for durability</li>
        <li>Front-pouch pockets</li>
        <li>Stretchy athletic ribbed cuffs and waistband</li>
        <li>Two-ply hood with grommets and matching drawcord</li>
      </ul>

      <div style="page-break-before: always; width: 100%;" class="page-header headerContent">
        <img src="{{ asset('images/merakiStoreFooterLogo.png') }}"
        class="img-fluid figure-img" alt="Meraki Store" style="width: 150px;" />
        <span style="float:right;"><p><strong>MERAKII ENTERPRISES</strong></p>
      </div>

      <b><span style="color: #Ffce37;">Product Description:</span> Zipper Hoodie </b><br><br>
      <table border="1">
        <tr>
          <td style="width:30%;"><b>Fabric Colour</b></td><td>Black</td>
        </tr>
        <tr>
          <td style="width:30%"><b>Art work logo</b></td><td>Embroidery</td>
        </tr>
        <tr>
          <td style="width:30%"><b>Front Panel</b></td><td>Oracle Logo Embroidery</td>
        </tr>
        <tr>
          <td style="width:30%"><b>Back Panel</b></td><td>N/A</td>
        </tr>
        <tr>
          <td style="width:30%"><b>Finishing</b></td><td>Crease free, wrinkle free</td>
        </tr>
        <tr>
          <td style="width:30%"><b>Fitting sizes</b></td><td>S, M, L, XL, XXL, XXXL. (Sizes as per indian measurements)*</td>
        </tr>
        <tr>
          <td style="width:30%"><b>Packaging</b></td><td>Individual box packing, Packed as per the convenience</td>
        </tr>
        <tr>
          <td style="width:30%"><b>Inclusive</b></td>
          <td>Product cost, Art work embroidery charges, Individual polythene cover packing, GST-5% and Fright charges.</td>
        </tr>
        <tr>
          <td style="width:30%"><b>Exclusive</b></td><td>Any customization apart from the Inclusive.</td>
        </tr>
      </table>

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

      <br><br>

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
      }

      @media screen {

        .headerContent {
          display: none;
        }
      }

  </style>

@endsection
