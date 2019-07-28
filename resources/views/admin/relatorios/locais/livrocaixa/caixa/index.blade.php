@extends('admin.layout.index')

@section('content')
<div class="box">
    <div class="box-header">
        <h2>Relatório Livro Caixa</h2>
    </div>

    <div class="box-body">
        <form method="POST" action="{{action('Admin\relatorios\RelatoriosCaixaController@GeraLivroCaixa')}}" name="dados" onSubmit="return enviardados();">
            {!! csrf_field() !!}
            <div class="form-group">
                <h4>Período do Relatório</h4>
                <h5>Início</h5>
                <input type="date" name="dataInicio" placeholder="Data de Início">
                <h5>Fim</h5>
                <input type="date" name="dataFim" placeholder="Data de Fim">
                

            <div class="form-group">
                <br />
                <button type="submit" class="btn btn-success"> Gerar </button>
                <button type="reset" class="btn btn-warning"> Limpar </button>
            </div>

        </form>
    </div>
</div>
<script language="JavaScript" >
    function enviardados() {

        if (document.dados.dataInicio.value == "")
        {
            alert("Por favor, preencha campo Data de Início");
            document.dados.data.focus();
            return false;
        }


        if (document.dados.dataFim.value == "")
        {
            alert("Por favor, preencha campo Data de Fim");
            document.dados.desc.focus();
            return false;
        }

        
        return true;
    }

</script>
@endsection