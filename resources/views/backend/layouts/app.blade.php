<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POS</title>

  @include('backend.layouts.assets.css')
  @stack('css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  @include('backend.layouts.header')

  @include('backend.layouts.sidebar')

  @yield('content')
  @if(session()->has('success'))
  <script type="text/javascript">
     $(function(){
        $.notify("{{session()->get('success')}}",{globalPosition:'top right',className:'success'})
     });
  </script>
  @endif
   @if(session()->has('error'))
  <script type="text/javascript">
     $(function(){
        $.notify("{{session()->get('error')}}",{globalPosition:'top right',className:'error'})
     });
  </script>
  @endif

  @include('backend.layouts.footer')


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('backend.layouts.assets.js')
@stack('js')
</body>
</html>
