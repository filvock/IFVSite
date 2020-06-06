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
                  <p style="font-size:1vmax;">Relatório de Livro Caixa</p>
              </div>
              <div class="icon">
                  <i class="fas fa-dollar"></i>
              </div>
              <a href="{{route('admin.relatorios.locais.livrocaixa.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- small box -->
          <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                  <div class="inner">                    
                      <h3 style="font-size:3.5vmax;">Contas-Tot.</h3>                           
                      <p style="font-size:1vmax;">Relatório de Plano de Contas</p>
                  </div> 
                      <div class="icon">
                  <i class="fas fa-dollar"></i>
                      </div>
                      <a href="{{route('admin.relatorios.locais.contastotal.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
          
          
          
          <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                  <div class="inner">                    
                      <h3 style="font-size:3.4vmax;">Contas-Det.</h3>                    
                      <p style="font-size:1vmax;">Relat. Plano de Contas detalhado</p>
                  </div> 
                      <div class="icon">
                          <i class="fa fa-align-left"></i>
                      </div>
                      <a href="{{route('admin.relatorios.locais.contasdetal.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
        
          <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                  <div class="inner">                    
                      <h3 style="font-size:3.5vmax;">Totais</h3>                        
                      <p style="font-size:1vmax;">Relatório totais de entradas e saídas</p>
                  </div> 
                      <div class="icon">
                          <i class="fa fa-columns"></i>
                      </div>
                      <a href="{{route('admin.relatorios.locais.totais.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
        
      <!-- /.row (main row) -->
      </div>
    </section>
    <!-- /.content -->

 
@endsection