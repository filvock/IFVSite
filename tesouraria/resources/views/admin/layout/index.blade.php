<!DOCTYPE html>
<html>

@includeIf('admin.layout.head')

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    @includeIf('admin.layout.header')

    @includeIf('admin.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          TesourariaIFV - 
          {{$user->user_igreja}} - {{$user->user_role}}
          
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          TesourariaIFV
          @if(isset($uri))
            <li class="active">{{str_replace('/',' > ',$uri)}}</li>            
          @else
            <li class="active">Página Principal</li>
          @endif
        </ol>
      </section>

      @yield('content')

    </div>

    @includeIf('admin.layout.footer')
  </div>  

  @includeIf('admin.layout.javascript')

  
</body>
</html>
