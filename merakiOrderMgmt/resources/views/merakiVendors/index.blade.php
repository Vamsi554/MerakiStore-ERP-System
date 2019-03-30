@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Vendors
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Vendors | Meraki Store</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(Session::has('success'))
                  <div id="alertMsg" class="alert alert-success" style="display: inline-block;">
                     {{ Session::get('success') }}
                        @php
                         Session::forget('success');
                        @endphp
                   </div>
               @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Vendor Code</th>
                  <th>Vendor Name</th>
                  <th>Vendor Phone</th>
                  <th>Vendor Company</th>
                  <th>Location</th>
                  <th>Update</th>
                  <th>View</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($vendors as $vendor)
                  <tr>
                    <td>{{ $vendor->vendor_code }}</td>
                    <td>{{ $vendor->vendor_name }}</td>
                    <td>{{ $vendor->vendor_phone }}</td>
                    <td>{{ $vendor->vendor_company }}</td>
                    <td>{{ $vendor->city }}</td>
                    <td>
                      <a href="{{ URL::to('/') }}/meraki/vendors/updateVendor/{{ $vendor->id }}" class="btn btn-warning ml-2">Update</a>
                    </td>
                    <td>
                      <a href="{{ URL::to('/') }}/meraki/vendors/displayVendor/{{ $vendor->id }}" class="btn btn-info ml-2">View</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ URL::to('/') }}/meraki/vendors/addVendor" class="btn btn-primary ml-2">Add Vendor</a>

    </section>
  </div>

@endsection

@section('customJs')

<script type="text/javascript">

  $(document).ready(function() {

      $("#alertMsg").delay(5000).fadeOut();
  });
</script>
@endsection
