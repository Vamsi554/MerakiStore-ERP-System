@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tech Pack | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Tech Pack Order Form </h3>
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

               <form method="POST" action="{{ URL::to('/') }}/order/admin/techpack/save/{{ $order->id }}/{{ $order->enquiry_id }}" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="techPackCreDttm" id="techPackCreDttm" value="{{ Carbon\Carbon::now()->toDateString() }}">

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

                   <table class="table table-bordered table-striped">
                    <h4 class="box-title"> Requirement Details </h4>

                      <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                          <tr>
                            <th class="text-center">Product Description</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Estimated Delivery</th>
                            <th class="text-center">Breakup</th>
                          </tr>
                        </thead>
                        <tbody>
                          @for($i=0; $i<count($prodCatArr); $i++)
                            <tr id='addr<?php echo $i; ?>'>
                              <td style="width:25%;">
                                {{ $prodCatArr[$i] }}
                                <input type="hidden" id='prodDescr<?php echo $i; ?>' name='prodDescr[]' value="{{ $prodCatArr[$i] }}">
                              </td>
                              <td style="width:15%;">
                                {{ $prodQtyArr[$i] }}
                                <input type="hidden" id='prodQty<?php echo $i; ?>' name='prodQty[]' value="{{ $prodQtyArr[$i] }}">
                              </td>
                              <td style="width:25%;">
                                <input class="form-control" type="date" id='estDelivery<?php echo $i; ?>' name='estDelivery[]'>
                              </td>
                              <td>
                                <input class="form-control" type="text" id='breakUp<?php echo $i; ?>' name='breakUp[]'>
                              </td>
                            </tr>
                          @endfor
                        </tbody>
                      </table>
                  </table>

                   <button class="btn btn-primary" type="submit">Generate Tech Pack</button>
              </form>
              <br/>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


@endsection
