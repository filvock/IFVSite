@extends('admin.layout.index')

@section('content')
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabela de Usuários</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Data Criação</th>                  
                  <th>Ação</th>                                    
                </tr>
                @foreach($usuarios as $usuario)
                <tr>
                  <td>{{$usuario->id}}</td>
                  <td>{{$usuario->name}}</td>
                  <td>{{$usuario->email}}</td>
                  <td>{{$usuario->created_at->diffForHumans()}}</td>
                  <td>
                      <a class="btn btn-warning"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>                
                @endforeach
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Data Criação</th>                  
                  <th>Ação</th>                                    
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->

 
@endsection