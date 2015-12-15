<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Brand - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    {!! HTML::style('styles/css/bootstrap.min.css') !!}

    {!! HTML::style('styles/css/dashboard.min.css') !!}
    <!-- Custom styles for this template -->
    {!! HTML::style('styles/css/dashboard.css') !!}
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

  </head>

  <body>

    @include('Defaults.Views.partials.header')

    <div class="container-fluid">      
      <div class="row">

        @include('Defaults.Views.partials.sidebar')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- Error notifications -->  
          @include('Defaults.Views.partials.callouts.notification')     
          <!-- Start of the page-specific content. -->
          @yield('content')
          <!-- End of the page-specific content. -->
        </div>      
    
    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    {!! HTML::script('styles/js/bootstrap.min.js') !!}

    @stack('scripts')
    
  </body>
</html>