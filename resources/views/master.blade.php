<!DOCTYPE html>
<html lang="en">

<head>
  <title>Inventory - @yield('title')</title>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Chosen CSS Files -->
  <!-- <link href="{{asset('assets/chosen/docsupport/style.css')}}" rel="stylesheet" /> -->
  <link href="{{asset('assets/chosen/docsupport/prism.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/chosen/chosen.css')}}" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />

  
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="dark">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow | dark"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          AP
        </a>
        <a href="#" class="simple-text logo-normal">
          Admin Panel
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <!-- <li>
            <a href="./dashboard.html">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li> -->
          <!-- <li>
            <a href="/addCategory">
              <i class="now-ui-icons education_atom"></i>
              <p>Add Category</p>
            </a>
          </li> -->
          <li class="a">
            <a href="/inventoryCheck"> 
              <i class="now-ui-icons design_app"></i>
              <p>Inventory</p>
            </a>
          </li>
          <!-- <li>
            <a href="/viewProduct">
              <i class="now-ui-icons location_bookmark"></i>
              <p>View Stock</p>
            </a>
          </li>
          <li>
            <a href="/addRecipe">
              <i class="now-ui-icons education_atom"></i>
              <p>Add Recipe</p>
            </a>
          </li>
          <li>
            <a href="/viewRecipe">
              <i class="now-ui-icons location_bookmark"></i>
              <p>View Recipe</p>
            </a>
          </li> -->
          <!-- <li>
            <a href="/viewBarcode">
              <i class="now-ui-icons location_bookmark"></i>
              <p>Product Barcode</p>
            </a>
          </li> -->
          <!-- <li class="active ">
            <a href="/viewStockOpening">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Stock Opening</p>
            </a>
          </li> -->
          @can('view-count','Countsheet')
          <li class="a">
            <a href="/countsheet">
              <i class="now-ui-icons gestures_tap-01"></i>
              <p>Countsheet</p>
            </a>
          </li>
          @endcan
          @can('view-bulkprice','Bulk Price Editing')
          <li class="a">
            <a href="/viewBulk">
              <i class="now-ui-icons gestures_tap-01"></i>
              <p>Bulk Price Editing</p>
            </a>
          </li>
          @endcan
          <li class="a">
            <a href="/addCustVen">
              <i class="now-ui-icons education_agenda-bookmark"></i>
              <p>Create Accounts</p>
            </a>
          </li>
          <li class="a">
            <a href="/viewCustomer">
              <i class="now-ui-icons users_single-02"></i>
              <p>View Accounts</p>
            </a>
          </li>
          @can('add-sale','Sale Voucher')
          <li class="a">
            <a href="/saleForm">
              <i class="now-ui-icons files_single-copy-04"></i>
              <p>Sale Invoice</p>
            </a>
          </li>
          @endcan
          <li class="a">
            <a href="/viewSInvoice">
              <i class="now-ui-icons files_paper"></i>
              <p>View Sale Invioces</p>
            </a>
          </li>
          @can('add-cashin','Cash In')
          <li class="a">
            <a href="/addTransIn">
              <i class="now-ui-icons business_money-coins"></i>
              <p>Cash In</p>
            </a>
          </li>
          @endcan
          @can('add-cashin','Cash Out')
           <li class="a">
            <a href="/addTransOut">
              <i class="now-ui-icons business_money-coins"></i>
              <p>Cash Out</p>
            </a>
          </li>
          @endcan
          <li class="a">
            <a href="/viewTrans">
              <i class="now-ui-icons business_money-coins"></i>
              <p>View Transaction</p>
            </a>
          </li>
          <li class="a">
            <a href="/checkPoint">
              <i class="now-ui-icons objects_diamond"></i>
              <p>Customer / Vendor Ledger</p>
            </a>
          </li>
           <li class="a">
            <a href="/stockForm">
              <i class="now-ui-icons files_single-copy-04"></i>
              <p>Stock Form</p>
            </a>
          </li>
          @can('add-purchase','Purchase Voucher')
           <li class="a">
            <a href="/purchaseForm">
              <i class="now-ui-icons files_single-copy-04"></i>
              <p>Purchase Invoice</p>
            </a>
          </li>
          @endcan
          <li class="a">
            <a href="/viewPInvoice">
              <i class="now-ui-icons files_paper"></i>
              <p>View Purchase Invioces</p>
            </a>
          </li>
           <li class="a">
            <a href="/viewReorder">
              <i class="now-ui-icons files_box"></i>
              <p>Re-Order</p>
            </a>
          </li>
           <!-- <li>
            <a href="/reportCheckPoint">
              <i class="now-ui-icons business_chart-bar-32"></i>
              <p>Report</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#">@yield('prob')</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Report</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/cashinReport">Cashin Report</a>
                  <a class="dropdown-item" href="/cashoutReport">Cashout Report</a>
                  <a class="dropdown-item" href="/receivableReport">Receivable Report</a>
                  <a class="dropdown-item" href="/payableReport">Payable Report</a>
                  <a class="dropdown-item" href="/stockReport">Stock Report</a>
                  <a class="dropdown-item" href="/stockTrack">Stock Tracking Report</a>
                  <a class="dropdown-item" href="/dayendReport">Day End Report</a>
                  <a class="dropdown-item" href="/dayendDetailReport">Day End Detail Report</a>
                  <a class="dropdown-item" href="/palReport">Profit & Loss Report</a>
                </div>
              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/viewProfile">Profile</a>
                  <a class="dropdown-item" href="/addCompany">Company</a>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                  </form>
                </div>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="/viewUser">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li> -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>

      <div class="content">
        @yield('content')
      </div>


      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, All Rights Reserved | Developed By Arbaz Ehsan</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  
  <!-- Chart JS -->
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('assets/demo/demo.js')}}"></script>

  <!-- Chosen JS Files -->
  <!-- <script src="{{asset('assets/chosen/docsupport/jquery-3.2.1.min.js')}}"></script> -->
  <script src="{{asset('assets/chosen/chosen.jquery.js')}}"></script>
  <script src="{{asset('assets/chosen/docsupport/prism.js')}}"></script>
  <script src="{{asset('assets/chosen/docsupport/init.js')}}"></script>
  <script src="{{asset('assets/js/print.min.js')}}"></script>
</body>
</html>
@include('messages')

@yield('script')

