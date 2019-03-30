<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP | Meraki Store</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Include the StyleSheets -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <!-- Include the website ICON File -->
  <link rel="icon" type="image/png" href="{{ url('/images/merakii.ico') }}">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style type="text/css">

      .form-control:focus{
          border-color: #cccccc;
          -webkit-box-shadow: none;
          box-shadow: none;
      }
  </style>
  @yield('printCss')
  @yield('loadCustomJs')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="{{ url('/') }}" class="logo">
      <span class="logo-lg"><b>Meraki Store</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              @php
                $allUserNotifications = auth()->user()->unreadNotifications->where('type', 'App\Notifications\UserActions');
                $allUserReadNotifications = auth()->user()->readNotifications->where('type', 'App\Notifications\UserActions');
              @endphp
              @if($allUserNotifications->count() > 0)
                <span class="label label-warning">{{ $allUserNotifications->count() }}</span>
              @endif
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ $allUserNotifications->count() }} new notifications</li>

              <li>
                <ul class="menu">
                  @if($allUserNotifications->count() > 0)
                      <li><a href="{{ url('/meraki/userNotifications/markAllRead') }}"><i class="fa fa-hand-o-right text-blue"></i>Mark All as Read</a></li>
                  @endif
                  <!-- New Notifications -->
                  @foreach ($allUserNotifications as $notification)
                    <li>
                        <a href="{{ url($notification->data['link']) }}" target="_blank">
                           <i class="fa fa-user text-yellow"></i>  {{ $notification->data['data'] }}
                        </a>
                    </li>
                  @endforeach
                  <!-- Read Notifications -->
                  @foreach ($allUserReadNotifications as $notification)
                    <li>
                      <a href="{{ url($notification->data['link']) }}" target="_blank">
                         <i class="fa fa-user text-green"></i> {{ $notification->data['data'] }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              </li>
            </ul>
          </li>

          <!-- Tasks -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              @php
                $priorityPerArr = array();
                $priorityPerArr["Lowest"] = 20;
                $priorityPerArr["Low"] = 30;
                $priorityPerArr["Normal"] = 40;
                $priorityPerArr["Medium"] = 60;
                $priorityPerArr["High"] = 80;
                $priorityPerArr["Highest"] = 100;
                $allUserTasks = auth()->user()->unreadNotifications->where('type', 'App\Notifications\UserTasks');
                $allUserReadTasks = auth()->user()->readNotifications->where('type', 'App\Notifications\UserTasks');
              @endphp
              @if($allUserTasks->count() > 0)
                <span class="label label-danger">{{ $allUserTasks->count() }}</span>
              @endif
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ $allUserTasks->count() }} new tasks</li>
              <li>
                <ul class="menu">
                  @if($allUserTasks->count() > 0)
                      <li><a href="{{ url('/meraki/userTasks/markAllRead') }}"><i class="fa fa-hand-o-right text-blue"></i> Mark All as Read </a></li>
                  @endif
                  @foreach ($allUserTasks as $task)
                    <li>
                        <a href="{{ url($task->data['link']) }}" target="_blank">
                           <h3>
                             {{ $task->data['data'] }}
                             <small class="pull-right">{{ $task->data['priority'] }}</small>
                           </h3>
                           @php
                             $priorityVar = $task->data['priority'];
                             $percentage = $priorityPerArr[$priorityVar];
                           @endphp
                           <div class="progress xs">
                             <div class="progress-bar progress-bar-warning" style="width: {{ $percentage }}%" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                               <span class="sr-only">{{ $percentage }}% Complete</span>
                             </div>
                           </div>
                        </a>
                    </li>
                  @endforeach

                  @foreach ($allUserReadTasks as $task)
                    <li>
                        <a href="{{ url($task->data['link']) }}" target="_blank">
                           <h3>
                             {{ $task->data['data'] }}
                             <small class="pull-right">{{ $task->data['priority'] }}</small>
                           </h3>
                           @php
                             $priorityVar = $task->data['priority'];
                             $percentage = $priorityPerArr[$priorityVar];
                           @endphp
                           <div class="progress xs">
                             <div class="progress-bar progress-bar-warning" style="width: {{ $percentage }}%" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                               <span class="sr-only">{{ $percentage }}% Complete</span>
                             </div>
                           </div>
                        </a>
                    </li>
                  @endforeach
                </ul>
              </li>
            </ul>
          </li>

          <!-- User Account -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/images/merakiLogo.png" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/images/merakiLogo.png" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }}
                  <small>Member since 2018</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  Sign out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/images/merakiLogo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <i class="fa fa-circle text-success"></i> Online
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/enquiry/userLogin') }}"><i class="fa fa-circle-o"></i> My Enquires </a></li>
            <li><a href="{{ url('/order/userLogin') }}"><i class="fa fa-circle-o"></i> My Orders </a></li>
            <li><a href="{{ url('/meraki/tasks') }}"><i class="fa fa-circle-o"></i> My Tasks </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-send-o"></i> <span>Enquiry</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/enquiry') }}"><i class="fa fa-circle-o"></i> All Enquires </a></li>
            <li><a href="{{ url('/enquiry/quotation') }}"><i class="fa fa-circle-o"></i> Pending Quotations </a></li>
            <li><a href="{{ url('/enquiry/approved') }}"><i class="fa fa-circle-o"></i> Approved Enquires </a></li>
            <li><a href="{{ url('/enquiry/cancel') }}"><i class="fa fa-circle-o"></i> Cancelled Enquires </a></li>
            <li><a href="{{ url('/enquiry/hold') }}"><i class="fa fa-circle-o"></i> Hold Enquires </a></li>
            <li><a href="{{ url('/enquiry/createEnquiry') }}"><i class="fa fa-circle-o"></i> New Enquiry </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-first-order"></i> <span>Orders</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/order') }}"><i class="fa fa-circle-o"></i> All Orders </a></li>
            <li><a href="{{ url('/order/hold') }}"><i class="fa fa-circle-o"></i> Hold Orders </a></li>
            <li><a href="{{ url('/order/cancel') }}"><i class="fa fa-circle-o"></i> Cancelled Orders </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i> <span>Product Catalog</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/productCatalog') }}"><i class="fa fa-circle-o"></i> View Catalog </a></li>
            <li><a href="{{ url('/productCatalog/createProduct') }}"><i class="fa fa-circle-o"></i> Add Product </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-industry"></i> <span>Vendors</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/meraki/vendors') }}"><i class="fa fa-circle-o"></i> View Vendors </a></li>
            <li><a href="{{ url('/meraki/vendors/addVendor') }}"><i class="fa fa-circle-o"></i> Add Vendor </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>User Management</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/meraki/users') }}"><i class="fa fa-circle-o"></i> View Users </a></li>
            <li><a href="{{ url('/meraki/users/addUser') }}"><i class="fa fa-circle-o"></i> Add User </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i> <span>Task Management</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/meraki/tasks') }}"><i class="fa fa-circle-o"></i> All Tasks </a></li>
            <li><a href="{{ url('/meraki/tasks/open') }}"><i class="fa fa-circle-o"></i> Open Tasks </a></li>
            <li><a href="{{ url('/meraki/tasks/completed') }}"><i class="fa fa-circle-o"></i> Completed Tasks </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i> <span>Admin Orders</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/order/manageAdmin') }}"><i class="fa fa-circle-o"></i> View Orders </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart-o"></i> <span>Business Analytics</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/customers/orders/track') }}"><i class="fa fa-circle-o"></i> Customers vs Orders </a></li>
            <li><a href="{{ url('/leadSource/track') }}"><i class="fa fa-circle-o"></i> Lead Source </a></li>
          </ul>
        </li>

      </ul>
    </section>
  </aside>

  @yield('content')

  <footer class="main-footer">
    <strong>Copyright &copy; 2018 <a href="#">Meraki Store</a>.</strong> All rights reserved.
  </footer>

</div>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

@yield('loadDynamicProductDetails')
@yield('customJs')
@yield('d3VisualizationJs')
</body>
</html>
