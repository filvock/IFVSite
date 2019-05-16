<header class="main-header">
    <!-- Logo -->
    <a href="{{route('admin.index')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>IFV</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Tesouraria</b>IFV</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="user-footer">
                <div class="pull-right">
                    <h6> </h6>
                    <a href="#" class="btn btn-facebook" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{$user->name}} - Sair</a>
                </div>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: nome;">
                    @csrf
                </form>
            </li>
            
            
            
            <!--
            
            
            <h6> </h6>
            <input type="submit" id="logout-form" class="btn btn-facebook" action="{{route('logout')}}" method="POST" value="{{$user->name}} - Sair" />            
            </input>
            @csrf
            
            
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs">{{$user->name}}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                        <h2> <font color="white">{{$user->name}} - Usuário </font></h2>
                        <h4><font color="white"> Usuário {{$user->created_at->diffForHumans()}}</font></h4>                
                    </li>              
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-primary btn-flat">Perfil</a>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn btn-danger btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                        </div>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: nome;">
                            @csrf
                        </form>
                    </li>
                 </ul>
            </li>          
            <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>-->
        </ul>
      </div>
    </nav>
  </header>
 