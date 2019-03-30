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

                           <tr class="{{ $errors->has('artWorkLogo') ? 'has-error' : '' }}">
                               <td style="width:30%">Art Work Logo</td>
                               <td>
                                 <input class="form-control" type="text" id="artWorkLogo"
                                 name="artWorkLogo" size="27" style="width:100%!important" value="{{ old('artWorkLogo') }}" required>
                                 <span class="text-danger">{{ $errors->first('artWorkLogo') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('finishing') ? 'has-error' : '' }}">
                               <td style="width:30%">Finishing</td>
                               <td>
                                 <input class="form-control" type="text" id="finishing"
                                 name="finishing" size="27" style="width:100%!important" value="{{ old('finishing') }}" required>
                                 <span class="text-danger">{{ $errors->first('finishing') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('fittingSizes') ? 'has-error' : '' }}">
                               <td style="width:30%">Fitting Sizes</td>
                               <td>
                                 <input class="form-control" type="text" id="fittingSizes"
                                 name="fittingSizes" size="27" style="width:100%!important" value="{{ old('fittingSizes') }}" required>
                                 <span class="text-danger">{{ $errors->first('fittingSizes') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('packaging') ? 'has-error' : '' }}">
                               <td style="width:30%">Packaging</td>
                               <td>
                                 <input class="form-control" type="text" id="packaging"
                                 name="packaging" size="27" style="width:100%!important" value="{{ old('packaging') }}" required>
                                 <span class="text-danger">{{ $errors->first('packaging') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('inclusive') ? 'has-error' : '' }}">
                               <td style="width:30%">Inclusive</td>
                               <td>
                                 <input class="form-control" type="text" id="inclusive"
                                 name="inclusive" size="27" style="width:100%!important" value="{{ old('inclusive') }}" required>
                                 <span class="text-danger">{{ $errors->first('inclusive') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('exclusive') ? 'has-error' : '' }}">
                               <td style="width:30%">Exclusive</td>
                               <td>
                                 <input class="form-control" type="text" id="exclusive"
                                 name="exclusive" size="27" style="width:100%!important" value="{{ old('exclusive') }}" required>
                                 <span class="text-danger">{{ $errors->first('exclusive') }}</span>
                               </td>
                           </tr>

                      </table>

                      <table class="table table-bordered table-striped">
                        <h4 class="box-title"> Product Features </h4>
                          <input type="hidden" id="reqCount" name="reqCount">
                          <table class="table table-bordered table-hover" id="tab_logic">
                            <thead>
                              <tr>
                                <th class="text-center">Feature Confirmation</th>
                                <th class="text-center">Specification</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr id="addr0">
                                <td style="width: 20%;">
                                  <select class="form-control" name="status[]"
                                  value="{{ old('status') }}" required>
                                   <option selected="selected">Enable</option>
                                   <option>Disable</option>
                                  </select>
                                </td>
                                <td>
                                  <input class="form-control" type="text" name="featureText[]" required>
                                </td>
                              </tr>
                              <tr id="addr1">
                              </tr>
                            </tbody>
                          </table>
                          <p id="addRow" class="btn btn-primary" style="float:left;">Add Row</p>
                          <p id="deleteRow" class="btn btn-danger" style="float:right;">Delete Row</p>
                      </table>
                      <br/><br/>

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

          var i = $('#tab_logic tr').length - 2;

          $('#reqCount').val(i);

          $('#addRow').click(function() {

              $('#addr' + i).html(""
              + "<td style='width: 20%;'><select class='form-control' name='status[]' value='{{ old('status') }}' required><option selected='selected'>Enable</option><option>Disable</option></select></td>"
              + "<td><input class='form-control' type='text' name='featureText[]' required></td>");

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
      });
  </script>

@endsection
