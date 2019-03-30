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

                       <tr>
                           <td style="width:30%">Product Category</td>
                           <td>
                             {{ $productCatalog->product_category }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Product Category Code</td>
                           <td>
                             {{ $productCatalog->product_category_code }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Product Description</td>
                           <td>
                             {{ $productCatalog->product_description }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Art Work</td>
                           <td>
                             {{ $productCatalog->art_work }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">HSN Code</td>
                           <td>
                             {{ $productCatalog->hsn_code }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">GST Tax</td>
                           <td>
                             {{ $productCatalog->gst_tax }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Created By</td>
                           <td>
                             {{ $productCatalog->created_by }}
                           </td>
                       </tr>
                  </table>
                  <br>
                  <table class="table table-bordered table-striped">
                    <h4 class="box-title" style="padding-left: 20px;"> Features / Customizations / Conditions </h4>
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Enabled Features</th>
                        <th>Disabled Features</th>
                      </tr>
                    </thead>
                    <tbody>
                    @for($f=0; $f<count($productCategoryArr); $f++)
                      <tr>
                        <td>{{ $productCategoryArr[$f] }}</td>
                        @php
                          $e = 0;
                          $d = 0;
                          $enableArr = array();
                          $disableArr = array();
                          $custArray = explode("#",$productCatalogCustomizationsArr[$f]);
                          for($v=0; $v<count($custArray); $v++) {
                              $indvFeature = explode("@", $custArray[$v]);
                              if($indvFeature[0] == 'Enable') {
                                  $enableArr[$e] = $indvFeature[1];
                                  $e++;
                              }
                              else {
                                  $disableArr[$d] = $indvFeature[1];
                                  $d++;
                              }
                          }
                        @endphp
                        <td>
                          <ul>
                            @for($m=0; $m<count($enableArr); $m++)
                              <li>{{ $enableArr[$m] }}</li>
                            @endfor
                          </ul>
                        </td>
                        <td>
                          <ul>
                            @for($m=0; $m<count($disableArr); $m++)
                              <li>{{ $disableArr[$m] }}</li>
                            @endfor
                          </ul>
                        </td>
                      </tr>
                    @endfor
                    </tbody>
                  </table>
                  <br>
                  <table class="table table-bordered table-striped">
                    <h4 class="box-title" style="padding-left: 20px;"> Additional Information </h4>
                    <tr>
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
