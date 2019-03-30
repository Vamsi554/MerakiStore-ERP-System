@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Product Catalog
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Products | Meraki Store</h3>
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
                  <th>Product Code</th>
                  <th>Product Category</th>
                  <th>Description</th>
                  <th>Art Work</th>
                  <th>HSN/SAC</th>
                  <th>GST (%)</th>
                  <th>Created By</th>
                  <th>Update</th>
                  <th>View</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($productCatalog as $product)
                  <tr>
                    <td>{{ $product->product_category_code }}</td>
                    <td>{{ $product->product_category }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>{{ $product->art_work }}</td>
                    <td>{{ $product->hsn_code }}</td>
                    <td>{{ $product->gst_tax }}</td>
                    <td>{{ $product->created_by }}</td>
                    <td>
                      <a href="{{ URL::to('/') }}/productCatalog/updateProduct/{{ $product->id }}" class="btn btn-warning ml-2">Update</a>
                    </td>
                    <td>
                      <a href="{{ URL::to('/') }}/productCatalog/displayProduct/{{ $product->id }}" class="btn btn-info ml-2">View</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ URL::to('/') }}/productCatalog/createProduct" class="btn btn-primary ml-2">Add Product</a>

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
