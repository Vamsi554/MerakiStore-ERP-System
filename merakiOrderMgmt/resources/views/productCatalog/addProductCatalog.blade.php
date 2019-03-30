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
               <form method="POST" class="form-group" action="{{ URL::to('/') }}/productCatalog/addProduct" autocomplete="off">

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
                                 name="productCategory" size="27" style="width:100%!important" value="{{ old('productCategory') }}" required>
                                 <span class="text-danger">{{ $errors->first('productCategory') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('productCategoryCode') ? 'has-error' : '' }}">
                               <td style="width:30%">Product Category Code</td>
                               <td>
                                 <input class="form-control" type="text" id="productCategoryCode"
                                 name="productCategoryCode" size="27" style="width:100%!important" value="{{ old('productCategoryCode') }}" required>
                                 <span class="text-danger">{{ $errors->first('productCategoryCode') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('productDescr') ? 'has-error' : '' }}">
                               <td style="width:30%">Product Description</td>
                               <td>
                                 <input class="form-control" type="text" id="productDescr"
                                 name="productDescr" size="27" style="width:100%!important" value="{{ old('productDescr') }}" required>
                                 <span class="text-danger">{{ $errors->first('productDescr') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('artWork') ? 'has-error' : '' }}">
                               <td style="width:30%">Art Work</td>
                               <td>
                                 <input class="form-control" type="text" id="artWork"
                                 name="artWork" size="27" style="width:100%!important" value="{{ old('artWork') }}" required>
                                 <span class="text-danger">{{ $errors->first('artWork') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('hsnCode') ? 'has-error' : '' }}">
                               <td style="width:30%">HSN Code</td>
                               <td>
                                 <input class="form-control" type="text" id="hsnCode"
                                 name="hsnCode" size="27" style="width:100%!important" value="{{ old('hsnCode') }}" required>
                                 <span class="text-danger">{{ $errors->first('hsnCode') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('gstPer') ? 'has-error' : '' }}">
                               <td style="width:30%">GST Tax (%)</td>
                               <td>
                                 <input class="form-control" type="number" step="any" id="gstPer"
                                 name="gstPer" size="27" style="width:100%!important" value="{{ old('gstPer') }}" required>
                                 <span class="text-danger">{{ $errors->first('gstPer') }}</span>
                               </td>
                           </tr>
                      </table>

                      <table class="table table-bordered table-striped">
                          <h2>Product Features</h2>
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="prodStyleStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="prodStyleFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="materialStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="materialFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="qualityStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="qualityFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="fabricStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="fabricFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="addtProdFtStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="addtProdFtFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          <h2>Product Customizations</h2>
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="colourStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="colourFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="printMethodStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="printMethodFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="printPlacementStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="printPlacementFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="printAreaStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="printAreaFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="measurementsStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="measurementsFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="customizationsStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="customizationsFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
                          <h2>Conditions</h2>
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="finishingStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="finishingFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="packagingStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="packagingFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="inclusiveStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="inclusiveFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>
                      <br>
                      <table class="table table-bordered table-striped">
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
                              <tr>
                                <td style="width:15%;">
                                  <select class="form-control" name="exclusiveStatus[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td style="width:70%;">
                                  <input class="form-control" type="text" name="exclusiveFeatureText[]" value="N/A" required>
                                </td>
                                <td>
                                  <p class="ibtnAdd btn btn-md btn-primary">Add</p>
                                  <p class="ibtnDel btn btn-md btn-danger" style="float:right;">Delete</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </table>

                      <table class="table table-bordered table-striped">
                        <h4 class="box-title"> Additional Information </h4>
                        <tr class="{{ $errors->has('additionalInformation') ? 'has-error' : '' }}">
                            <td style="width:30%">Additional Comments</td>
                            <td>
                              <input class="form-control" type="text" id="additionalInformation"
                              name="additionalInformation" size="27" style="width:100%!important" value="{{ old('additionalInformation') }}" required>
                              <span class="text-danger">{{ $errors->first('additionalInformation') }}</span>
                            </td>
                        </tr>
                      </table>

                      <button class="btn btn-primary" type="submit">Add Product</button>

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
