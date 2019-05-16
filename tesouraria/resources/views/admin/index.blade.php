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
                <h3>Sistema</h3>
                <p>Usuários, contas...</p>
            </div>
            <div class="icon">
                <i class="fa fa-wrench"></i>
            </div>
            <a href="{{route('admin.sistema.index')}}" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- small box -->
        <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3>Tesouraria</h3>                
                    <p>Entradas, Saídas, Transferências</p>
                </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="{{route('admin.tesouraria.index')}}" class="small-box-footer">Novas Entradas <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3>Relatórios</h3>                           
                    <p>Livro Caixa, Plano de Contas</p>
                </div> 
                    <div class="icon">
                        <i class="fa fa-line-chart"></i>
                    </div>
                    <a href="{{route('admin.relatorios.index')}}" class="small-box-footer">Gerar Relatórios <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
      
        
        <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3>Individual   </h3>                                                
                    <p>Dízimos individuais</p>
                </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('admin.individual.index')}}" class="small-box-footer">Novas Entradas <i class="fa fa-arrow-circle-right"></i></a>
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