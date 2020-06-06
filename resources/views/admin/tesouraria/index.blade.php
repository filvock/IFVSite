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
                <h3 style="font-size:3.5vmax;">Entradas</h3>
                <p style="font-size:1vmax;">Adicionar nova entrada</p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="{{route('admin.tesouraria.entradas.index')}}" class="small-box-footer">Nova Entrada <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- small box -->
        <div class="col-lg-3 col-xs-6">        
          <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3 style="font-size:3.5vmax;">Saídas</h3>                           
                    <p style="font-size:1vmax;">Adicionar nova saída</p>
                </div> 
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="{{route('admin.tesouraria.saidas.index')}}" class="small-box-footer">Nova Saída <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        
        
        <div class="col-lg-3 col-xs-6">        
          <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3 style="font-size:3.5vmax;">Transfer.</h3>                    
                    <p style="font-size:1vmax;">Transferir entre caixa e banco</p>
                </div> 
                    <div class="icon">
                        <i class="fas fa-arrows-alt-h"></i>
                    </div>
                    <a href="{{route('admin.tesouraria.transferencias.index')}}" class="small-box-footer">Nova Transferência<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
      
        <div class="col-lg-3 col-xs-6">        
          <div class="small-box bg-teal">
                <div class="inner">                    
                    <h3 style="font-size:3.5vmax;">Excluir</h3>                        
                    <p style="font-size:1vmax;">Excluir lançamentos</p>
                </div> 
                    <div class="icon">
                        <i class="fa fa-remove"></i>
                    </div>
                    <a href="{{route('admin.tesouraria.excluir.index')}}" class="small-box-footer">Excluir<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
      
        
      
    <!-- /.row (main row) -->
    </div>
      

    </section>
    <!-- /.content -->

 
@endsection