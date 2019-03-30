@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Quotation | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Quotation Form </h3>
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

               <form method="POST" action="{{ URL::to('/') }}/enquiry/saveQuotation/{{ $enquiry->id }}" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="concernedLeadPerson" id="concernedLeadPerson" value="{{ Auth::user()->name }}">
                 <input type="hidden" name="enquiryCreDttm" id="enquiryCreDttm" value="{{ Carbon\Carbon::now()->toDateString() }}">

                 <div class="row">
                   <div class="col-md-6">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Event Details </h4>
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

                           <tr class="{{ $errors->has('designation') ? 'has-error' : '' }}">
                               <td style="width:30%">Designation</td>
                               <td>
                                 <input class="form-control" placeholder="Enter Designation" type="text" id="designation"
                                 name="designation" size="27" style="width:100%!important" value="{{ $enquiry->designation }}" required>
                                 <span class="text-danger">{{ $errors->first('designation') }}</span>
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
                            <th class="text-center">Description</th>
                            <th class="text-center">Cost Per Unit</th>
                            <th class="text-center">GST Tax</th>
                            <th class="text-center">Front Panel</th>
                            <th class="text-center">Back Panel</th>
                            <th class="text-center">Features/Specifications</th>
                            <th class="text-center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                          @foreach ($enquiryRequirements as $enquiryReq)
                            <tr id='addr<?php echo $i; ?>'>
                              <td>
                                <select class="form-control" style="width: 100%;" id="productCd<?php echo $i; ?>" name="productCd[]">
                                 @foreach($productsDtls as $productCd) {
                                    <option>{{ $productCd->product_code }}</option>
                                 }
                                 @endforeach
                                </select>
                              </td>
                              <td><input class="form-control" type="text" placeholder="Product" name="product[]" value="{{ $enquiryReq->product }}" required></td>
                              <td style="display: none;"><input class="form-control" type="number" placeholder="Quantity" name="quantity[]" value="{{ $enquiryReq->quantity }}" required></td>
                              <td style="display: none;"><input class="form-control" type="text" placeholder="Colour" name="color[]" value="{{ $enquiryReq->colour }}" required></td>
                              <td style="width: 100px;"><input class="form-control" type="number" min="0" id="cpu{{ $i }}" name="costPerUnit[]" value="0" required></td>
                              <td style="width: 100px;"><input class="form-control" type="number" min="0" id="gst{{ $i }}" name="gstTax[]" value="0" required></td>
                              <td style="width: 100px;"><input class="form-control" type="text" id="frontPanel{{ $i }}" name="frontPanel[]" value="N/A" required></td>
                              <td style="width: 100px;"><input class="form-control" type="text" id="backPanel{{ $i }}" name="backPanel[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="finishing{{ $i }}" name="finishing[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="fitting_sizes{{ $i }}" name="fitting_sizes[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="packaging{{ $i }}" name="packaging[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="inclusive{{ $i }}" name="inclusive[]" value="N/A" required></td>
                              <td style="width: 100px;display:none;"><input class="form-control" type="text" id="exclusive{{ $i }}" name="exclusive[]" value="N/A" required></td>
                              <td><input class="form-control" type="text" id="prodFeaturesSpec<?php echo $i; ?>" placeholder="Features" name="features[]" required></td>
                              <td>
                                <a href="#prodFeaturesModal" data-counter='<?php echo $i; ?>' data-id='productCd<?php echo $i; ?>'
                                  id="selectCustomProdFeatures" class="btn btn-primary ml-2" data-toggle="modal">Select Features</a>
                              </td>
                            </tr>
                            <?php $i++; ?>
                          @endforeach
                        </tbody>
                      </table>
                  </table>

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
                          <b>Please Select The Features Applicable Below For The Product</b>
                          <br><br>
                          <div class="form-check">
                              <?php $k = 1; ?>
                              @for($k=1; $k<=5; $k++)
                                <input type="checkbox" class="form-check-input" id='feature<?php echo $k; ?>' unchecked>
                                <label class="form-check-label" for='feature<?php echo $k; ?>'><span id='feature<?php echo $k; ?>Descr'></span></label>
                                <br>
                              @endfor
                              <br>
                              <b>Front Panel Design</b> <br><br>
                              <input class="form-control" placeholder="Front Panel Design" type="text" id="frontPanelDesign"
                              name="frontPanelDesign" size="27" style="width:100%!important" required>
                              <br>
                              <b>Back Panel Design</b> <br><br>
                              <input class="form-control" placeholder="Back Panel Design" type="text" id="backPanelDesign"
                              name="backPanelDesign" size="27" style="width:100%!important" required>
                            </div>
                            <br><br>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="btnSave">Save Changes</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <button class="btn btn-primary" id="quoteBreakUp">View Breakup</button>

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Cost Per Unit</th>
                        <th class="text-center">GST Tax</th>
                        <th class="text-center">Amount Per Unit</th>
                        <th class="text-center">Total Amount</th>
                      </tr>
                    </thead>
                    <h4 class="box-title"> Quotation Breakup </h4>
                    <?php $j = 0; ?>
                    @foreach ($enquiryRequirements as $enquiryReq)
                      <tr>
                        <td>{{ $enquiryReq->product }}</td>
                        <td><p id="quoteQty{{ $j }}">{{ $enquiryReq->quantity }}</p></td>
                        <td><p id="quoteCpu{{ $j }}">0</p></td>
                        <td><p id="quoteGst{{ $j }}">0</p></td>
                        <td><p id="quoteApu{{ $j }}">0</p></td>
                        <td><p id="quoteTotAmt{{ $j }}">0</p></td>
                      </tr>
                      <?php $j++; ?>
                    @endforeach
                    <tr></tr><tr></tr>
                    <tr><td></td><td></td><td></td><td></td><td><b>Final Amount</b></td><td><b><p id="finalQuotationAmountGen">0</p></b></td></tr>
                   </table>

                   <button class="btn btn-primary" type="submit">Generate Quotation</button>
              </form>
              <br/>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


@endsection

@section('customJs')

  <script type="text/javascript">

      $(document).ready(function() {

          var i = $('#tab_logic tr').length - 1;

          $('#reqCount').val(i);

          $("#quoteBreakUp").click(function(event) {

              event.preventDefault();
              var $totalProdCnt = $('#tab_logic tr').length - 1;
              var $finalQuotePrice = 0;

              for(var $k=0; $k<$totalProdCnt; $k++) {

                  var $costPerUnitIter = $('#cpu' + $k).val();
                  var $gstIter = $('#gst' + $k).val();
                  var $qtyIter = $('#quoteQty' + $k).text();
                  $("#quoteCpu" + $k).text($costPerUnitIter);
                  $("#quoteGst" + $k).text($gstIter);
                  var $finalAmtPerUnit = parseInt($costPerUnitIter) + parseInt($gstIter);
                  $("#quoteApu" + $k).text($finalAmtPerUnit);
                  var $totalAmountIter = parseInt($qtyIter) * $finalAmtPerUnit;
                  $finalQuotePrice += $totalAmountIter;
                  $("#quoteTotAmt" + $k).text($totalAmountIter);
              }
              $("#finalQuotationAmountGen").text($finalQuotePrice);
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
              url: '/productDetails/' + productCd,
              success: function(info) {

                $("#feature1Descr").text(info.feature_1);
                $("#feature2Descr").text(info.feature_2);
                $("#feature3Descr").text(info.feature_3);
                $("#feature4Descr").text(info.feature_4);
                $("#feature5Descr").text(info.feature_5);
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
                $("#prodFeaturesSpec" + prodCounter).val(selectedFeatures);
                $("#frontPanel" + prodCounter).val(frontPanelDesignStr);
                $("#backPanel" + prodCounter).val(backPanelDesignStr);
                $("#prodFeaturesModal").modal('hide');

            });

          });
      });
  </script>

@endsection
