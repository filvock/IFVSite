
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel 
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <h3>{{$user->name}}</h3>
          <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a> 
        </div>
      </div> -->
      <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Lateral</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Painel de Controle</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{route('admin.index')}}"><i class="fa fa-home"></i> Principal </a></li>
            <li class="active"><a href="{{route('admin.sistema.index')}}"><i class="fa fa-wrench"></i> Sistema </a></li>
            <li class="active"><a href="{{route('admin.tesouraria.index')}}"><i class="fa fa-usd"></i> Tesouraria </a></li>
            <li class="active"><a href="{{route('admin.relatorios.index')}}"><i class="fa fa-line-chart"></i> Relatórios </a></li>
            <li class="active"><a href="{{route('admin.individual.index')}}"><i class="fa fa-users"></i> Individual </a></li>
          </ul>
        </li>
        
    </section>
    <!-- /.sidebar -->
  </aside>
