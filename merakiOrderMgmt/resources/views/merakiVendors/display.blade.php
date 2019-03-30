@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Vendor | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <div class="box-header">
              <h3 class="box-title"> {{ $vendor->vendor_code }} </h3>
            </div>

            <div class="box-body">
             <div class="row">
               <div class="col-md-12">
                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> Vendor Details </h4>

                       <tr>
                           <td style="width:30%">Vendor Code</td>
                           <td>
                             {{ $vendor->vendor_code }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Vendor Name</td>
                           <td>
                             {{ $vendor->vendor_name }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Vendor Phone</td>
                           <td>
                             {{ $vendor->vendor_phone }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Vendor Company</td>
                           <td>
                             {{ $vendor->vendor_company }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Vendor Address 1</td>
                           <td>
                             {{ $vendor->vendor_address1 }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Vendor Address 2</td>
                           <td>
                             {{ $vendor->vendor_address2 }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Street</td>
                           <td>
                             {{ $vendor->street }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">City</td>
                           <td>
                             {{ $vendor->city }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">State</td>
                           <td>
                             {{ $vendor->state }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Zip Code</td>
                           <td>
                             {{ $vendor->zipcode }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Vendor TIN</td>
                           <td>
                             {{ $vendor->vendor_TIN }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Vendor CST</td>
                           <td>
                             {{ $vendor->vendor_CST }}
                           </td>
                       </tr>

                  </table>

               </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
