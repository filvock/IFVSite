@extends('admin.layout.index')

@section('content')
     <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                  <h3 style="font-size:3.5vmax;">Caixa</h3>
                  <p style="font-size:1vmax;">Relatório do Caixa</p>
              </div>
              <div class="icon">
                  <i class="far fa-chart-bar"></i>
              </div>
              <a href="{{route('admin.relatorios.locais.livrocaixa.caixa.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- small box -->
          <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                  <div class="inner">                    
                      <h3 style="font-size:3.5vmax;">Banco</h3>                           
                      <p style="font-size:1vmax;">Relatório do Banco</p>
                  </div> 
                      <div class="icon">
                  <i class="far fa-chart-bar"></i>
                      </div>
                      <a href="{{route('admin.relatorios.locais.livrocaixa.banco.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
          
          
          
          <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                  <div class="inner">                    
                      <h3 style="font-size:3vmax;">Caixa/Banco</h3>                    
                      <p style="font-size:1vmax;">Relatório de Caixa e Banco</p>
                  </div> 
                      <div class="icon">
                  <i class="far fa-chart-bar"></i>
                      </div>
                      <a href="{{route('admin.relatorios.locais.livrocaixa.caixabanco.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
        
      <!-- /.row (main row) -->
      </div>
    </section>
    <!-- /.content -->

 
@endsection