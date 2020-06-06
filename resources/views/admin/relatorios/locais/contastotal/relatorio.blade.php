@extends('admin.layout.index')

@section('content')
<div class="box">
    <div class="box-header">
        <h2>Relatório Plano de Contas - Totais</h2>
    </div>
    <a href="{{url ('admin/relatorios/locais/contastotal/pdf')}}" class="btn btn-success">Converter para PDF<i class="fa fa-arrow-circle-right"></i></a>
    <div class="box-body">
      <div class="box-body table-responsive no-padding">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th><h2><center>Créditos</center></h2></th>
                  </tr>
                <thead class="thead-dark">
                  <tr>
                      <th width="180">Conta</th>
                      <th width="80">Valor</th>
                   </tr>
                </thead>
                @foreach($contasEntradas as $lancamento)
                <tr>
                  <td>{{$lancamento[0]}}</td>
                  <td>R$ {{$lancamento[1]}}</td>
                </tr>                
                @endforeach
                  <th>Totais</th>
                  <th>R$ {{$totalEntrada}}</th>
                  <th></th>                                    
                  <th></th>                                    
                </tr>

                <thead class="thead-dark">
                  <tr>
                    <th><h2><center>Débitos</center></h2></th>
                  </tr>
                <thead class="thead-dark">
                  <tr>
                      <th>Conta</th>
                      <th>Valor</th>
                   </tr>
                </thead>
                @foreach($contasSaidas as $lancamento)
                <tr>
                  <td>{{$lancamento[0]}}</td>
                  <td><font color="red"> R$ {{$lancamento[1]}}</font></td>
                </tr>                
                @endforeach
                  <th>Totais</th>
                  <th><font color="red"> R$ {{$totalSaida}} </font></th>
                  <th></th>                                    
                  <th></th>                                    
                </tr>
                
              </table>
            <a href="{{url ('admin/relatorios/locais/contastotal/pdf')}}" class="btn btn-success">Converter para PDF<i class="fa fa-arrow-circle-right"></i></a>
            </div>
    </div>
</div>

@endsection