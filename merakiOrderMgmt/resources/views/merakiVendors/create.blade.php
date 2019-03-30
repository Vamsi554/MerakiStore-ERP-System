@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Vendors | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Vendor Form </h3>
            </div>

            <div class="box-body">
               <form method="POST" class="form-group" action="{{ URL::to('/') }}/meraki/vendors/addVendor" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                 <div class="row">
                   <div class="col-md-12">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Vendor Details </h4>

                           <tr class="{{ $errors->has('vendorCode') ? 'has-error' : '' }}">
                               <td style="width:30%">Vendor Code</td>
                               <td>
                                 <input class="form-control" type="text" id="vendorCode"
                                 name="vendorCode" size="27" style="width:100%!important" value="{{ old('vendorCode') }}" required>
                                 <span class="text-danger">{{ $errors->first('vendorCode') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('vendorName') ? 'has-error' : '' }}">
                               <td style="width:30%">Vendor Name</td>
                               <td>
                                 <input class="form-control" type="text" id="vendorName"
                                 name="vendorName" size="27" style="width:100%!important" value="{{ old('vendorName') }}" required>
                                 <span class="text-danger">{{ $errors->first('vendorName') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('vendorPhone') ? 'has-error' : '' }}">
                               <td style="width:30%">Vendor Phone</td>
                               <td>
                                 <input class="form-control" type="text" id="vendorPhone"
                                 name="vendorPhone" size="27" style="width:100%!important" value="{{ old('vendorPhone') }}" required>
                                 <span class="text-danger">{{ $errors->first('vendorPhone') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('vendorCompany') ? 'has-error' : '' }}">
                               <td style="width:30%">Vendor Company</td>
                               <td>
                                 <input class="form-control" type="text" id="vendorCompany"
                                 name="vendorCompany" size="27" style="width:100%!important" value="{{ old('vendorCompany') }}" required>
                                 <span class="text-danger">{{ $errors->first('vendorCompany') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('vendorAddress1') ? 'has-error' : '' }}">
                               <td style="width:30%">Vendor Address 1</td>
                               <td>
                                 <input class="form-control" type="text" id="vendorAddress1"
                                 name="vendorAddress1" size="27" style="width:100%!important" value="{{ old('vendorAddress1') }}" required>
                                 <span class="text-danger">{{ $errors->first('vendorAddress1') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('vendorAddress2') ? 'has-error' : '' }}">
                               <td style="width:30%">Vendor Address 2</td>
                               <td>
                                 <input class="form-control" type="text" id="vendorAddress2"
                                 name="vendorAddress2" size="27" style="width:100%!important" value="{{ old('vendorAddress2') }}" required>
                                 <span class="text-danger">{{ $errors->first('vendorAddress2') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('street') ? 'has-error' : '' }}">
                               <td style="width:30%">Street</td>
                               <td>
                                 <input class="form-control" type="text" id="street"
                                 name="street" size="27" style="width:100%!important" value="{{ old('street') }}" required>
                                 <span class="text-danger">{{ $errors->first('street') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('city') ? 'has-error' : '' }}">
                               <td style="width:30%">City</td>
                               <td>
                                 <input class="form-control" type="text" id="city"
                                 name="city" size="27" style="width:100%!important" value="{{ old('city') }}" required>
                                 <span class="text-danger">{{ $errors->first('city') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('state') ? 'has-error' : '' }}">
                               <td style="width:30%">State</td>
                               <td>
                                 <input class="form-control" type="text" id="state"
                                 name="state" size="27" style="width:100%!important" value="{{ old('state') }}" required>
                                 <span class="text-danger">{{ $errors->first('state') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('zipCode') ? 'has-error' : '' }}">
                               <td style="width:30%">Zip Code</td>
                               <td>
                                 <input class="form-control" type="text" id="zipCode"
                                 name="zipCode" size="27" style="width:100%!important" value="{{ old('zipCode') }}" required>
                                 <span class="text-danger">{{ $errors->first('zipCode') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('vendorTin') ? 'has-error' : '' }}">
                               <td style="width:30%">Vendor TIN</td>
                               <td>
                                 <input class="form-control" type="text" id="vendorTin"
                                 name="vendorTin" size="27" style="width:100%!important" value="{{ old('vendorTin') }}" required>
                                 <span class="text-danger">{{ $errors->first('vendorTin') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('vendorCst') ? 'has-error' : '' }}">
                               <td style="width:30%">Vendor CST</td>
                               <td>
                                 <input class="form-control" type="text" id="vendorCst"
                                 name="vendorCst" size="27" style="width:100%!important" value="{{ old('vendorCst') }}" required>
                                 <span class="text-danger">{{ $errors->first('vendorCst') }}</span>
                               </td>
                           </tr>

                      </table>

                      <button class="btn btn-primary" type="submit">Add Vendor</button>

                   </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
