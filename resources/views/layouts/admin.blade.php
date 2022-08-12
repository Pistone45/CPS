<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Login') }} | @yield('title')</title>

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/css/alertify.min.css') }}">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed" onload="FocusOnInput()">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <!-- <img class="animation__shake" src="{{ asset('dist/img/avatar.png') }}" alt="AdminLTELogo" height="60" width="60"> -->
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      @if(Auth::user()->role->name == 'Manager' || Auth::user()->role->name == 'manager')
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-<?php if($notifications_count < 1){ echo "success"; }else{ echo "warning"; } ?> navbar-badge">{{$notifications_count}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
          @if($notifications_count == 1)
          {{ $notifications_count }} Notification

          @else
          {{ $notifications_count }} Notifications
          @endif

          </span>

          @foreach($notifications as $notification)
          <div class="dropdown-divider"></div>
          <a href="/messages/{{ $notification->message_id }}/{{ $notification->id }}" class="dropdown-item">
            {{ substr($notification->title, 0, 25) }}
            <span class="float-right text-muted text-sm">
              <?php $date = date_create($notification['created_at']); echo date_format($date,"H:i a"); ?></td>
            </span>
          </a>
          @endforeach

          <a href="/notifications" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      @endif

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i style="color: black;" class="fas fa-sign-out-alt fa-lg"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="dropdown-item dropdown-footer">Logout
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form></a>

        </div>
      </li>


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php
          $email= Auth::user()->email;
         
          // Removing Spaces
          $email = trim($email);
         
          // Make all Lower Case
          $email = strtolower($email);

          // Generating Hash
          $email_hash = md5($email);

          $image = Auth::user()->image;
        ?>
          @if(Auth::user()->image == "")
          <img src="https://www.gravatar.com/avatar/<?php echo $email_hash?>?s=70" class="img-circle elevation-2" alt="Gravatar Image">
          @else
          <img src="/storage/uploads/users/{{ $image }}" class="img-circle elevation-10" alt="User Image">
          @endif
        </div>
        <div class="info">
          <h5><a href="{{ asset('users/profile') }}" class="d-block">
            <?php

            if(isset(Auth::user()->email)){

            echo ucfirst(trans( Auth::user()->first_name)); ?>

             <b style="font-size: 15px;">({{ Auth::user()->role->name }})</b>

             <?php
          }else{ route('logout'); }
          ?>
            
          </a></h5>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="/home" class="nav-link {{ Request::path() === 'home' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>

          </li>

          <!-- Admin Links -->
          @if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'admin')

          <li class="nav-item">
            <a href="/users" class="nav-link {{ Request::path() === 'users' ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>

