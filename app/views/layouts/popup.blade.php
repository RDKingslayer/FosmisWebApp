<!DOCTYPE HTML>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="keywords" content="">
      <meta name="description" content="" >
      <meta name="generator" content="">
      <!-- CSS -->
      <link rel="shortcut icon" href="/img/Ruhuna.ico" />
      <link href="/css/login/bootstrap.min.css" rel="stylesheet">
      <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
      <link href="/css/login/bootstrap.min.css" rel="stylesheet">
      <link href="/css/styles.css" rel="stylesheet">
      <!-- Extra CSS -->
      @yield('css')

      <!-- JavaScript -->
      <script src="/js/jquery-2.1.1.min.js"></script>
      <script src="/js/bootstrap.min.js"></script>
   
      <!-- Extra JS -->
      @yield('js')
   </head>
      
   <body>


   <div class="container-fluid">
      <div class="row-fluid">
        @yield('content')
      </div>
   </div>

   <footer class="white navbar-fixed-bottom">
      <div class="span12">
         <!-- Add Content to Footer -->
         @yield('footer')
      </div>
   </footer>
   </body>
</html>

