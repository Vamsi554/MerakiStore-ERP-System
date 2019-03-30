@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Enquiry | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Enquiry - <span style="color:#Ffce37;"><b>{{ $enquiry->documentNumber }}, {{ $enquiry->enquiryStatus }}</b></span></h3>
            </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <table class="table table-bordered table-striped">
                <h4 class="box-title"> Basic Details </h4>
                    <tr>
                        <td style="width:30%">Lead Person</td>
                        <td>
                          {{ $enquiry->concernedLeadPerson }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Creation Date</td>
                        <td>
                          {{ $enquiry->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Last Modified Date</td>
                        <td>
                          {{ $enquiry->updated_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Lead Source</td>
                        <td>
                          {{ $enquiry->leadSource }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Document Number</td>
                        <td>
                          <b>{{ $enquiry->documentNumber }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Organization Name</td>
                        <td>
                          <b>{{ $enquiry->organizationName }}</b>
                        </td>
                    </tr>
               </table>
            </div>
            <div class="col-md-6">
              <table class="table table-bordered table-striped">
                <h4 class="box-title"> Event & Contact Details </h4>
                    <tr>
                        <td style="width:30%">Event Name</td>
                        <td>
                          <b>{{ $enquiry->eventName }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Event Place</td>
                        <td>
                          {{ $enquiry->eventPlace }}
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%">Event Date</td>
                        <td>
                          <b>{{ date('d-M-Y', strtotime($enquiry->eventDate)) }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Contact</td>
                        <td>
                          {{ $enquiry->name }}, {{ $enquiry->designation }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Phone</td>
                        <td>
                          {{ $enquiry->phone }}
                          @if($enquiry->alternatePhone != null)
                            , {{ $enquiry->alternatePhone }}
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Email Address</td>
                        <td>
                          {{ $enquiry->email }}
                        </td>
                    </tr>
               </table>
            </div>
          </div>

              <table class="table table-bordered table-striped">
                <h4 class="box-title"> Requirement Details </h4>
                  <input type="hidden" id="reqCount" name="reqCount">
                  <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                      <tr>
                        <th class="text-center">Product Details</th>
                        <th class="text-center">Art Work Design</th>
                        <th class="text-center">Customization Details</th>
                        <th class="text-center">Additional Details</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                      @foreach ($enquiryRequirements as $enquiryReq)
                        <tr id='addr<?php echo $i; ?>'>
                          <td style="width:22%;">
                            <b>Category</b> : {{ $enquiryReq->product_category }} <br><br>

                            <b>Description</b> : {{ $enquiryReq->product_description }} <br><br>

                            @if($enquiryReq->status == 'Approved')
                              <span class="label label-success">Approved</span>
                            @elseif ($enquiryReq->status == 'Hold')
                              <span class="label label-warning">Hold</span>
                            @else
                              <span class="label label-danger">Cancel</span>
                            @endif
                          </td>
                          <td style="width:15%;">
                            {{ $enquiryReq->art_work_notes }}
                          </td>
                          <td style="width: 32%;">
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
                          <td>
                            <b>Finishing</b> : @if($enquiryReq->finishing == '0' || $enquiryReq->finishing == null) N/A @else {{ $enquiryReq->finishing }} @endif <br><br>
                            <b>Packaging</b> : @if($enquiryReq->packaging == '0' || $enquiryReq->packaging == null) N/A @else {{ $enquiryReq->packaging }} @endif <br><br>
                            <b>Inclusive</b> : @if($enquiryReq->inclusive == '0' || $enquiryReq->inclusive == null) N/A @else {{ $enquiryReq->inclusive }} @endif <br><br>
                            <b>Exclusive</b> : @if($enquiryReq->exclusive == '0' || $enquiryReq->exclusive == null) N/A @else {{ $enquiryReq->exclusive }} @endif <br><br>
                          </td>
                        </tr>
                        <?php $i++; ?>
                      @endforeach
                    </tbody>
                  </table>
              </table>

              <table class="table table-bordered table-striped">
                <h4 class="box-title"> Enquiry Status </h4>
                    <tr>
                        <td style="width:30%">Enquiry Status</td>
                        <td>
                          @if($enquiry->enquiryStatus == 'APPROVED')
                            <span class="label label-success">APPROVED</span>
                          @else
                            <span class="label label-warning">{{ $enquiry->enquiryStatus }}</span>
                          @endif
                        </td>
                    </tr>
               </table>

               @if(count($enquiryQuoteLinkage) > 0 && ($enquiry->enquiryStatus == 'APPROVED' || $enquiry->enquiryStatus == 'REQUEST FOR QUOTATION' || $enquiry->enquiryStatus == 'REQUEST FOR REVISED QUOTATION'))
                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> View Quotations </h4>
                   @foreach ($enquiryQuoteLinkage as $quote)
                     <tr>
                         <td style="width:30%">Effective Date : {{ $quote->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}</td>
                         <td>
                           <a href="{{ URL::to('/') }}/enquiry/quotation/{{ $enquiry->id }}/{{ $quote->quotation_code }}" class="btn btn-success" target="_blank">View Quotation</a>
                         </td>
                     </tr>
                   @endforeach
                  </table>
               @endif

               @if(count($enquiryQuoteLinkage) > 0 && ($enquiry->enquiryStatus != 'APPROVED' && $enquiry->enquiryStatus != 'REQUEST FOR QUOTATION' && $enquiry->enquiryStatus != 'REQUEST FOR REVISED QUOTATION'))

                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> View Quotations </h4>

                   @foreach ($enquiryQuoteLinkage as $quote)
                     <tr>
                         <td style="width:30%">Effective Date : {{ $quote->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}</td>
                         <td>
                           <a href="{{ URL::to('/') }}/enquiry/quotation/{{ $enquiry->id }}/{{ $quote->quotation_code }}" class="btn btn-success" target="_blank">View Quotation</a>
                         </td>
                         <td>
                         @if($quote->quotation_status == 'APPROVED')
                           <a href="javascript:void(0);" class="btn btn-default disabled">Proceed With Order Creation</a>
                         @else
                           <a href="{{ URL::to('/') }}/order/createOrder/{{ $enquiry->id }}/{{ $quote->quotation_code }}" class="btn btn-warning" target="_blank">Proceed With Order Creation</a>
                         @endif
                         </td>
                     </tr>
                   @endforeach

                  </table>
               @endif

               @if($enquiry->quotationResponse != null OR $enquiry->quotationResponse != '')
                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> Quotation Response </h4>
                     <tr>
                         <td style="width:30%">Response</td>
                         <td>
                           {{ $enquiry->quotationResponse }}
                         </td>
                     </tr>
                 </table>
               @endif

               <table class="table table-bordered table-striped">
                 <h4 class="box-title"> Sample Details </h4>
                     <tr>
                         <td style="width:30%">Sample Package Sent</td>
                         <td>
                            {{ $enquiry->sampleDetailsSent }}
                         </td>
                     </tr>
                     <tr>
                         <td style="width:30%">Sample Package Comments</td>
                         <td>
                           {{ $enquiry->sampleDetailsComments }}
                         </td>
                     </tr>
                     <tr>
                         <td style="width:30%">Customer Received Sample Package</td>
                         <td>
                           {{ $enquiry->sampleReceivedByCustomer }}
                         </td>
                     </tr>
                     <tr>
                         <td style="width:30%">Customer Review & Feedback</td>
                         <td>
                           {{ $enquiry->samplesCustomerFeedback }}
                         </td>
                     </tr>
                </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
