@extends('admin.layout.index')

@section('content')
<div class="box">
    <div class="box-header">
        <h2>Excluir ou Editar lançamentos</h2>
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
                @foreach($tesouraria as $lancamento)
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
                      <a href='/delete/{{$lancamento->CodLancamento}}' class="btn btn-danger" onclick="return confirm('Remover Registro?')"><i class="fa fa-trash"></i></a>                      
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
                
              </table>
            </div>
    </div>
</div>

<script>
(function($){ 
	$(function(){
		// Define your currency field(s)
		var currency_input = $('input.currency');
		// Check the document for currency field(s)
		if ( currency_input.length > 0 ){
			// Format the currency field when a user clicks or tabs outside of the input
			currency_input.blur(function(){
				$(this).formatCurrency();
			});
		}
	});
});    
    
    
</script>
@endsection