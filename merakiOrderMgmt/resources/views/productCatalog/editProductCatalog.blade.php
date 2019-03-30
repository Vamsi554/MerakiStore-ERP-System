@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Product Catalog | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Product Catalog Form </h3>
            </div>

            <div class="box-body">
               <form method="POST" class="form-group" action="{{ URL::to('/') }}/productCatalog/updateProduct/{{ $productCatalog->id }}" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="concernedLeadPerson" id="concernedLeadPerson" value="{{ Auth::user()->name }}">

                 <div class="row">
                   <div class="col-md-12">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Product Details </h4>

                           <tr class="{{ $errors->has('productCategory') ? 'has-error' : '' }}">
                               <td style="width:30%">Product Category</td>
                               <td>
                                 <input class="form-control" type="text" id="productCategory"
                                 name="productCategory" size="27" style="width:100%!important" value="{{ $productCatalog->product_category }}" required>
                                 <span class="text-danger">{{ $errors->first('productCategory') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('productCategoryCode') ? 'has-error' : '' }}">
                               <td style="width:30%">Product Category Code</td>
                               <td>
                                 <input class="form-control" type="text" id="productCategoryCode"
                                 name="productCategoryCode" size="27" style="width:100%!important" value="{{ $productCatalog->product_category_code }}" required>
                                 <span class="text-danger">{{ $errors->first('productCategoryCode') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('productDescr') ? 'has-error' : '' }}">
                               <td style="width:30%">Product Description</td>
                               <td>
                                 <input class="form-control" type="text" id="productDescr"
                                 name="productDescr" size="27" style="width:100%!important" value="{{ $productCatalog->product_description }}" required>
                                 <span class="text-danger">{{ $errors->first('productDescr') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('artWork') ? 'has-error' : '' }}">
                               <td style="width:30%">Art Work</td>
                               <td>
                                 <input class="form-control" type="text" id="artWork"
                                 name="artWork" size="27" style="width:100%!important" value="{{ $productCatalog->art_work }}" required>
                                 <span class="text-danger">{{ $errors->first('artWork') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('hsnCode') ? 'has-error' : '' }}">
                               <td style="width:30%">HSN Code</td>
                               <td>
                                 <input class="form-control" type="text" id="hsnCode"
                                 name="hsnCode" size="27" style="width:100%!important" value="{{ $productCatalog->hsn_code }}" required>
                                 <span class="text-danger">{{ $errors->first('hsnCode') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('gstPer') ? 'has-error' : '' }}">
                               <td style="width:30%">GST Tax (%)</td>
                               <td>
                                 <input class="form-control" type="number" step="any" id="gstPer"
                                 name="gstPer" size="27" style="width:100%!important" value="{{ $productCatalog->gst_tax }}" required>
                                 <span class="text-danger">{{ $errors->first('gstPer') }}</span>
                               </td>
                           </tr>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          <h2>Product Features</h2>
                          @php
                              $prodStyleFeaturesArr = explode("#", $productCatalog->product_style);
                              $prodStyleStatusArr = array();
                              $prodStyleFeatureTextArr = array();

                              for($i=0; $i<count($prodStyleFeaturesArr); $i++) {

                                  $features = explode("@", $prodStyleFeaturesArr[$i]);
                                  $prodStyleStatusArr[$i] = $features[0];
                                  $prodStyleFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Product Style</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="prodStyle">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($prodStyleStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="prodStyleStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $prodStyleStatusArr[$v] }}</option>
                                     @if($prodStyleStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($prodStyleStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="prodStyleFeatureText[]" value="{{ $prodStyleFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $materialFeaturesArr = explode("#", $productCatalog->material);
                              $materialStatusArr = array();
                              $materialFeatureTextArr = array();

                              for($i=0; $i<count($materialFeaturesArr); $i++) {

                                  $features = explode("@", $materialFeaturesArr[$i]);
                                  $materialStatusArr[$i] = $features[0];
                                  $materialFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Material</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="material">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($materialStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="materialStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $materialStatusArr[$v] }}</option>
                                     @if($materialStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($materialStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="materialFeatureText[]" value="{{ $materialFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $qualityFeaturesArr = explode("#", $productCatalog->quality);
                              $qualityStatusArr = array();
                              $qualityFeatureTextArr = array();

                              for($i=0; $i<count($qualityFeaturesArr); $i++) {

                                  $features = explode("@", $qualityFeaturesArr[$i]);
                                  $qualityStatusArr[$i] = $features[0];
                                  $qualityFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Quality (GSM)</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="quality">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($qualityStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="qualityStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $qualityStatusArr[$v] }}</option>
                                     @if($qualityStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($qualityStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="qualityFeatureText[]" value="{{ $qualityFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $fabricFeaturesArr = explode("#", $productCatalog->fabric);
                              $fabricStatusArr = array();
                              $fabricFeatureTextArr = array();

                              for($i=0; $i<count($fabricFeaturesArr); $i++) {

                                  $features = explode("@", $fabricFeaturesArr[$i]);
                                  $fabricStatusArr[$i] = $features[0];
                                  $fabricFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Fabric</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="fabric">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($fabricStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="fabricStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $fabricStatusArr[$v] }}</option>
                                     @if($fabricStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($fabricStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="fabricFeatureText[]" value="{{ $fabricFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $addtProdFtFeaturesArr = explode("#", $productCatalog->additional_features);
                              $addtProdFtStatusArr = array();
                              $addtProdFtFeatureTextArr = array();

                              for($i=0; $i<count($addtProdFtFeaturesArr); $i++) {

                                  $features = explode("@", $addtProdFtFeaturesArr[$i]);
                                  $addtProdFtStatusArr[$i] = $features[0];
                                  $addtProdFtFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Additional Features</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="addtProdFt">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($addtProdFtStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="addtProdFtStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $addtProdFtStatusArr[$v] }}</option>
                                     @if($addtProdFtStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($addtProdFtStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="addtProdFtFeatureText[]" value="{{ $addtProdFtFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                        <h2>Product Customizations</h2>
                          @php
                              $colorFeaturesArr = explode("#", $productCatalog->colour);
                              $colorStatusArr = array();
                              $colorFeatureTextArr = array();

                              for($i=0; $i<count($colorFeaturesArr); $i++) {

                                  $features = explode("@", $colorFeaturesArr[$i]);
                                  $colorStatusArr[$i] = $features[0];
                                  $colorFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Colour</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="colour">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($colorStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="colourStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $colorStatusArr[$v] }}</option>
                                     @if($colorStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($colorStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="colourFeatureText[]" value="{{ $colorFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $printMethFeaturesArr = explode("#", $productCatalog->print_methods);
                              $printMethStatusArr = array();
                              $printMethFeatureTextArr = array();

                              for($i=0; $i<count($printMethFeaturesArr); $i++) {

                                  $features = explode("@", $printMethFeaturesArr[$i]);
                                  $printMethStatusArr[$i] = $features[0];
                                  $printMethFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Print Methods</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="printMethod">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($printMethStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="printMethodStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $printMethStatusArr[$v] }}</option>
                                     @if($printMethStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($printMethStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="printMethodFeatureText[]" value="{{ $printMethFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $printPlcFeaturesArr = explode("#", $productCatalog->print_placements);
                              $printPlcStatusArr = array();
                              $printPlcFeatureTextArr = array();

                              for($i=0; $i<count($printPlcFeaturesArr); $i++) {

                                  $features = explode("@", $printPlcFeaturesArr[$i]);
                                  $printPlcStatusArr[$i] = $features[0];
                                  $printPlcFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Print Placements</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="printPlacement">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($printPlcStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="printPlacementStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $printPlcStatusArr[$v] }}</option>
                                     @if($printPlcStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($printPlcStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="printPlacementFeatureText[]" value="{{ $printPlcFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $printAreaFeaturesArr = explode("#", $productCatalog->print_area);
                              $printAreaStatusArr = array();
                              $printAreaFeatureTextArr = array();

                              for($i=0; $i<count($printAreaFeaturesArr); $i++) {

                                  $features = explode("@", $printAreaFeaturesArr[$i]);
                                  $printAreaStatusArr[$i] = $features[0];
                                  $printAreaFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Print Area</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="printArea">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($printAreaStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="printAreaStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $printAreaStatusArr[$v] }}</option>
                                     @if($printAreaStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($printAreaStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="printAreaFeatureText[]" value="{{ $printAreaFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $msmrtFeaturesArr = explode("#", $productCatalog->measurements);
                              $msmrtStatusArr = array();
                              $msmrtFeatureTextArr = array();

                              for($i=0; $i<count($msmrtFeaturesArr); $i++) {

                                  $features = explode("@", $msmrtFeaturesArr[$i]);
                                  $msmrtStatusArr[$i] = $features[0];
                                  $msmrtFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Measurements</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="measurements">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($msmrtStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="measurementsStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $msmrtStatusArr[$v] }}</option>
                                     @if($msmrtStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($msmrtStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="measurementsFeatureText[]" value="{{ $msmrtFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $addtCustFeaturesArr = explode("#", $productCatalog->additional_customizations);
                              $addtCustStatusArr = array();
                              $addtCustFeatureTextArr = array();

                              for($i=0; $i<count($addtCustFeaturesArr); $i++) {

                                  $features = explode("@", $addtCustFeaturesArr[$i]);
                                  $addtCustStatusArr[$i] = $features[0];
                                  $addtCustFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Additional Customizations</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="customizations">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($addtCustStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="customizationsStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $addtCustStatusArr[$v] }}</option>
                                     @if($addtCustStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($addtCustStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="customizationsFeatureText[]" value="{{ $addtCustFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                        <h2>Conditions</h2>
                          @php
                              $finFeaturesArr = explode("#", $productCatalog->finishing);
                              $finStatusArr = array();
                              $finFeatureTextArr = array();

                              for($i=0; $i<count($finFeaturesArr); $i++) {

                                  $features = explode("@", $finFeaturesArr[$i]);
                                  $finStatusArr[$i] = $features[0];
                                  $finFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Finishing</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="finishing">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($finStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="finishingStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $finStatusArr[$v] }}</option>
                                     @if($finStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($finStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="finishingFeatureText[]" value="{{ $finFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $pkgFeaturesArr = explode("#", $productCatalog->packaging);
                              $pkgStatusArr = array();
                              $pkgFeatureTextArr = array();

                              for($i=0; $i<count($pkgFeaturesArr); $i++) {

                                  $features = explode("@", $pkgFeaturesArr[$i]);
                                  $pkgStatusArr[$i] = $features[0];
                                  $pkgFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Packaging</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="packaging">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($pkgStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="packagingStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $pkgStatusArr[$v] }}</option>
                                     @if($pkgStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($pkgStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="packagingFeatureText[]" value="{{ $pkgFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $incFeaturesArr = explode("#", $productCatalog->inclusive);
                              $incStatusArr = array();
                              $incFeatureTextArr = array();

                              for($i=0; $i<count($incFeaturesArr); $i++) {

                                  $features = explode("@", $incFeaturesArr[$i]);
                                  $incStatusArr[$i] = $features[0];
                                  $incFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Inclusive</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="inclusive">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($incStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="inclusiveStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $incStatusArr[$v] }}</option>
                                     @if($incStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($incStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="inclusiveFeatureText[]" value="{{ $incFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          @php
                              $excFeaturesArr = explode("#", $productCatalog->exclusive);
                              $excStatusArr = array();
                              $excFeatureTextArr = array();

                              for($i=0; $i<count($excFeaturesArr); $i++) {

                                  $features = explode("@", $excFeaturesArr[$i]);
                                  $excStatusArr[$i] = $features[0];
                                  $excFeatureTextArr[$i] = $features[1];
                              }
                          @endphp
                          <h4 class="box-title">Exclusive</h4>
                          <table class="genericFeaturesTbl table table-bordered table-hover" id="exclusive">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                                <th class="text-center">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for($v=0; $v<count($excStatusArr); $v++)
                                <tr>
                                  <td style="width:15%;">
                                    <select class="form-control" name="exclusiveStatus[]"
                                    value="{{ old('status') }}" required>
                                     <option selected="selected">{{ $excStatusArr[$v] }}</option>
                                     @if($excStatusArr[$v] != 'Enable')
                                       <option>Enable</option>
                                     @endif
                                     @if($excStatusArr[$v] != 'Disable')
                                       <option>Disable</option>
                                     @endif
                                    </select>
                                  </td>
                                  <td style="width:70%;">
                                    <input class="form-control" type="text" name="exclusiveFeatureText[]" value="{{ $excFeatureTextArr[$v] }}" required>
                                  </td>
                                  <td>
                                    <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                    <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                  </td>
                                </tr>
                                @endfor
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                        <h4 class="box-title"> Additional Information </h4>
                        <tr class="{{ $errors->has('additionalInformation') ? 'has-error' : '' }}">
                            <td style="width:30%">Additional Comments</td>
                            <td>
                              <input class="form-control" type="text" id="additionalInformation"
                              name="additionalInformation" size="27" style="width:100%!important" value="{{ $productCatalog->additional_information }}" required>
                              <span class="text-danger">{{ $errors->first('additionalInformation') }}</span>
                            </td>
                        </tr>
                      </table>

                      <button class="btn btn-primary" type="submit">Update Product</button>

                   </div>
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

        $(".genericFeaturesTbl").on("click", ".ibtnAdd", function (event) {

            var featureType = $(this).closest("table").attr('id');
            var newRow = $("<tr>");
            var cols = "";
            cols += "<td style='width:15%;'><select class='form-control' name='" + featureType + "Status[]' value='{{ old('status') }}' required><option selected='selected'>Enable</option><option>Disable</option></select></td>";
            cols += "<td style='width:70%;'><input class='form-control' type='text' name='" + featureType + "FeatureText[]' value='N/A' required></td>";
            cols += "<td><p class='ibtnAdd btn btn-md btn-primary'>Add</p><p class='ibtnDel btn btn-md btn-danger' style='float:right;'>Delete</p></td>";
            newRow.append(cols);
            $(this).closest("tr").after(newRow);
        });

        $(".genericFeaturesTbl").on("click", ".ibtnDel", function (event) {

            var tableLength = $(this).closest("table").find("tr").length - 1;
            if(tableLength > 1) {
              $(this).closest("tr").remove();
            }
        });
      });
  </script>

@endsection
