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
              <h3 class="box-title">Enquiry | Meraki Store</h3>
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
                  <th>SNo</th>
                  <th>Lead Person</th>
                  <th>Document No</th>
                  <th>Organization</th>
                  <th>Contact Details</th>
                  <th>Enquiry Status</th>
                  <th>Action</th>
                  <th>View</th>
                  @if(\Auth::user()->admin == 'Yes')
                    <th>Quotations</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @php
                  $sNo = 1
                @endphp
                @foreach ($enquiries as $enquiry)
                  <tr>
                    <td>{{ $sNo++ }}</td>
                    <td style="width: 15%;">{{ $enquiry->concernedLeadPerson }}</td>
                    <td style="width: 15%;">{{ $enquiry->documentNumber }}</td>
                    <td style="width: 20%;">{{ $enquiry->organizationName }} , {{ $enquiry->eventPlace }}</td>
                    <td style="width: 20%;">{{ $enquiry->name }}, {{ $enquiry->phone }}</td>
                    <td style="width: 18%;">{{ $enquiry->enquiryStatus }}</td>
                    <td>
                      @if($enquiry->enquiryStatus == 'APPROVED')
                          <a href="javascript:void(0);" class="btn btn-default disabled">Update</a>
                      @else
                          <a href="{{ URL::to('/') }}/enquiry/updateEnquiry/{{ $enquiry->id }}" class="btn btn-warning ml-2">Update</a>
                      @endif

                    </td>
                    <td>
                      <a href="{{ URL::to('/') }}/enquiry/displayEnquiry/{{ $enquiry->id }}" class="btn btn-info ml-2">View</a>
                    </td>
                    @if(\Auth::user()->admin == 'Yes')
                      <td>
                      @if($enquiry->enquiryStatus == 'REQUEST FOR QUOTATION' || $enquiry->enquiryStatus == 'REQUEST FOR REVISED QUOTATION')
                          <a href="{{ URL::to('/') }}/enquiry/generateQuote/{{ $enquiry->id }}" class="btn btn-primary ml-2">Generate</a>
                      @else
                          <a href="javascript:void(0);" class="btn btn-default disabled">Generate</a>
                      @endif
                      </td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ URL::to('/') }}/enquiry/createEnquiry" class="btn btn-primary ml-2">Create Enquiry</a>

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
