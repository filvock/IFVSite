@extends('admin.layout.index')

@section('content')
     <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                  <h3>Caixa</h3>
                  <p>Relatório de Livro Caixa</p>
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
                      <h3>Contas-Tot.</h3>                           
                      <p>Relatório de Plano de Contas</p>
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
                      <h3>Contas-Det.</h3>                    
                      <p>Rel. Plano de Contas detalhado</p>
                  </div> 
                      <div class="icon">
                          <i class="fa fa-align-left"></i>
                      </div>
                      <a href="{{route('admin.tesouraria.transferencias.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
        
          <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                  <div class="inner">                    
                      <h3>Totais</h3>                        
                      <p>Rel. totais de entradas e saídas</p>
                  </div> 
                      <div class="icon">
                          <i class="fa fa-columns"></i>
                      </div>
                      <a href="{{route('admin.tesouraria.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
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