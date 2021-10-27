@if (Auth::user()->role == "admin")
  <!doctype html>
  <html lang="en">
    <head>
      <base href="">
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
      
      <title>{{ $title ?? config('app.name') }}</title>
      
      {{-- Style --}}
      @stack('prepend-style')
      @include('includes.style')
      @stack('addon-style')
      
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
      
      {{-- header --}}
      @include('includes.header')
      
      {{-- sidebar --}}
      @include('includes.sidebar')

      {{-- navbar --}}
      @include('includes.navbar')

      <!--begin::Entry-->
			<div class="d-flex flex-column-fluid bg-gray">

        {{-- Page Content --}}
        @yield('content')

        
      </div>
			<!--end::Entry-->
      
      {{-- footer --}}
      @include('includes.footer')
      
      {{-- Script --}}
      @stack('prepend-script')
      @include('includes.script')
      @stack('addon-script')
    </body>
  </html>
@else
  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
      <title>{{ $title ?? config('app.name') }}</title>
      
      {{-- Style --}}
      @stack('prepend-style')
      @include('includes.style')
      @stack('addon-style')
      
    </head>
    <body>

      <!-- Page Wrapper -->
      <div id="wrapper">

        {{-- sidebar --}}
        @include('includes.sidebar')

        {{-- navbar --}}
        @include('includes.navbar')

        {{-- Page Content --}}
        @yield('content')

        {{-- footer --}}
        @include('includes.footer')

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
          </div>
        </div>
      </div>
    </div>

      {{-- Script --}}
      @stack('prepend-script')
      @include('includes.script')
      @stack('addon-script')
    </body>
  </html>
@endif