@extends('admin.layout.index')

@section('content')
<div class="box">
    <div class="box-header">
        <h2>Relatório Livro Caixa</h2>
    </div>
    <div class="box-body">
      <div class="box-body table-responsive no-padding">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                      <th>Data</th>
                      <th>Descrição</th>
                      <th>Entrada</th>
                      <th>Saída</th>
                      <th>Conta</th>                                  
                   </tr>
                </thead>
                @foreach($dadosRelatorio as $lancamento)
                <tr>
                  <td>{{$lancamento->Data}}</td>
                  <td>{{$lancamento->Descricao}}</td>
                  @if ($lancamento->Valor > 0)
                    <td>R$ {{$lancamento->Valor}}</td>
                    <td></td>
                  @else
                    <td></td>
                    <td><font color="red"> R$ {{$lancamento->Valor}}</font></td>
                  @endif                  
                  <td>{{$lancamento->Conta}}</td>
                  <td>
                      <a class="btn btn-warning"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>                
                @endforeach
                <tr>
                  <th>Data</th>
                  <th>Descrição</th>
                  <th>Entrada</th>
                  <th>Saída</th>
                  <th>Conta</th>                  
                  <th>Ação</th>                                    
                </tr>
                <tr>                  
                    <td></td>
                </tr>
                <tr>
                  <th></th>
                  <th>Totais</th>
                  <th>R$ {{$totalEntradas}}</th>
                  <th><font color="red"> R$ {{$totalSaidas}} </font></th>
                  <th></th>                                    
                  <th></th>                                    
                </tr>
                
              </table>
            </div>
    </div>
</div>

@endsection