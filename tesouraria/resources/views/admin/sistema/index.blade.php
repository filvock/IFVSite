@extends('admin.layout.index')

@section('content')
    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
                <h3>Cidades</h3>
                <p>Adicionar, remover cidades</p>
            </div>
            <div class="icon">
                <i class="fas fa-city"></i>
            </div>
            <a href="{{route('admin.sistema.cidades.index')}}" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- small box -->
        <div class="col-lg-3 col-xs-6">        
          <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3>Usuários</h3>
                    <p>Adicionar, remover usuarios</p>
                </div>            
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('admin.sistema.usuarios.index')}}" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        
        
        <div class="col-lg-3 col-xs-6">        
          <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3>igrejas   </h3>                    
                           
                <p>Adicionar, remover igrejas</p>
                </div>     
                <div class="icon">
                        <i class="fas fa-place-of-worship"></i>
                    </div>
                    <a href="{{route('admin.sistema.igrejas.index')}}" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
      
        <div class="col-lg-3 col-xs-6">        
          <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3>Contas</h3>
                           
                <p>Adicionar, remover contas</p>
                </div> 
                    <div class="icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <a href="{{route('admin.sistema.planoscontas.index')}}" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
      
        
        <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-olive">
                <div class="inner">
                    @inject('usuarios','App\Models\User')
                    <h3>{{$usuarios->count()}}</h3>
                </div>            
                <p>TESTE</p>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('admin.sistema.index')}}" class="small-box-footer">Novas Entradas<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
      
        
      
    <!-- /.row (main row) -->
    </div>
      

    </section>
    <!-- /.content -->

 
@endsection