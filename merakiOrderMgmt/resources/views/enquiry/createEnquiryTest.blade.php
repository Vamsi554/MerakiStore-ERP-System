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

               <form method="POST" class="form-group" action="{{ URL::to('/') }}/enquiry/addEnquiry" autocomplete="off">

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
                                 <input class="form-control" placeholder="How you came to know about Meraki" type="text" id="leadSource"
                                 name="leadSource" size="27" style="width:100%!important" value="{{ old('leadSource') }}" required>
                                 <span class="text-danger">{{ $errors->first('leadSource') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('eventName') ? 'has-error' : '' }}">
                               <td style="width:30%">Event Name</td>
                               <td>
                                 <input class="form-control" placeholder="Name of the Event" type="text" id="eventName"
                                 name="eventName" size="27" style="width:100%!important" value="{{ old('eventName') }}" required>
                                 <span class="text-danger">{{ $errors->first('eventName') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('eventPlace') ? 'has-error' : '' }}">
                               <td style="width:30%">Event Place</td>
                               <td>
                                 <input class="form-control" placeholder="Place at which Event Happens" type="text" id="eventPlace"
                                 name="eventPlace" size="27" style="width:100%!important" value="{{ old('eventPlace') }}" required>
                                 <span class="text-danger">{{ $errors->first('eventPlace') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('organizationName') ? 'has-error' : '' }}">
                               <td style="width:30%">Organization Name</td>
                               <td>
                                 <input class="form-control" placeholder="Name of the Organization" type="text" id="organizationName"
                                 name="organizationName" size="27" style="width:100%!important" value="{{ old('organizationName') }}" required>
                                 <span class="text-danger">{{ $errors->first('organizationName') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('eventDate') ? 'has-error' : '' }}">
                               <td style="width:30%">Event Date</td>
                               <td>
                                   <input class="form-control pull-right" placeholder="Enter Event Date" type="date" id="eventDate"
                                   name="eventDate" size="27" style="width:100%!important" value="{{ old('eventDate') }}" required>
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
                                 name="name" size="27" style="width:100%!important" value="{{ old('name') }}" required>
                                 <span class="text-danger">{{ $errors->first('name') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('phone') ? 'has-error' : '' }}">
                               <td style="width:30%">Phone</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Phone" type="number" id="phone"
                                 name="phone" size="27" style="width:100%!important" value="{{ old('phone') }}" required>
                                 <span class="text-danger">{{ $errors->first('phone') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('alternatePhone') ? 'has-error' : '' }}">
                               <td style="width:30%">Alternate Phone </td>
                               <td>
                                 <input class="form-control" placeholder="Enter Alternate Phone" type="text" id="alternatePhone"
                                 name="alternatePhone" size="27" style="width:100%!important" value="N/A">
                                 <span class="text-danger">{{ $errors->first('alternatePhone') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('designation') ? 'has-error' : '' }}">
                               <td style="width:30%">Designation</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Designation" type="text" id="designation"
                                 name="designation" size="27" style="width:100%!important" value="{{ old('designation') }}" required>
                                 <span class="text-danger">{{ $errors->first('designation') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('email') ? 'has-error' : '' }}">
                               <td style="width:30%">Email Address</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Email Address" type="email" id="email"
                                 name="email" size="27" style="width:100%!important" value="{{ old('email') }}" required>
                                 <span class="text-danger">{{ $errors->first('email') }}</span>
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
                              <th class="text-center">Product Category</th>
                              <th class="text-center">Quantity</th>
                              <th class="text-center">Quality</th>
                              <th class="text-center">Colour</th>
                              <th class="text-center">Customization Details</th>
                              <th class="text-center">Features</th>
                              <th class="text-center">Requirement Confirmation</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr id="addr0">
                              <td style="width: 15%;">
                                <select class="form-control" id="productCd0" name="productCd[]" required>
                                 @foreach($productsDtls as $productCd) {
                                    <option>{{ $productCd->product_category }}</option>
                                 }
                                 @endforeach
                                </select>
                              </td>
                              <td><input class="form-control" type="number" placeholder="Quantity" name="quantity[]" required></td>
                              <td><input class="form-control" type="text" placeholder="Quality" name="quality[]" required></td>
                              <td><input class="form-control" type="text" placeholder="Colour" name="colour[]" required></td>
                              <td style="width: 20%;"><input class="form-control" type="text" placeholder="Customization Details" id="cmDtls0" name="cmDtls[]" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="productDescr0" name="productDescr[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="frontPanel0" name="frontPanel[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="backPanel0" name="backPanel[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="finishing0" name="finishing[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="fitting_sizes0" name="fitting_sizes[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="packaging0" name="packaging[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="inclusive0" name="inclusive[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="exclusive0" name="exclusive[]" value="N/A" required></td>
                              <td>
                                <a href="#prodFeaturesModal" data-counter='0' data-id='productCd0'
                                  id="selectCustomProdFeatures" class="btn btn-primary ml-2" data-toggle="modal">Select Features</a>
                              </td>
                              <td style="width: 15%;">
                                <select class="form-control" name="status[]"
                                value="{{ old('status') }}" required>
                                 <option selected="selected">Approved</option>
                                 <option>Hold</option>
                                 <option>Cancel</option>
                                </select>
                              </td>
                            </tr>
                            <tr id="addr1">
                            </tr>
                          </tbody>
                        </table>
                        <p id="addRow" class="btn btn-primary" style="float:left;">Add Row</p>
                        <p id="deleteRow" class="btn btn-danger" style="float:right;">Delete Row</p>
                    </table>
                    <br><br>


                    <div class="modal fade" id="prodFeaturesModal" role="dialog" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Product Features / Specifications</h4>
                          </div>

                          <div class="modal-body">
                            <b>Product Category : </b><span id="modelProdCode"></span>
                            <br><br>
                            <b>Product Description</b> <br><br>
                            <input class="form-control" placeholder="Product Description" type="text" id="productDescrStr"
                            name="productDescrStr" size="27" style="width:100%!important" required>
                            <br>

                            <b>Please Select The Features Applicable Below For The Product</b>
                            <br><br>
                            <div>
                                <div id="modalProductFeaturesCheckbox"></div>
                                <br>
                                <b>Front Panel Design</b> <br><br>
                                <input class="form-control" placeholder="Front Panel Design" type="text" id="frontPanelDesign"
                                name="frontPanelDesign" size="27" style="width:100%!important" value="N/A" required>
                                <br>
                                <b>Back Panel Design</b> <br><br>
                                <input class="form-control" placeholder="Back Panel Design" type="text" id="backPanelDesign"
                                name="backPanelDesign" size="27" style="width:100%!important" value="N/A" required>
                              </div>
                              <br><br>
                          </div>

                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btnSave">Save Changes</button>
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
                                    name="enquiryStatus" value="{{ old('enquiryStatus') }}">
                                     <option selected="selected">IN PROGRESS</option>
                                     <option>REQUEST FOR QUOTATION</option>
                                     <option>ON HOLD</option>
                                     <option>CANCEL</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('enquiryStatus') }}</span>
                                  </td>
                              </tr>

                              <tr class="{{ $errors->has('enquiryComments') ? 'has-error' : '' }}">
                                  <td style="width:30%">Comments</td>
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
                                    name="sampleDetailsSent" value="{{ old('sampleDetailsSent') }}">
                                     <option selected="selected">No</option>
                                     <option>Yes</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('sampleDetailsSent') }}</span>
                                  </td>
                              </tr>

                              <tr class="{{ $errors->has('sampleDetailsComments') ? 'has-error' : '' }}">
                                  <td style="width:30%">Comments</td>
                                  <td>
                                    <input class="form-control" placeholder="Enter Sample Details Comments" type="text" id="sampleDetailsComments"
                                    name="sampleDetailsComments" size="27" style="width:100%!important" value="{{ old('sampleDetailsComments') }}">
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
                                     name="sampleReceivedByCustomer" value="{{ old('sampleReceivedByCustomer') }}">
                                      <option selected="selected">No</option>
                                      <option>Yes</option>
                                     </select>
                                     <span class="text-danger">{{ $errors->first('sampleReceivedByCustomer') }}</span>
                                   </td>
                               </tr>

                               <tr class="{{ $errors->has('samplesCustomerFeedback') ? 'has-error' : '' }}">
                                   <td style="width:30%">Customer Feedback</td>
                                   <td>
                                     <input class="form-control" placeholder="Samples Customer Feedback" type="text" id="samplesCustomerFeedback"
                                     name="samplesCustomerFeedback" size="27" style="width:100%!important" value="{{ old('samplesCustomerFeedback') }}">
                                     <span class="text-danger">{{ $errors->first('samplesCustomerFeedback') }}</span>
                                   </td>
                               </tr>
                          </table>
                      </div>
                    </div>

                      <table class="table table-bordered table-striped">
                        <h4 class="box-title"> Additional Information </h4>
                        <tr class="{{ $errors->has('additionalInformation') ? 'has-error' : '' }}">
                            <td style="width:30%">Additional Comments</td>
                            <td>
                              <input class="form-control" placeholder="Enter Additional Comments" type="text" id="additionalInformation"
                              name="additionalInformation" size="27" style="width:100%!important" value="{{ old('additionalInformation') }}" required>
                              <span class="text-danger">{{ $errors->first('additionalInformation') }}</span>
                            </td>
                        </tr>
                      </table>

                  <button class="btn btn-primary" type="submit">Create Enquiry</button>
              </form>
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

          var i = $('#tab_logic tr').length - 2;

          $('#reqCount').val(i);

          $('#addRow').click(function() {

              $('#addr' + i).html(""
              + "<td style='width: 15%;'><select class='form-control' id='productCd"+i+"' name='productCd[]' required> @foreach($productsDtls as $productCd) { <option>{{ $productCd->product_category }}</option> } @endforeach </select></td>"
              + "<td><input class='form-control' type='number' placeholder='Quantity' name='quantity[]' required></td>"
              + "<td><input class='form-control' type='text' placeholder='Quality' name='quality[]' required></td>"
              + "<td><input class='form-control' type='text' placeholder='Colour' name='colour[]' required></td>"
              + "<td style='width: 20%;'><input class='form-control' type='text' placeholder='Customization Details' id='cmDtls"+i+"' name='cmDtls[]'' required></td>"
              + "<td style='width: 100px;display:none;'><input class='form-control' type='text' id='productDescr"+i+"' name='productDescr[]' value='N/A' required></td>"
              + "<td style='width: 100px;display:none;'><input class='form-control' type='text' id='frontPanel"+i+"' name='frontPanel[]' value='N/A' required></td>"
              + "<td style='width: 100px;display:none;'><input class='form-control' type='text' id='backPanel"+i+"' name='backPanel[]' value='N/A' required></td>"
              + "<td style='width: 100px;display:none;'><input class='form-control' type='text' id='finishing"+i+"' name='finishing[]' value='N/A' required></td>"
              + "<td style='width: 100px;display:none;'><input class='form-control' type='text' id='fitting_sizes"+i+"' name='fitting_sizes[]' value='N/A' required></td>"
              + "<td style='width: 100px;display:none;'><input class='form-control' type='text' id='packaging"+i+"' name='packaging[]' value='N/A' required></td>"
              + "<td style='width: 100px;display:none;'><input class='form-control' type='text' id='inclusive"+i+"' name='inclusive[]' value='N/A' required></td>"
              + "<td style='width: 100px;display:none;'><input class='form-control' type='text' id='exclusive"+i+"' name='exclusive[]' value='N/A' required></td>"
              + "<td><a href='#prodFeaturesModal' data-counter='"+i+"' data-id='productCd"+i+"' id='selectCustomProdFeatures' class='btn btn-primary ml-2' data-toggle='modal'>Select Features</a></td>"
              + "<td style='width: 15%;'><select class='form-control' style='width: 100%;' name='status[]' value='{{ old('status') }}'>"
              + "<option selected='selected'>Approved</option><option>Hold</option><option>Cancel</option></select></td>");

              i++;

              $('#tab_logic').append('<tr id="addr'+(i)+'"></tr>');

              $('#reqCount').val(i);

          });

          $('#deleteRow').click(function() {

              if(i>1){
                $("#addr"+(i-1)).html('');
                $('#reqCount').val(i-1);
                i--;
              }
          });

          $(document).on("click", "#selectCustomProdFeatures", function() {

            $('input[type=checkbox]').each(function()
            {
                this.checked = false;
            });
            $("#frontPanelDesign").val("");
            $("#backPanelDesign").val("");

            var productId = $(this).data("id");
            var prodCounter = $(this).data("counter");
            var productCd = $("#" + productId).val();
            $("#modelProdCode").text(productCd);

            $.ajax({
              data: {
                productCode : productCd,
                token: $("#token").val()
              },
              url: '{{ URL::to('/') }}/productDetails/' + productCd,
              success: function(info) {

                $("#modalProductFeaturesCheckbox").html("");

                var productAvailableFeatures = info.available_features;
                var indvFeatures = productAvailableFeatures.split("#");
                var prodFeaturesArray = new Array();

                for(var m=0; m<indvFeatures.length; m++) {

                    var featureTextStr = indvFeatures[m].split("@");
                    if(featureTextStr[0] == 'Enable') {

                        prodFeaturesArray[m] = featureTextStr[1];
                    }
                }

                $.each(prodFeaturesArray, function(key, value) {

                    var counter = key + 1;
                    if(value != null) {
                      $("#modalProductFeaturesCheckbox").append(""
                      + "<input type='checkbox' class='form-check-input' id='feature"+counter+"' unchecked>"
                      + "<label class='form-check-label' for='feature"+counter+"'><span id='feature"+counter+"Descr'>" + value + "</span></label><br>");
                    }
                });

                $("#productDescrStr").val(info.product_description);
                $("#productDescr"+prodCounter).val(info.product_description);
                $("#finishing"+prodCounter).val(info.finishing);
                $("#fitting_sizes"+prodCounter).val(info.fitting_sizes);
                $("#packaging"+prodCounter).val(info.packaging);
                $("#inclusive"+prodCounter).val(info.inclusive);
                $("#exclusive"+prodCounter).val(info.exclusive);
              }
            });


            $("#btnSave").unbind().click(function(event) {

                event.preventDefault();
                var selectedFeatures = "";
                $('input.form-check-input:checkbox:checked').each(function() {
                   selectedFeatures = selectedFeatures + $(this).next('label').text() + " # ";
                });
                var frontPanelDesignStr = $("#frontPanelDesign").val();
                var backPanelDesignStr = $("#backPanelDesign").val();
                $("#cmDtls" + prodCounter).val(selectedFeatures);
                $("#frontPanel" + prodCounter).val(frontPanelDesignStr);
                $("#backPanel" + prodCounter).val(backPanelDesignStr);
                $("#prodFeaturesModal").modal('hide');

            });
          });
      });
  </script>

@endsection
