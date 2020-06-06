@extends('admin.layout.index')

@section('content')
<div class="box">
    <div class="box-header">
        <h2>Relatório Totais de Entrada e Saída</h2>
    </div>
    <a href="{{url ('admin/relatorios/locais/totais/pdf')}}" class="btn btn-success">Converter para PDF<i class="fa fa-arrow-circle-right"></i></a>
    <div class="box-body">
      <div class="box-body table-responsive no-padding">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                      <th>Natureza</th>
                      <th>Valor</th>
                   </tr>
                </thead>
                <tr>
                  <td>Crédito</td>
                  <td>R$ {{$totalEntrada}}</td>
                </tr>                
                  <td>Débito</td>
                  <td><font color="red"> R$ {{$totalSaida}}</font></td>
                </tr>                
                  <th>Totais</th>
                  @if($negativo=1)
                  <th><font color="red"> R$ {{$saldo}} </font></th>
                  @else
                  <th>R$ {{$saldo}} </th>
                  @endif
                  <th></th>                                    
                  <th></th>                                    
                </tr>
                
              </table>
            <a href="{{url ('admin/relatorios/locais/totais/pdf')}}" class="btn btn-success">Converter para PDF<i class="fa fa-arrow-circle-right"></i></a>
            </div>
    </div>
</div>

@endsection