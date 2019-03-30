@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Oops! Something's Wrong
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <div class="box-body">
                <h3>Oops! Some Error Occured While Processing the Request. Reach Out to Technical Support For More Information</h3>
                <br>
                <h3>More Information</h3>
                <h2 class="page-header">
                  <img src="{{ asset('images/merakiStoreFooterLogo.png') }}"
                  class="img-fluid figure-img" alt="Meraki Store" style="width: 150px;" />
                  <p><strong>MERAKII ENTERPRISES</strong></p>
                    <p style="font-size: 20px;">
                      Abhilash Gali
                    </p>
                  <address>
                    <p style="font-size: 15px;">
                    D.No:101, Near SR Club, Sri Nagar Colony <br>
                    Hyderabad, Telangana<br>
                    Tel: 040-48554470, 9000909109<br>
                    Email: <b><i>abhilash.merakii@gmail.com</i></b><br>
                    Technical Support: <b><i>vamsikrish554@gmail.com</i></b><br>
                  </p>
                </h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
