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
              <h3 class="box-title" style="padding-left: 20px;"> {{ $productCatalog->product_category_code }} </h3>
            </div>

            <div class="box-body">
             <div class="row">
               <div class="col-md-12">
                 <table class="table table-bordered table-striped">
                   <h4 class="box-title" style="padding-left: 20px;"> Product Details </h4>

                       <tr class="text-center">
                           <td style="width:30%">Created By</td>
                           <td>
                             {{ $productCatalog->created_by }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Product Category</td>
                           <td>
                             {{ $productCatalog->product_category }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Product Category Code</td>
                           <td>
                             {{ $productCatalog->product_category_code }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Product Description</td>
                           <td>
                             {{ $productCatalog->product_description }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Art Work Logo</td>
                           <td>
                             {{ $productCatalog->art_work_logo }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Finishing</td>
                           <td>
                             {{ $productCatalog->finishing }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Fitting Sizes</td>
                           <td>
                             {{ $productCatalog->fitting_sizes }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Packaging</td>
                           <td>
                             {{ $productCatalog->packaging }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Inclusive</td>
                           <td>
                             {{ $productCatalog->inclusive }}
                           </td>
                       </tr>

                       <tr class="text-center">
                           <td style="width:30%">Exclusive</td>
                           <td>
                             {{ $productCatalog->exclusive }}
                           </td>
                       </tr>

                  </table>

                  <table class="table table-bordered table-striped">
                    <h4 class="box-title" style="padding-left: 20px;"> Product Features </h4>
                      <input type="hidden" id="reqCount" name="reqCount">
                      <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                          <tr class="text-center">
                            <th class="text-center">Feature Confirmation</th>
                            <th class="text-center">Specification</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                            $i=0;
                          @endphp
                          @for($i=0; $i<count($statusArr); $i++)
                            <tr class="text-center">
                              <td style="width: 20%;">
                                {{ $statusArr[$i] }}
                              </td>
                              <td>
                                {{ $featureTextArr[$i] }}
                              </td>
                            </tr>
                          @endfor
                        </tbody>
                      </table>
                  </table>
                  <br/><br/>

                  <table class="table table-bordered table-striped">
                    <h4 class="box-title" style="padding-left: 20px;"> Additional Information </h4>
                    <tr class="text-center">
                        <td style="width:30%">Additional Comments</td>
                        <td>
                          {{ $productCatalog->additional_information }}
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
