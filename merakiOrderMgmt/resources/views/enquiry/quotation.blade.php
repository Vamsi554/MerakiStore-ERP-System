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
                 </div>

                 @if(count($enquiryQuoteLinkage) > 0)
                   <table class="table table-bordered table-striped">
                     <h4 class="box-title"> Previous Quotations </h4>
                        @foreach ($enquiryQuoteLinkage as $quote)
                          <tr>
                              <td style="width:50%">Quotation Generated Date : {{ $quote->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}</td>
                              <td>
                                <a href="{{ URL::to('/') }}/enquiry/quotation/{{ $enquiry->id }}/{{ $quote->quotation_code }}" class="btn btn-success" target="_blank">View Quotation</a>
                              </td>
                          </tr>
                        @endforeach
                    </table>
                 @endif

                  <table class="table table-bordered table-striped">
                    <h4 class="box-title"> Requirement Details </h4>
                      <input type="hidden" id="reqCount" name="reqCount">
                      <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                          <tr>
                            <th class="text-center">Product Details</th>
                            <th class="text-center">Customization Details</th>
                            <th class="text-center">HSN</th>
                            <th class="text-center">Cost Per Unit</th>
                            <th class="text-center">GST Tax (%) </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                          @for($i=0; $i<count($enquiryRequirements); $i++)
                            <tr id='addr<?php echo $i; ?>'>
                              <td style="width:25%;">
                                <b>Category</b> : {{ $enquiryRequirements[$i]->product_category }} <br><br>
                                <b>Description</b> : {{ $enquiryRequirements[$i]->product_description }} <br><br>
                                <input type="hidden" id='prodCat<?php echo $i; ?>' name='prodCat[]' value="{{ $enquiryRequirements[$i]->product_category }}">
                                <input type="hidden" id='prodDescr<?php echo $i; ?>' name='prodDescr[]' value="{{ $enquiryRequirements[$i]->product_description }}">
                                <input type="hidden" id='quantity<?php echo $i; ?>' name='quantity[]' value="{{ $enquiryRequirements[$i]->quantity }}">
                              </td>
                              <td>
                                <b>Product Features</b>
                                @php
                                  $enquiryReq = $enquiryRequirements[$i];
                                @endphp
                                <ul>
                                  <li>Product Style : @if($enquiryReq->product_style == '0' || $enquiryReq->product_style == null) @else {{ $enquiryReq->product_style }} @endif</li>
                                  <li>Material : @if($enquiryReq->material == '0' || $enquiryReq->material == null) @else {{ $enquiryReq->material }} @endif</li>
                                  <li>Quantity : @if($enquiryReq->quantity == '0' || $enquiryReq->quantity == null) @else {{ $enquiryReq->quantity }} @endif</li>
                                  <li>Quality : @if($enquiryReq->quality == '0' || $enquiryReq->quality == null) @else {{ $enquiryReq->quality }} @endif</li>
                                  <li>Fabric: @if($enquiryReq->fabric == '0' || $enquiryReq->fabric == null) @else {{ $enquiryReq->fabric }} @endif</li>
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
                              <td style="width: 100px;"><input class="form-control" type="text" id="hsn{{ $i }}" name="hsnCode[]" value="{{ $hsnCodeArr[$i] }}" required></td>
                              <td style="width: 100px;"><input class="form-control" type="number" min="0" step="any" id="cpu{{ $i }}" name="costPerUnit[]" value="0" required></td>
                              <td style="width: 100px;"><input class="form-control" type="number" min="0" step="any" id="gst{{ $i }}" name="gstTax[]" value="{{ $gstTaxArr[$i] }}" required></td>
                            </tr>
                          @endfor
                        </tbody>
                      </table>
                  </table>

                  <button class="btn btn-primary" id="quoteBreakUp">View Breakup</button>

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Rate Per Unit</th>
                        <th class="text-center">Taxable Amount</th>
                        <th class="text-center">IGST</th>
                        <th class="text-center">CGST</th>
                        <th class="text-center">SGST</th>
                        <th class="text-center">Total Amount</th>
                      </tr>
                    </thead>
                    <h4 class="box-title"> Quotation Breakup </h4>
                    <?php $j = 0; ?>
                    @foreach ($enquiryRequirements as $enquiryReq)
                      <tr>
                        <td>{{ $enquiryReq->product_description }}</td>
                        <td><p id="quoteQty{{ $j }}">{{ $enquiryReq->quantity }}</p></td>
                        <td><p id="quoteCpu{{ $j }}">0</p></td>
                        <td><p id="quoteTaxAmt{{ $j }}">0</p></td>
                        <td><p id="quoteIGst{{ $j }}">0</p></td>
                        <td><p id="quoteCGst{{ $j }}">0</p></td>
                        <td><p id="quoteSGst{{ $j }}">0</p></td>
                        <td><p id="quoteTotAmt{{ $j }}">0</p></td>
                      </tr>
                      <?php $j++; ?>
                    @endforeach
                    <tr></tr><tr></tr>
                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><b>Final Amount</b></td><td><b><p id="finalQuotationAmountGen">0</p></b></td></tr>
                   </table>

                   <table class="table table-bordered table-striped">
                     <h4 class="box-title"> Terms & Conditions </h4>
                         <tr class="{{ $errors->has('advPayPer') ? 'has-error' : '' }}">
                             <td style="width:30%">Advance Payment (%) </td>
                             <td>
                               <input class="form-control" type="number" id="advPayPer"
                               name="advPayPer" size="27" style="width:100%!important" required>
                               <span class="text-danger">{{ $errors->first('advPayPer') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('minProdDays') ? 'has-error' : '' }}">
                             <td style="width:30%">Minimum Production Days Required</td>
                             <td>
                               <input class="form-control" type="number" id="minProdDays"
                               name="minProdDays" size="27" style="width:100%!important" required>
                               <span class="text-danger">{{ $errors->first('minProdDays') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('gstTaxCd') ? 'has-error' : '' }}">
                             <td style="width:30%">Tax Code</td>
                             <td>
                               <select class="form-control" id="gstTaxCd" name="gstTaxCd"
                               value="{{ old('gstTaxCd') }}" required>
                                 <option>CGST/SGST</option>
                                 <option>IGST</option>
                               </select>
                               <span class="text-danger">{{ $errors->first('gstTaxCd') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('specificTerms1') ? 'has-error' : '' }}">
                             <td style="width:30%">Specific Terms & Conditions - 1</td>
                             <td>
                               <textarea rows="2" cols="50" class="form-control" type="text" id="specificTerms1"
                               name="specificTerms1" size="27" style="width:100%!important"
                               value="{{ old('specificTerms1') }}" required>N/A</textarea>
                               <span class="text-danger">{{ $errors->first('specificTerms1') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('specificTerms2') ? 'has-error' : '' }}">
                             <td style="width:30%">Specific Terms & Conditions - 2</td>
                             <td>
                               <textarea rows="2" cols="50" class="form-control" type="text" id="specificTerms2"
                               name="specificTerms2" size="27" style="width:100%!important"
                               value="{{ old('specificTerms2') }}" required>N/A</textarea>
                               <span class="text-danger">{{ $errors->first('specificTerms2') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('specificTerms3') ? 'has-error' : '' }}">
                             <td style="width:30%">Specific Terms & Conditions - 3</td>
                             <td>
                               <textarea rows="2" cols="50" class="form-control" type="text" id="specificTerms3"
                               name="specificTerms3" size="27" style="width:100%!important"
                               value="{{ old('specificTerms3') }}" required>N/A</textarea>
                               <span class="text-danger">{{ $errors->first('specificTerms3') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('specificTerms4') ? 'has-error' : '' }}">
                             <td style="width:30%">Specific Terms & Conditions - 4</td>
                             <td>
                               <textarea rows="2" cols="50" class="form-control" type="text" id="specificTerms4"
                               name="specificTerms4" size="27" style="width:100%!important"
                               value="{{ old('specificTerms4') }}" required>N/A</textarea>
                               <span class="text-danger">{{ $errors->first('specificTerms4') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('specificTerms5') ? 'has-error' : '' }}">
                             <td style="width:30%">Specific Terms & Conditions - 5</td>
                             <td>
                               <textarea rows="2" cols="50" class="form-control" type="text" id="specificTerms5"
                               name="specificTerms5" size="27" style="width:100%!important"
                               value="{{ old('specificTerms5') }}" required>N/A</textarea>
                               <span class="text-danger">{{ $errors->first('specificTerms5') }}</span>
                             </td>
                         </tr>

                         <tr class="{{ $errors->has('additionalNotes') ? 'has-error' : '' }}">
                             <td style="width:30%">Additional Notes</td>
                             <td>
                               <textarea rows="2" cols="50" class="form-control" type="text" id="additionalNotes"
                               name="additionalNotes" size="27" style="width:100%!important"
                               value="{{ old('additionalNotes') }}" required>N/A</textarea>
                               <span class="text-danger">{{ $errors->first('additionalNotes') }}</span>
                             </td>
                         </tr>

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

                  // Rate Per Unit
                  var $costPerUnitIter = $('#cpu' + $k).val();
                  // Quantity
                  var $qtyIter = $('#quoteQty' + $k).text();
                  // GST Percentage
                  var $gstIter = $('#gst' + $k).val();
                  // Total Amount
                  var $totalTaxableAmount = $qtyIter * $costPerUnitIter;
                  $("#quoteTaxAmt" + $k).text($totalTaxableAmount);
                  $("#quoteCpu" + $k).text($costPerUnitIter);
                  var $indvGstPer = $gstIter/2.0;
                  var $cgst = $totalTaxableAmount*$indvGstPer/100.0;
                  var $sgst = $totalTaxableAmount*$indvGstPer/100.0;
                  var $igst = $totalTaxableAmount*$gstIter/100.0;
                  $("#quoteIGst" + $k).text($igst);
                  $("#quoteCGst" + $k).text($cgst);
                  $("#quoteSGst" + $k).text($sgst);
                  var $totalAmountIter = parseInt($totalTaxableAmount) + parseInt($cgst+$sgst);
                  $finalQuotePrice += $totalAmountIter;
                  $("#quoteTotAmt" + $k).text($totalAmountIter);
              }
              $("#finalQuotationAmountGen").text($finalQuotePrice);
          });
      });
  </script>

@endsection
