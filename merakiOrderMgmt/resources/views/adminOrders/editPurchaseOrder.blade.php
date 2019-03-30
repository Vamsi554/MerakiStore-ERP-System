@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Purchase Order | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Purchase Order Update Form </h3>
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

               <form method="POST" action="{{ URL::to('/') }}/order/admin/purchaseOrder/update/{{ $order->id }}/{{ $order->enquiry_id }}/{{ $order->purchaseOrderNumber }}" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="concernedLeadPerson" id="concernedLeadPerson" value="{{ Auth::user()->name }}">
                 <input type="hidden" name="poCreDttm" id="poCreDttm" value="{{ Carbon\Carbon::now()->toDateString() }}">

                 <div class="row">
                   <div class="col-md-6">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Event Details </h4>
                           <tr class="{{ $errors->has('eventName') ? 'has-error' : '' }}">
                               <td style="width:30%">Event Name</td>
                               <td>
                                 {{ $enquiry->eventName }}
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('eventPlace') ? 'has-error' : '' }}">
                               <td style="width:30%">Event Place</td>
                               <td>
                                 {{ $enquiry->eventPlace }}
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('organizationName') ? 'has-error' : '' }}">
                               <td style="width:30%">Organization Name</td>
                               <td>
                                 {{ $enquiry->organizationName }}
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
                                 {{ $enquiry->name }}
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('phone') ? 'has-error' : '' }}">
                               <td style="width:30%">Phone</td>
                               <td>
                                 {{ $enquiry->phone }}
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('designation') ? 'has-error' : '' }}">
                               <td style="width:30%">Designation</td>
                               <td>
                                 {{ $enquiry->designation }}
                               </td>
                           </tr>
                      </table>
                   </div>

                   <div class="col-md-12">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title">Vendor Details</h4>

                         <tr class="{{ $errors->has('vendorCd') ? 'has-error' : '' }}">
                             <td style="width:30%">Vendor</td>
                             <td>
                               <select class="form-control" id="vendorCd" name="vendorCd" required>
                                <option selected="selected">{{ $vendorPOLinkage[0]->vendor_code }}</option>
                                @foreach($vendorDtls as $vendorCd)

                                   @if($vendorCd->vendor_code != $vendorPOLinkage[0]->vendor_code)
                                      <option>{{ $vendorCd->vendor_code }}</option>

                                   @endif

                                @endforeach
                               </select>
                               <span class="text-danger">{{ $errors->first('vendorCd') }}</span>
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
                            <th class="text-center">Product Description</th>
                            <th class="text-center">Customization Details</th>
                            <th class="text-center">HSN</th>
                            <th class="text-center">Cost Per Unit</th>
                            <th class="text-center">GST Tax (%)</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                          @foreach ($enquiryRequirements as $enquiryReq)
                            <tr id='addr<?php echo $i; ?>'>
                              <td style="width:15%;">
                                {{ $enquiryReq->product_category }}
                                <input type="hidden" id='prodCat<?php echo $i; ?>' name='prodCat[]' value="{{ $enquiryReq->product_category }}">
                              </td>
                              <td style="width:15%;">
                                {{ $enquiryReq->product_description }}
                                <input type="hidden" id='prodDescr<?php echo $i; ?>' name='prodDescr[]' value="{{ $enquiryReq->product_description }}">
                              </td>
                              <td>
                                <b>Product Features</b>
                                <ul>
                                  <li>Product Style : @if($enquiryReq->product_style == '0' || $enquiryReq->product_style == null) N/A @else {{ $enquiryReq->product_style }} @endif</li>
                                  <li>Material : @if($enquiryReq->material == '0' || $enquiryReq->material == null) N/A @else {{ $enquiryReq->material }} @endif</li>
                                  <li>Quantity : @if($enquiryReq->quantity == '0' || $enquiryReq->quantity == null) N/A @else {{ $enquiryReq->quantity }} @endif</li>
                                    <input type="hidden" id='quantity<?php echo $i; ?>' name='quantity[]' value="{{ $enquiryReq->quantity }}">
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
                              <td style="width: 100px;"><input class="form-control" type="text" id="hsn{{ $i }}" name="hsnCode[]" value="{{ $vendorPurchaseOrder[$i]->hsn_code }}" required></td>
                              <td style="width: 100px;"><input class="form-control" type="number" min="0" step="any" id="cpu{{ $i }}" name="costPerUnit[]" value="{{ $vendorPurchaseOrder[$i]->cost_per_unit }}" required></td>
                              <td style="width: 100px;"><input class="form-control" type="number" min="0" id="gst{{ $i }}" name="gstTax[]" value="{{ $vendorPurchaseOrder[$i]->gst_tax }}" required></td>
                            </tr>
                            <?php $i++; ?>
                          @endforeach
                        </tbody>
                      </table>
                  </table>

                  <button class="btn btn-primary" id="quoteBreakUp">View Breakup</button>

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Cost Per Unit</th>
                        <th>GST Tax</th>
                        <th>Amount Per Unit</th>
                        <th>Total Amount</th>
                      </tr>
                    </thead>
                    <h4 class="box-title"> P.O Breakup </h4>
                    <?php $j = 0; ?>
                    @foreach ($enquiryRequirements as $enquiryReq)
                      <tr>
                        <td>{{ $enquiryReq->product_description }}</td>
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

                   <table class="table table-bordered table-striped">
                     <h4 class="box-title"> Terms & Conditions </h4>
                       <input type="hidden" id="reqCountTc" name="reqCountTc">
                       <table class="table table-bordered table-hover" id="tab_logic_terms">
                         <thead>
                           <tr>
                             <th class="text-center">Confirmation</th>
                             <th class="text-center">T&C Description</th>
                           </tr>
                         </thead>
                         <tbody>
                           @php
                             $v = 0;
                           @endphp
                           @for($v=0; $v<count($statusArr); $v++)
                             <tr id="terms<?php echo $v ?>">
                                 <td style="width: 20%;">
                                 <select class="form-control" name="status[]" required>
                                 <option selected="selected">{{ $statusArr[$v] }}</option>
                                 @if ($statusArr[$v] != 'Enable')
                                   <option>Enable</option>
                                 @endif
                                 @if ($statusArr[$v] != 'Disable')
                                   <option>Disable</option>
                                 @endif
                               </select>
                               </td>
                               <td>
                                 <input class="form-control" type="text" name="termsConditionsText[]" value="{{ $termsTextArr[$v] }}" required>
                               </td>
                             </tr>
                           @endfor
                           <tr id="terms<?php echo $v ?>">
                           </tr>
                         </tbody>
                       </table>

                       <p id="addRow" class="btn btn-primary" style="float:left;">Add Row</p>
                       <p id="deleteRow" class="btn btn-danger" style="float:right;">Delete Row</p>
                       <br><br>
                   </table>


                   <table class="table table-bordered table-striped">
                     <h4 class="box-title"> Special Instructions/Notes </h4>
                     <tr class="{{ $errors->has('notes') ? 'has-error' : '' }}">
                         <td style="width:30%">Notes</td>
                         <td>
                           <input class="form-control" type="text" id="notes"
                           name="notes" size="27" style="width:100%!important" value="{{ $vendorPOLinkage[0]->vendor_notes }}" required>
                           <span class="text-danger">{{ $errors->first('notes') }}</span>
                         </td>
                     </tr>
                   </table>

                   <button class="btn btn-primary" type="submit">Update Purchase Order</button>
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
                  var $gstTaxAmt = ($costPerUnitIter * $gstIter)/100.0;
                  $("#quoteGst" + $k).text($gstTaxAmt);
                  var $finalAmtPerUnit = parseInt($costPerUnitIter) + parseInt($gstTaxAmt);
                  $("#quoteApu" + $k).text($finalAmtPerUnit);
                  var $totalAmountIter = parseInt($qtyIter) * $finalAmtPerUnit;
                  $finalQuotePrice += $totalAmountIter;
                  $("#quoteTotAmt" + $k).text($totalAmountIter);
              }
              $("#finalQuotationAmountGen").text($finalQuotePrice);
          });

          // Terms & Conditions

          var v = $('#tab_logic_terms tr').length - 2;

          $('#reqCountTc').val(v);

          $('#addRow').click(function() {

              $('#terms' + v).html(""
              + "<td style='width: 20%;'><select class='form-control' name='status[]' value='{{ old('status') }}' required><option selected='selected'>Enable</option><option>Disable</option></select></td>"
              + "<td><input class='form-control' type='text' name='termsConditionsText[]' required></td>");

              v++;

              $('#tab_logic_terms').append('<tr id="terms'+(v)+'"></tr>');

              $('#reqCountTc').val(v);

          });

          $('#deleteRow').click(function() {

              if(v>1){
                $("#terms"+(v-1)).html('');
                $('#reqCountTc').val(v-1);
                v--;
              }
          });
      });
  </script>

@endsection
