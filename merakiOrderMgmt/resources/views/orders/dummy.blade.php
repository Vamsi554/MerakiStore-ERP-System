@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        {{ $title }}
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Orders | Meraki Store</h3>
            </div>

            <div class="box-body">
                <h3>No Data to Display</h3>
                <br/>
                <p class="text-capitalize">Start creating an order by filling out the enquiry form</p>
            </div>
          </div>
        </div>
      </div>


      <a href="{{ URL::to('/') }}/enquiry/createEnquiry" class="btn btn-primary ml-2">Create Enquiry</a>

    </section>
  </div>

@endsection
