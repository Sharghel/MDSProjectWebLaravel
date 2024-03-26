<!DOCTYPE html>
<html lang="en">
@include('layout.head')
  <body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
      @include('layout.header')
      @include('layout.aside')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('main')
    </div>
      @include('layout.footer')
  </div>
  <!-- ./wrapper -->
  @include('layout.scripts')
  @yield('scripts')
</body>
</html>