<!--           <li class="nav-item">
            <a href="#" class="nav-link {{ Request::path() === 'items' ? 'active' : '' }}">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Items
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/items/add-item" class="nav-link {{ Request::path() === 'items/add-item' ? 'active' : '' }}">
                  <i class="fa fa-plus"></i>
                  <p>Add Item</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/items" class="nav-link {{ Request::path() === 'items/' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>View Items</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/history" class="nav-link {{ Request::path() === 'history' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>Item History</p>
                </a>
              </li>

            </ul>
          </li> -->


          <li class="nav-header">Miscellaneous</li>
          <li class="nav-item">
            <a href="/roles" class="nav-link {{ Request::path() === 'roles' ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tag"></i>
              <p>
                Roles
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/notifications/timeframe" class="nav-link {{ Request::path() === 'notifications/timeframe' ? 'active' : '' }}">
              <i class="far fa-clock"></i>
              <p>
                Notifications Timeframe
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="/audit" class="nav-link {{ Request::path() === 'audit' ? 'active' : '' }}">
              <i class="nav-icon fas fa-eye"></i>
              <p>
                Audit Trail
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/audit" class="nav-link {{ Request::path() === 'audit' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>View Audit Trail</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/audit/select-dates" class="nav-link {{ Request::path() === 'audit/select-dates' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>View by Date</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/audit/users" class="nav-link {{ Request::path() === 'audit/users' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>View by User</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">

          <!-- Manager Links -->
          @elseif(Auth::user()->role->name == 'Manager' || Auth::user()->role->name == 'manager')

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::path() === 'items' ? 'active' : '' }}">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Items
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/items" class="nav-link {{ Request::path() === 'items/' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>View Items</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/history" class="nav-link {{ Request::path() === 'history' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>Item History</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/items/move-requests" class="nav-link {{ Request::path() === 'items/move-requests' ? 'active' : '' }}">
                  <i class="fas fa-exchange-alt"></i>
                  <p>Move Requests

                  @if($move_requests < 1)

                  @else
                  <span class="badge badge-info right">{{ $move_requests }}</span>
                  @endif
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/items/delete-requests" class="nav-link {{ Request::path() === 'items/delete-requests' ? 'active' : '' }}">
                  <i class="fas fa-trash-alt"></i>
                  <p>Delete Requests

                  @if($delete_requests < 1)

                  @else
                  <span class="badge badge-info right">{{ $delete_requests }}</span>
                  @endif
                  </p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item">
            <a href="/notifications" class="nav-link {{ Request::path() === 'notifications' ? 'active' : '' }}">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifications
                @if($notifications_count < 1)

                @else
                <span class="badge badge-info right">{{ $notifications_count }}</span>
                @endif
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/categories" class="nav-link {{ Request::path() === 'categories' ? 'active' : '' }}">
              <i class="fas fa-layer-group"></i>
              <p>
                Category
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/locations" class="nav-link {{ Request::path() === 'locations' ? 'active' : '' }}">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Location
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/states" class="nav-link {{ Request::path() === 'states' ? 'active' : '' }}">
              <i class="nav-icon fas fa-balance-scale-right"></i>
              <p>
                States
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/rates" class="nav-link {{ Request::path() === 'rates' ? 'active' : '' }}">
              <i class="fas fa-money-bill-wave"></i>
              <p>
                Exchange Rates
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/printers" class="nav-link {{ Request::path() === 'printers' ? 'active' : '' }}">
              <i class="fas fa-print"></i>
              <p>
                Printers
              </p>
            </a>
          </li>          
<!-- 

          <li class="nav-header">Miscellaneous</li>

          <li class="nav-item">
            <a href="/locations" class="nav-link {{ Request::path() === 'locations' ? 'active' : '' }}">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Location
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/states" class="nav-link {{ Request::path() === 'states' ? 'active' : '' }}">
              <i class="nav-icon fas fa-balance-scale-right"></i>
              <p>
                States
              </p>
            </a>
          </li> -->

          <!-- Clerk Links -->
          @elseif(Auth::user()->role->name == 'Clerk' || Auth::user()->role->name == 'clerk')
          
          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::path() === 'items' ? 'active' : '' }}">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Items
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             

              <li class="nav-item">
                <a href="/items/add-item" class="nav-link {{ Request::path() === 'items/add-item' ? 'active' : '' }}">
                  <i class="fa fa-plus"></i>
                  <p>Add Item</p>
                </a>
              </li> 

              <li class="nav-item">
                <a href="/items" class="nav-link {{ Request::path() === 'items/' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>View Items</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/history" class="nav-link {{ Request::path() === 'history' ? 'active' : '' }}">
                  <i class="far fa-eye"></i>
                  <p>Item History</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/items/move-status" class="nav-link {{ Request::path() === 'items/move-status' ? 'active' : '' }}">
                  <i class="fas fa-exchange-alt"></i>
                  <p>Move Status</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/items/delete-status" class="nav-link {{ Request::path() === 'items/delete-status' ? 'active' : '' }}">
                  <i class="fas fa-trash-alt"></i>
                  <p>Delete Status</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="/rates" class="nav-link {{ Request::path() === 'rates' ? 'active' : '' }}">
              <i class="fas fa-money-bill-wave"></i>
              <p>
                Exchange Rates
              </p>
            </a>
          </li>

          @endif


<!--           <div class="row bottom">
          <div class="nav-link" aria-labelledby="navbarDropdown">
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                               <i class="nav-icon far fa-circle text-danger"></i>
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
          </div>
 -->
          <style type="text/css">
            .bottom{

              position: relative;


            }
          </style>

          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>&copy; <?php echo date('Y'); ?> <a href="https://www.sparcsystems.africa/">Sparc Systems</a></strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 400000000);
  </script>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->


<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>


<!-- DataTables  & Plugins -->
<script src="{{ asset('js/alertify.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>