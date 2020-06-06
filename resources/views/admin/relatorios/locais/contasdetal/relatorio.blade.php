@extends('admin.layout.index')

@section('content')

<div class="box">
    <div class="box-header">
        <h2>Relatório Plano de Contas - Detalhado</h2>
    </div>
    <a href="{{url ('admin/relatorios/locais/contasdetal/pdf')}}" class="btn btn-success">Converter para PDF<i class="fa fa-arrow-circle-right"></i></a>
    <div class="box-body">
      <div class="box-body table-responsive no-padding">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th><h2><center>Créditos</center></h2></th>
                  </tr>
                <thead class="thead-dark">
                  <tr>
                      <th width="80">Data</th>
                      <th width="150">Descricao</th>
                      <th width="80">Valor</th>
                   </tr>
                </thead>
                @foreach($contasEntradas as $lancamento)
                <tr>
                  <th><center>Conta - {{$lancamento[0]}}</center></th>
                </tr>
                      @foreach($contascredito[$lancamento[0]] as $conta)
                      <tr>
                          <td>{{$conta['Data']}}</td>                          
                          <td>{{$conta['Descricao']}}</td>
                          <td>R$ {{number_format($conta['Valor'],  2, ',', '.')}}</td>                          
                      </tr>

                      @endforeach
                  <tr>
                    <th colspan="3" align="right">TOTAL DA CONTA - R$ {{$lancamento[1]}}</th>
                  </tr>
                @endforeach
                  <th>Total soma das contas</th>
                  <th>R$ {{$totalEntrada}}</th>
                  <th></th>                                    
                  <th></th>                                    
                </tr>

                <thead class="thead-dark">
                  <tr>
                    <th><h2><center>Débitos</center></h2></th>
                  </tr>
                <thead class="thead-dark">
                  <thead class="thead-dark">
                  <tr>
                      <th>Data</th>
                      <th>Descricao</th>
                      <th>Valor</th>
                   </tr>
                </thead>
                @foreach($contasSaidas as $lancamento)
                <tr>
                  <th><center>Conta - {{$lancamento[0]}}</center></th>
                </tr>
                      @foreach($contasdebito[$lancamento[0]] as $conta)
                      <tr>
                          <td>{{$conta['Data']}}</td>                          
                          <td>{{$conta['Descricao']}}</td>
                          <td><font color="red">{{number_format($conta['Valor'],  2, ',', '.')}}</font></td>                          
                      </tr>

                      @endforeach
                  <tr>
                    <th colspan="3" align="right">TOTAL DA CONTA - <font color="red"> R$ {{$lancamento[1]}}</font></th>
                  </tr>
                @endforeach
                  <th align="right">Total soma das contas</th>
                  <th> <font color="red">R$ {{$totalSaida}}</font></th>
                  <th></th>                                    
                  <th></th>                                    
                </tr>
                
              </table>
            <a href="{{url ('admin/relatorios/locais/contasdetal/pdf')}}" class="btn btn-success">Converter para PDF<i class="fa fa-arrow-circle-right"></i></a>
            </div>
    </div>
</div>

@endsection