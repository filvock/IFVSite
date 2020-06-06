@extends('admin.layout.index')

@section('content')
     <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                  <h3  style="font-size:3.5vmax;">Locais</h3>
                  <p style="font-size:1vmax;">Relatório Igreja Local</p>
              </div>
              <div class="icon">
                  <i class="fas fa-chart-bar"></i>
              </div>
              <a href="{{route('admin.relatorios.locais.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- small box -->
          <div class="col-lg-3 col-xs-6">        
            <div class="small-box bg-teal">
                  <div class="inner">                    
                      <h3 style="font-size:3.5vmax;">Gerenciais</h3>                           
                      <p style="font-size:1vmax;">Relatórios Nacionais</p>
                  </div> 
                      <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                      </div>
                      <a href="{{route('admin.relatorios.gerenciais.index')}}" class="small-box-footer">Gerar Relatório <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
          
          
          
        
      <!-- /.row (main row) -->
      </div>
    </section>
    <!-- /.content -->

 
@endsection