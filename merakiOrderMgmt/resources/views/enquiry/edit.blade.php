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
              <h3 class="box-title"> Enquiry Form </h3>
            </div>

            <div class="box-body">
              @if(Session::has('success'))
                  <div class="alert alert-success" style="display: inline-block;">
                     {{ Session::get('success') }}
                        @php
                         Session::forget('success');
                        @endphp
                   </div>
               @endif

               <form method="POST" action="{{ URL::to('/') }}/enquiry/updateEnquiry/{{ $enquiry->id }}" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="concernedLeadPerson" id="concernedLeadPerson" value="{{ Auth::user()->name }}">
                 <input type="hidden" name="enquiryCreDttm" id="enquiryCreDttm" value="{{ Carbon\Carbon::now()->toDateString() }}">

                 <div class="row">
                   <div class="col-md-6">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Event Details </h4>

                           <tr class="{{ $errors->has('leadSource') ? 'has-error' : '' }}">
                               <td style="width:30%">Lead Source</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Lead Source" type="text" id="leadSource"
                                 name="leadSource" size="27" style="width:100%!important" value="{{ $enquiry->leadSource }}" readonly required>
                                 <span class="text-danger">{{ $errors->first('leadSource') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('eventName') ? 'has-error' : '' }}">
                               <td style="width:30%">Event Name</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Event Name" type="text" id="eventName"
                                 name="eventName" size="27" style="width:100%!important" value="{{ $enquiry->eventName }}" required>
                                 <span class="text-danger">{{ $errors->first('eventName') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('eventPlace') ? 'has-error' : '' }}">
                               <td style="width:30%">Event Place</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Event Place" type="text" id="eventPlace"
                                 name="eventPlace" size="27" style="width:100%!important" value="{{ $enquiry->eventPlace }}" required>
                                 <span class="text-danger">{{ $errors->first('eventPlace') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('organizationName') ? 'has-error' : '' }}">
                               <td style="width:30%">Organization Name</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Organization Name" type="text" id="organizationName"
                                 name="organizationName" size="27" style="width:100%!important" value="{{ $enquiry->organizationName }}" required>
                                 <span class="text-danger">{{ $errors->first('organizationName') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('eventDate') ? 'has-error' : '' }}">
                               <td style="width:30%">Event Date</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Event Date" type="date" id="eventDate"
                                 name="eventDate" size="27" style="width:100%!important" value="{{ $enquiry->eventDate }}" required>
                                 <span class="text-danger">{{ $errors->first('eventDate') }}</span>
                               </td>
                           </tr>
                      </table>
                   </div>

                   <div class="col-md-6">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Contact Details </h4>
                           <tr class="{{ $errors->has('name') ? 'has-error' : '' }}">
                               <td style="width:30%">Name</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Name" type="text" id="name"
                                 name="name" size="27" style="width:100%!important" value="{{ $enquiry->name }}" required>
                                 <span class="text-danger">{{ $errors->first('name') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('phone') ? 'has-error' : '' }}">
                               <td style="width:30%">Phone</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Phone" type="text" id="phone"
                                 name="phone" size="27" style="width:100%!important" value="{{ $enquiry->phone }}" required>
                                 <span class="text-danger">{{ $errors->first('phone') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('alternatePhone') ? 'has-error' : '' }}">
                               <td style="width:30%">Alternate Phone </td>
                               <td>
                                 <input class="form-control" placeholder="Enter Alternate Phone" type="text" id="alternatePhone"
                                 name="alternatePhone" size="27" style="width:100%!important" value="{{ $enquiry->alternatePhone }}">
                                 <span class="text-danger">{{ $errors->first('alternatePhone') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('designation') ? 'has-error' : '' }}">
                               <td style="width:30%">Designation</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Designation" type="text" id="designation"
                                 name="designation" size="27" style="width:100%!important" value="{{ $enquiry->designation }}" required>
                                 <span class="text-danger">{{ $errors->first('designation') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('email') ? 'has-error' : '' }}">
                               <td style="width:30%">Email Address</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Email Address" type="email" id="email"
                                 name="email" size="27" style="width:100%!important" value="{{ $enquiry->email }}" required>
                                 <span class="text-danger">{{ $errors->first('email') }}</span>
                               </td>
                           </tr>
                      </table>
                   </div>
                 </div>

                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> Requirement Details </h4>
                     <input type="hidden" id="reqCount" name="reqCount">
                     <table class="genericFeaturesTbl table table-bordered table-hover" id="tab_logic">
                       <thead>
                         <tr>
                           <th class="text-center">Actions</th>
                           <th class="text-center">Product Category</th>
                           <th class="text-center">Description</th>
                           <th class="text-center">Quantity</th>
                           <th class="text-center">Art Work Notes</th>
                           <th class="text-center">Features <br> Customizations</th>
                           <th class="text-center">Requirement Confirmation</th>
                         </tr>
                       </thead>
                       <tbody>
                         <?php $i = 0; ?>
                         @foreach ($enquiryRequirements as $enquiryReq)
                         <tr id='addr<?php echo $i; ?>'>
                           <td style="width:10%;">
                             <p class="ibtnAdd btn btn-md btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></p>
                             <p class="ibtnDel btn btn-md btn-danger" style="float:right;"><i class="fa fa-trash" aria-hidden="true"></i></p>
                           </td>
                           <td style="width:16%;">
                             <select class="form-control" id="productCd<?php echo $i; ?>" name="productCd[]" required>
                               <option>{{ $enquiryReq->product_category }}</option>
                              @foreach($productsDtls as $productCd) {
                                @if($productCd->product_category != $enquiryReq->product_category)
                                  <option>{{ $productCd->product_category }}</option>
                                @endif
                              @endforeach
                             </select>
                           </td>
                           <td style="width:20%;"><input class="form-control" type="text" name="productDescr[]" placeholder="Description" value="{{ $enquiryReq->product_description }}" required></td>
                           <td style="width:10%;"><input class="form-control" type="number" placeholder="Qty" name="quantity[]" value="{{ $enquiryReq->quantity }}" required></td>
                           <td style="display:none;">
                             <input class="form-control" type="hidden" placeholder="Product_Style" id="productStyleFeatures<?php echo $i; ?>" name="productStyleFeatures[]" value="{{ $enquiryReq->product_style }}" required>
                             <input class="form-control" type="hidden" placeholder="Material" id="materialFeatures<?php echo $i; ?>" name="materialFeatures[]" value="{{ $enquiryReq->material }}" required>
                             <input class="form-control" type="hidden" placeholder="Quality" id="quality<?php echo $i; ?>" name="qualityFeatures[]" value="{{ $enquiryReq->quality }}" required>
                             <input class="form-control" type="hidden" placeholder="Fabric" id="fabricFeatures<?php echo $i; ?>" name="fabricFeatures[]" value="{{ $enquiryReq->fabric }}" required>
                             <input class="form-control" type="hidden" placeholder="Additional_Features" id="additionalFeatures<?php echo $i; ?>" name="additionalFeatures[]" value="{{ $enquiryReq->additional_features }}" required>
                             <input class="form-control" type="hidden" placeholder="Colour" id="colourCustomizations<?php echo $i; ?>" name="colourCustomizations[]" value="{{ $enquiryReq->colour }}" required>
                             <input class="form-control" type="hidden" placeholder="Print_Methods" id="printMethodCustomizations<?php echo $i; ?>" name="printMethodCustomizations[]" value="{{ $enquiryReq->print_methods }}" required>
                             <input class="form-control" type="hidden" placeholder="Print_Placements" id="printPlacementCustomizations<?php echo $i; ?>" name="printPlacementCustomizations[]" value="{{ $enquiryReq->print_placements }}" required>
                             <input class="form-control" type="hidden" placeholder="Print_Area" id="printAreaCustomizations<?php echo $i; ?>" name="printAreaCustomizations[]" value="{{ $enquiryReq->print_area }}" required>
                             <input class="form-control" type="hidden" placeholder="Measurements" id="measurementsCustomizations<?php echo $i; ?>" name="measurementsCustomizations[]" value="{{ $enquiryReq->measurements }}" required>
                             <input class="form-control" type="hidden" placeholder="Additional_Customizations" id="additionalCustomizations<?php echo $i; ?>" name="additionalCustomizations[]" value="{{ $enquiryReq->additional_customizations }}" required>
                             <input class="form-control" type="hidden" placeholder="Finishing" id="finishing<?php echo $i; ?>" name="finishing[]" value="{{ $enquiryReq->finishing }}" required>
                             <input class="form-control" type="hidden" placeholder="Packaging" id="packaging<?php echo $i; ?>" name="packaging[]" value="{{ $enquiryReq->packaging }}" required>
                             <input class="form-control" type="hidden" placeholder="Inclusive" id="inclusive<?php echo $i; ?>" name="inclusive[]" value="{{ $enquiryReq->inclusive }}" required>
                             <input class="form-control" type="hidden" placeholder="Exclusive" id="exclusive<?php echo $i; ?>" name="exclusive[]" value="{{ $enquiryReq->exclusive }}" required>
                           </td>
                           <td style="width:20%;">
                             <input class="form-control" type="text" name="artWorkNotes[]" placeholder="Art Work Description" value="{{ $enquiryReq->art_work_notes }}" required>
                           </td>
                           <td style="width:10%;text-align:center;">
                             <a href="#prodFeaturesModal" data-counter='<?php echo $i; ?>' data-id='productCd<?php echo $i; ?>'
                               id="selectCustomProdFeatures" class="btn btn-warning" data-toggle="modal">Select</a>
                           </td>
                           <td style="width:20%;">
                             <select class="form-control" name="status[]"
                              required>
                                <option selected="selected">{{ $enquiryReq->status }}</option>
                                @if($enquiryReq->status != 'Approved') {
                                   <option>Approved</option>
                                }
                                @endif;
                                @if($enquiryReq->status != 'Hold') {
                                   <option>Hold</option>
                                }
                                @endif;
                                @if($enquiryReq->status != 'Cancel') {
                                   <option>Cancel</option>
                                }
                                @endif;
                              </select>
                           </td>
                         </tr>
                         <?php $i++; ?>
                         @endforeach
                       </tbody>
                     </table>
                 </table>
                 <br><br>

                 <div class="modal fade" id="prodFeaturesModal" role="dialog" tabindex="-1">
                   <div class="modal-dialog">
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h3 class="modal-title"><span class="modelProdCode"></span> Features / Customizations / Conditions </h3>
                       </div>
                       <div class="modal-body">
                         <div>
                             <div id="modalProductFeaturesCheckbox"></div>
                         </div>
                         <br>
                         <div>
                             <div id="modalProductCustomizationsCheckbox"></div>
                         </div>
                         <br>
                         <div>
                             <div id="modalProductConditionsCheckbox"></div>
                         </div>
                         <br>
                         <h4 id="merakiProductsModalErrorText" class="text-danger"></h4>
                       </div>
                       <div class="modal-footer">
                         <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       </div>
                     </div>
                   </div>
                 </div>


                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                      <h4 class="box-title"> Enquiry / Quotation Status </h4>

                        <tr class="{{ $errors->has('enquiryStatus') ? 'has-error' : '' }}">
                            <td style="width:30%">Enquiry Status</td>
                            <td>
                              <select class="form-control" style="width: 100%;" id="enquiryStatus"
                              name="enquiryStatus" value="{{ $enquiry->enquiryStatus }}">
                               <option selected="selected">{{ $enquiry->enquiryStatus }}</option>
                               @if($enquiry->enquiryStatus == 'QUOTATION GENERATED' || $enquiry->enquiryStatus == 'REVISED QUOTATION GENERATED') {
                                 <option>REQUEST FOR REVISED QUOTATION</option>
                               }
                               @else
                                 <option>REQUEST FOR QUOTATION</option>
                               @endif
                               @if($enquiry->enquiryStatus != 'ON HOLD') {
                                 <option>ON HOLD</option>
                               }
                               @endif
                               @if($enquiry->enquiryStatus != 'CANCEL') {
                                 <option>CANCEL</option>
                               }
                               @endif
                              </select>
                              <span class="text-danger">{{ $errors->first('enquiryStatus') }}</span>
                            </td>
                        </tr>

                        <tr class="{{ $errors->has('enquiryComments') ? 'has-error' : '' }}">
                            <td style="width:30%">Enquiry Comments</td>
                            <td>
                              <input class="form-control" placeholder="Enquiry Comments" type="text" id="enquiryComments"
                              name="enquiryComments" size="27" style="width:100%!important" required>
                              <span class="text-danger">{{ $errors->first('enquiryComments') }}</span>
                            </td>
                        </tr>
                     </table>
                  </div>

                  <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                      <h4 class="box-title"> Sample Details </h4>
                      <tr class="{{ $errors->has('sampleDetailsSent') ? 'has-error' : '' }}">
                          <td style="width:30%">Sample Package Sent</td>
                          <td>
                            <select class="form-control" style="width: 100%;" id="sampleDetailsSent"
                            name="sampleDetailsSent" value="{{ $enquiry->sampleDetailsSent }}">
                            <option selected="selected">{{ $enquiry->sampleDetailsSent }}</option>
                            @if($enquiry->sampleDetailsSent != 'No') {
                               <option>No</option>
                            }
                            @endif
                            @if($enquiry->sampleDetailsSent != 'Yes') {
                               <option>Yes</option>
                            }
                            @endif
                            </select>
                            <span class="text-danger">{{ $errors->first('sampleDetailsSent') }}</span>
                          </td>
                      </tr>

                      <tr class="{{ $errors->has('sampleDetailsComments') ? 'has-error' : '' }}">
                          <td style="width:30%">Sample Package Comments</td>
                          <td>
                            <textarea rows="4" cols="50" class="form-control" type="text" id="sampleDetailsComments"
                            name="sampleDetailsComments" size="27" style="width:100%!important"
                            value="{{ $enquiry->sampleDetailsComments }}" required>{{ $enquiry->sampleDetailsComments }}</textarea>
                            <span class="text-danger">{{ $errors->first('sampleDetailsComments') }}</span>
                          </td>
                      </tr>

                     </table>
                  </div>

                  <div class="col-md-6">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Customer Feedback </h4>

                       <tr class="{{ $errors->has('sampleReceivedByCustomer') ? 'has-error' : '' }}">
                           <td style="width:30%">Customer Received</td>
                           <td>
                             <select class="form-control" style="width: 100%;" id="sampleReceivedByCustomer"
                             name="sampleReceivedByCustomer" value="{{ $enquiry->sampleReceivedByCustomer }}">
                             <option selected="selected">{{ $enquiry->sampleReceivedByCustomer }}</option>
                             @if($enquiry->sampleReceivedByCustomer != 'No') {
                                <option>No</option>
                             }
                             @endif
                             @if($enquiry->sampleReceivedByCustomer != 'Yes') {
                                <option>Yes</option>
                             }
                             @endif
                             </select>
                             <span class="text-danger">{{ $errors->first('sampleReceivedByCustomer') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('samplesCustomerFeedback') ? 'has-error' : '' }}">
                           <td style="width:30%">Feedback</td>
                           <td>
                             <textarea rows="4" cols="50" class="form-control" type="text" id="samplesCustomerFeedback"
                             name="samplesCustomerFeedback" size="27" style="width:100%!important"
                             value="{{ $enquiry->samplesCustomerFeedback }}" required>{{ $enquiry->samplesCustomerFeedback }}</textarea>
                             <span class="text-danger">{{ $errors->first('samplesCustomerFeedback') }}</span>
                           </td>
                       </tr>

                      </table>
                  </div>
                </div>

                  <button class="btn btn-primary" type="submit">Update Enquiry</button>
              </form>
              <br/>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection


@section('loadDynamicProductDetails')

  <script type="text/javascript">

  $(document).ready(function() {

      $("#merakiProductsModalErrorText").hide();

      $(".genericFeaturesTbl").on("click", ".ibtnAdd", function (event) {

          var i = $('#tab_logic tr').length - 2;
          var newRow = $("<tr>");
          var cols = "";
          cols += "<td style='width:10%;'><p class='ibtnAdd btn btn-md btn-primary'><i class='fa fa-plus' aria-hidden='true'></i></p><p class='ibtnDel btn btn-md btn-danger' style='float:right;'><i class='fa fa-trash' aria-hidden='true'></i></p></td>";
          cols += "<td style='width:16%;'><select class='form-control' id='productCd" + (i+1) + "' name='productCd[]' required>@foreach($productsDtls as $productCd) { <option>{{ $productCd->product_category }}</option> } @endforeach </select> </td>";
          cols += "<td style='width:20%;'><input class='form-control' type='text' name='productDescr[]' placeholder='Description' required></td>";
          cols += "<td style='width:10%;'><input class='form-control' type='number' placeholder='Qty' name='quantity[]' required></td>";
          cols += "<td style='display:none;'>";
          cols += "<input class='form-control' type='hidden' placeholder='Product_Style' id='productStyleFeatures" + (i+1) + "' name='productStyleFeatures[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Material' id='materialFeatures" + (i+1) + "' name='materialFeatures[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Quality' id='quality" + (i+1) + "' name='qualityFeatures[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Fabric' id='fabricFeatures" + (i+1) + "' name='fabricFeatures[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Additional_Features' id='additionalFeatures" + (i+1) + "' name='additionalFeatures[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Colour' id='colourCustomizations" + (i+1) + "' name='colourCustomizations[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Print_Methods' id='printMethodCustomizations" + (i+1) + "' name='printMethodCustomizations[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Print_Placements' id='printPlacementCustomizations" + (i+1) + "' name='printPlacementCustomizations[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Print_Area' id='printAreaCustomizations" + (i+1) + "' name='printAreaCustomizations[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Measurements' id='measurementsCustomizations" + (i+1) + "' name='measurementsCustomizations[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Additional_Customizations' id='additionalCustomizations" + (i+1) + "' name='additionalCustomizations[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Finishing' id='finishing" + (i+1) + "' name='finishing[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Packaging' id='packaging" + (i+1) + "' name='packaging[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Inclusive' id='inclusive" + (i+1) + "' name='inclusive[]' required>";
          cols += "<input class='form-control' type='hidden' placeholder='Exclusive' id='exclusive" + (i+1) + "' name='exclusive[]' required>";
          cols += "</td>";
          cols += "<td style='width:20%;'><input class='form-control' type='text' name='artWorkNotes[]' placeholder='Art Work Description' required></td>";
          cols += "<td style='width:10%;text-align:center;'><a href='#prodFeaturesModal' data-counter='"+ (i+1) + "' data-id='productCd" + (i+1) + "' id='selectCustomProdFeatures' class='btn btn-warning' data-toggle='modal'>Select</a> </td>";
          cols += "<td style='width:20%;'><select class='form-control' name='status[]' required><option selected='selected'>Approved</option><option>Hold</option><option>Cancel</option></select></td>";

          newRow.append(cols);
          $(this).closest("tr").after(newRow);
      });

      $(".genericFeaturesTbl").on("click", ".ibtnDel", function (event) {

          var tableLength = $(this).closest("table").find("tr").length - 1;
          if(tableLength > 1) {
            $(this).closest("tr").remove();
          }
      });

      $(document).on("click", "#selectCustomProdFeatures", function() {

        $('input[type=checkbox]').each(function()
        {
            this.checked = false;
        });

        var productId = $(this).data("id");
        var prodCounter = $(this).data("counter");
        var productCd = $("#" + productId).val();
        $(".modelProdCode").text(productCd);

        $.ajax({
          data: {
            productCode : productCd,
            token: $("#token").val()
          },
          url: '{{ URL::to('/') }}/productDetails/' + productCd,

          success: function(info) {

            $("#modalProductFeaturesCheckbox").html("");
            $("#modalProductCustomizationsCheckbox").html("");
            $("#modalProductConditionsCheckbox").html("");

            var productFeaturesArray = [info.product_style, info.material, info.quality, info.fabric, info.additional_features];
            var productFeaturesConstants = ["Product Style", "Material", "Quality", "Fabric", "Additional Features"];
            var productFeaturesIdArr = ["productStyleFeatures", "materialFeatures", "quality", "fabricFeatures", "additionalFeatures"];

            var productCustomizationsArray = [info.colour, info.print_methods, info.print_placements, info.print_area, info.measurements, info.additional_customizations];
            var productCustomizationsConstants = ["Colour", "Print Methods", "Print Placements", "Print Area", "Measurements", "Additional Customizations"];
            var productCustIdArr = ["colourCustomizations", "printMethodCustomizations", "printPlacementCustomizations", "printAreaCustomizations", "measurementsCustomizations", "additionalCustomizations"];

            var productConditionsArray = [info.finishing, info.packaging, info.inclusive, info.exclusive];
            var productConditionsConstants = ["Finishing", "Packaging", "Inclusive", "Exclusive"];
            var productConditionsIdArr = ["finishing", "packaging", "inclusive", "exclusive"];

            // Product Features
            $.each(productFeaturesArray, function(key, value) {

                var prodFeatureType = productFeaturesConstants[key];
                var prodFeatureId = productFeaturesIdArr[key];
                $("#modalProductFeaturesCheckbox").append("<h4> " + prodFeatureType + " </h4><h5 class='text-danger' id='" + prodFeatureId + "ErrorText'></h5>");

                var featuresStr = value;
                var indvFeatures = featuresStr.split("#");
                var featuresArr = new Array();

                for(var m=0; m<indvFeatures.length; m++) {

                    var featureTextStr = indvFeatures[m].split("@");
                    if(featureTextStr[0] == 'Enable') {
                        featuresArr[m] = featureTextStr[1];
                    }
                }

                $.each(featuresArr, function(key, value) {

                    var counter = key + 1;
                    var slctFeatures = $("#"+prodFeatureId+""+ prodCounter).val();
                    if(value != null) {
                      var line = "";
                      if(slctFeatures != null) {
                        var arr = slctFeatures.split(",");
                        if($.inArray(value, arr) != -1 || value == "N/A") {
                            line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodFeatureType + "' value='" + value + "' checked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                        }
                        else {
                            line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodFeatureType + "' value='" + value + "' unchecked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                        }
                      }
                      else {
                          line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodFeatureType + "' value='" + value + "' unchecked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                      }
                      $("#modalProductFeaturesCheckbox").append(""
                      + line
                      + "");
                    }
                });
            });

            // Product Customizations
            $.each(productCustomizationsArray, function(key, value) {

                var prodCustType = productCustomizationsConstants[key];
                var prodCustId = productCustIdArr[key];
                $("#modalProductCustomizationsCheckbox").append("<h4> " + prodCustType + " </h4><h5 class='text-danger' id='" + prodCustId + "ErrorText'></h5>");

                var featuresStr = value;
                var indvFeatures = featuresStr.split("#");
                var featuresArr = new Array();

                for(var m=0; m<indvFeatures.length; m++) {

                    var featureTextStr = indvFeatures[m].split("@");
                    if(featureTextStr[0] == 'Enable') {
                        featuresArr[m] = featureTextStr[1];
                    }
                }

                $.each(featuresArr, function(key, value) {

                    var counter = key + 1;
                    var slctFeatures = $("#"+prodCustId+""+ prodCounter).val();
                    if(value != null) {
                      var line = "";
                      if(slctFeatures != null) {
                        var arr = slctFeatures.split(",");
                        if($.inArray(value, arr) != -1 || value == "N/A") {
                            line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodCustType + "' value='" + value + "' checked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                        }
                        else {
                            line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodCustType + "' value='" + value + "' unchecked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                        }
                      }
                      else {
                          line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodCustType + "' value='" + value + "' unchecked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                      }
                      $("#modalProductCustomizationsCheckbox").append(""
                      + line
                      + "");
                    }
                });
            });

            // Product Conditions
            $.each(productConditionsArray, function(key, value) {

                var prodConditionType = productConditionsConstants[key];
                var prodCondId = productConditionsIdArr[key];
                $("#modalProductConditionsCheckbox").append("<h4> " + prodConditionType + " </h4><h5 class='text-danger' id='" + prodCondId + "ErrorText'></h5>");

                var featuresStr = value;
                var indvFeatures = featuresStr.split("#");
                var featuresArr = new Array();

                for(var m=0; m<indvFeatures.length; m++) {

                    var featureTextStr = indvFeatures[m].split("@");
                    if(featureTextStr[0] == 'Enable') {
                        featuresArr[m] = featureTextStr[1];
                    }
                }

                $.each(featuresArr, function(key, value) {

                    var counter = key + 1;
                    var slctFeatures = $("#"+prodCondId+""+ prodCounter).val();
                    if(value != null) {
                      var line = "";
                      if(slctFeatures != null) {
                        var arr = slctFeatures.split(",");
                        if($.inArray(value, arr) != -1 || value == "N/A") {
                            line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodConditionType + "' value='" + value + "' checked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                        }
                        else {
                            line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodConditionType + "' value='" + value + "' unchecked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                        }
                      }
                      else {
                          line = "<input type='checkbox' class='form-check-input' name='merakiProdFeature' featureType='" + prodConditionType + "' value='" + value + "' unchecked><span style='padding-right:12px;font-weight:600;'>" + value + "</span>"
                      }
                      $("#modalProductConditionsCheckbox").append(""
                      + line
                      + "");
                    }
                });
            });
          }
        });

        $("#btnSave").unbind().click(function(event) {

            event.preventDefault();
            var prodStyleStr = "", materialStr = "", qualityStr = "", fabricStr = "", additionalFeaturesStr = "",
            colourStr = "", printMethStr = "", printPlacementStr = "", printAreaStr = "", measurementStr = "", additionalCustomizationsStr = "",
            finishingStr = "", packagingStr = "", incStr = "", excStr = "";

            $("input[name='merakiProdFeature']:checked").each(function() {

                if($(this).attr('featureType') == 'Product Style') {
                    prodStyleStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Material') {
                    materialStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Quality') {
                    qualityStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Fabric') {
                    fabricStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Additional Features') {
                    additionalFeaturesStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Colour') {
                    colourStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Print Methods') {
                    printMethStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Print Placements') {
                    printPlacementStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Print Area') {
                    printAreaStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Measurements') {
                    measurementStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Additional Customizations') {
                    additionalCustomizationsStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Finishing') {
                    finishingStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Packaging') {
                    packagingStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Inclusive') {
                    incStr += $(this).val() + ",";
                }
                else if($(this).attr('featureType') == 'Exclusive') {
                    excStr += $(this).val() + ",";
                }
            });

            var allFieldsSelected = "true";

            if(prodStyleStr == "") {
                allFieldsSelected = "false";
                $("#productStyleFeaturesErrorText").html("Please Select Any One Of The Following!");
            }
            if(materialStr == "") {
                allFieldsSelected = "false";
                $("#materialFeaturesErrorText").html("Please Select Any One Of The Following!");
            }
            if(qualityStr == "") {
                allFieldsSelected = "false";
                $("#qualityErrorText").html("Please Select Any One Of The Following!");
            }
            if(fabricStr == "") {
                allFieldsSelected = "false";
                $("#fabricFeaturesErrorText").html("Please Select Any One Of The Following!");
            }
            if(additionalFeaturesStr == "") {
                allFieldsSelected = "false";
                $("#additionalFeaturesErrorText").html("Please Select Any One Of The Following!");
            }

            $("#productStyleFeatures" + prodCounter).val(prodStyleStr);
            $("#materialFeatures" + prodCounter).val(materialStr);
            $("#quality" + prodCounter).val(qualityStr);
            $("#fabricFeatures" + prodCounter).val(fabricStr);
            $("#additionalFeatures" + prodCounter).val(additionalFeaturesStr);

            if(colourStr == "") {
                allFieldsSelected = "false";
                $("#colourCustomizationsErrorText").html("Please Select Any One Of The Following!");
            }
            if(printMethStr == "") {
                allFieldsSelected = "false";
                $("#printMethodCustomizationsErrorText").html("Please Select Any One Of The Following!");
            }
            if(printPlacementStr == "") {
                allFieldsSelected = "false";
                $("#printPlacementCustomizationsErrorText").html("Please Select Any One Of The Following!");
            }
            if(printAreaStr == "") {
                allFieldsSelected = "false";
                $("#printAreaCustomizationsErrorText").html("Please Select Any One Of The Following!");
            }
            if(measurementStr == "") {
                allFieldsSelected = "false";
                $("#measurementsCustomizationsErrorText").html("Please Select Any One Of The Following!");
            }
            if(additionalCustomizationsStr == "") {
                allFieldsSelected = "false";
                $("#additionalCustomizationsErrorText").html("Please Select Any One Of The Following!");
            }

            $("#colourCustomizations" + prodCounter).val(colourStr);
            $("#printMethodCustomizations" + prodCounter).val(printMethStr);
            $("#printPlacementCustomizations" + prodCounter).val(printPlacementStr);
            $("#printAreaCustomizations" + prodCounter).val(printAreaStr);
            $("#measurementsCustomizations" + prodCounter).val(measurementStr);
            $("#additionalCustomizations" + prodCounter).val(additionalCustomizationsStr);

            if(finishingStr == "") {
                allFieldsSelected = "false";
                $("#finishingErrorText").html("Please Select Any One Of The Following!");
            }
            if(packagingStr == "") {
                allFieldsSelected = "false";
                $("#packagingErrorText").html("Please Select Any One Of The Following!");
            }
            if(incStr == "") {
                allFieldsSelected = "false";
                $("#inclusiveErrorText").html("Please Select Any One Of The Following!");
            }
            if(excStr == "") {
                allFieldsSelected = "false";
                $("#exclusiveErrorText").html("Please Select Any One Of The Following!");
            }

            $("#finishing" + prodCounter).val(finishingStr);
            $("#packaging" + prodCounter).val(packagingStr);
            $("#inclusive" + prodCounter).val(incStr);
            $("#exclusive" + prodCounter).val(excStr);

            if(allFieldsSelected == "true") {
                $("#prodFeaturesModal").modal('hide');
            }
            else {
                $("#merakiProductsModalErrorText").html("Please Select All The Mandatory Features/Customizations/Conditions !");
                $("#merakiProductsModalErrorText").show();
            }
        });
      });
    });

  </script>

@endsection
