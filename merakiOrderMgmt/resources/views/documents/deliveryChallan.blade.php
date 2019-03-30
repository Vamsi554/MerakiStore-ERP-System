@extends('layouts.templateNoFooter')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Delivery Challan #{{ $dcCode }}
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
        <h4 class="text-center"><strong> DELIVERY CHALLAN </strong></h4>
        <div class="col-sm-4 invoice-col">
          <b>Sold To</b>
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
        <div class="col-sm-4 invoice-col">
          <b>Ship To</b>
          <address>
            @php
              $shipAddrArr = explode(",", $order->shipmentAddress);
            @endphp
            @for($i=0; $i<count($shipAddrArr); $i++)
              {{ $shipAddrArr[$i] }} <br>
            @endfor
            </i></b><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Date: </b> {{ $orderDeliveryChallan[0]->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y") }} <br>
          <br>
          <b>Challan No: </b> {{ $dcCode }} <br>
          <b>Way Bill No: </b> {{ $orderDeliveryChallan[0]->way_bill_number }}<br>
          <b>GSTIN: </b> {{ $order->GSTIN }} <br>
          <b>Client GST No: </b> {{ $order->client_gst_number }} <br>
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
              <th>HSN/SAC</th>
              <th>Ordered Quantity</th>
              <th>Delivered Quantity</th>
              <th>Pending Quantity</th>
            </tr>
            </thead>
            <tbody>
              @for($v=0; $v<count($orderDeliveryChallan); $v++)
                <tr>
                  <td>{{ $v + 1 }}</td>
                  <td>{{ $orderDeliveryChallan[$v]->product_description }}</td>
                  <td>{{ $orderDeliveryChallan[$v]->hsn_code }}</td>
                  <td>{{ $orderDeliveryChallan[$v]->total_quantity }} Units</td>
                  <td>{{ $orderDeliveryChallan[$v]->delivered_quantity }} Units</td>
                  <td>{{ $orderDeliveryChallan[$v]->balance_quantity }} Units</td>
                </tr>
              @endfor
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <h4>Terms and Conditions</h4>
      <br>
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

      <br>

      <div class="row">
        <div class="col-xs-4">
          <p class="lead">Order Details</p>
          <p><strong>Purchase Order No :</strong> {{ $order->purchaseOrderNumber }}</p>
          <p><strong>Reference No:</strong> {{ $order->documentNumber }} </p>
          <p><strong>Delivery Challan :</strong> {{ $dcCode }} </p>
          <p><strong>Mode Of Transport :</strong> {{ $orderDeliveryChallan[0]->transport_mode }} </p>
          <p><strong>Vehicle No :</strong> {{ $orderDeliveryChallan[0]->vehicle_number }} </p>
          <p><strong>Place of Supply :</strong> {{ $orderDeliveryChallan[0]->place_of_supply }} </p>
        </div>
        <div class="col-xs-4">
          <p class="lead">GSTIN: 36BOPPG4920P1ZD </p>
          <p>I/We hereby certify that our
            registration certificate under
            the Telangana value added tax
            Act.2014.</p>
        </div>
        <div class="col-xs-4">
          <p class="lead">Authorised Signatory</p>
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

      @page
      {
          size: auto;   /* auto is the initial value */
          margin: 0mm;  /* this affects the margin in the printer settings */
      }

      @media print {
        body {-webkit-print-color-adjust: exact !important;}
      }

  </style>

@endsection
