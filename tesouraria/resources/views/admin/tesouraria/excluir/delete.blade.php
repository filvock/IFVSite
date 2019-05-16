\@extends('admin.layout.index')


@section('content')

<script type="text/javascript">

        function BlockKeybord()
        {
            if(window.event) // IE
            {
                if((event.keyCode < 48) || (event.keyCode > 57))
                {
                    event.returnValue = false;
                }
            }
            else if(e.which) // Netscape/Firefox/Opera
            {
                if((event.which < 48) || (event.which > 57))
                {
                    event.returnValue = false;
                }
            }


        }

        function troca(str,strsai,strentra)
        {
            while(str.indexOf(strsai)>-1)
            {
                str = str.replace(strsai,strentra);
            }
            return str;
        }

        function FormataMoeda(campo,tammax,teclapres,caracter)
        {
            if(teclapres == null || teclapres == "undefined")
            {
                var tecla = -1;
            }
            else
            {
                var tecla = teclapres.keyCode;
            }

            if(caracter == null || caracter == "undefined")
            {
                caracter = ".";
            }

            vr = campo.value;
            if(caracter != "")
            {
                vr = troca(vr,caracter,"");
            }
            vr = troca(vr,"/","");
            vr = troca(vr,",","");
            vr = troca(vr,".","");

            tam = vr.length;
            if(tecla > 0)
            {
                if(tam < tammax && tecla != 8)
                {
                    tam = vr.length + 1;
                }

                if(tecla == 8)
                {
                    tam = tam - 1;
                }
            }
            if(tecla == -1 || tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105)
            {
                if(tam <= 2)
                {
                    campo.value = vr;
                }
                if((tam > 2) && (tam <= 5))
                {
                    campo.value = vr.substr(0, tam - 2) + ',' + vr.substr(tam - 2, tam);
                }
                if((tam >= 6) && (tam <= 8))
                {
                    campo.value = vr.substr(0, tam - 5) + caracter + vr.substr(tam - 5, 3) + ',' + vr.substr(tam - 2, tam);
                }
                if((tam >= 9) && (tam <= 11))
                {
                    campo.value = vr.substr(0, tam - 8) + caracter + vr.substr(tam - 8, 3) + caracter + vr.substr(tam - 5, 3) + ',' + vr.substr(tam - 2, tam);
                }
                if((tam >= 12) && (tam <= 14))
                {
                    campo.value = vr.substr(0, tam - 11) + caracter + vr.substr(tam - 11, 3) + caracter + vr.substr(tam - 8, 3) + caracter + vr.substr(tam - 5, 3) + ',' + vr.substr(tam - 2, tam);
                }
                if((tam >= 15) && (tam <= 17))
                {
                    campo.value = vr.substr(0, tam - 14) + caracter + vr.substr(tam - 14, 3) + caracter + vr.substr(tam - 11, 3) + caracter + vr.substr(tam - 8, 3) + caracter + vr.substr(tam - 5, 3) + ',' + vr.substr(tam - 2, tam);
                }
            }
        }

        function maskKeyPress(objEvent)
        {
            var iKeyCode;

            if(window.event) // IE
            {
                iKeyCode = objEvent.keyCode;
                if(iKeyCode>=48 && iKeyCode<=57) return true;
                return false;
            }
            else if(e.which) // Netscape/Firefox/Opera
            {
                iKeyCode = objEvent.which;
                if(iKeyCode>=48 && iKeyCode<=57) return true;
                return false;
            }


        }
    </script>
    
    
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3">
      
      <div class="my-3">

        @if (isset($item))

          <h3 class="text-center">Editar Lançamento</h3>

          <form action="/delete/{{ $item->CodLancamento }}" method="POST">
            {{ csrf_field() }}

            {{ method_field('PUT') }}

            <div class="form-group">
                    <h5>Data</h5>
                    <input type="date" name="data" placeholder="Data" value="{{$item->Data}}">
                    <br />
                    <h5>Número do lançamento</h5>
                    <input type="text" name="numDoc" placeholder="Número do documento" value="{{$item->NumDocumento}}">
                    <h5>Descrição do lançamento</h5>
                    <input type="text" name="desc" size="50" placeholder="Descrição" value="{{$item->Descricao}}">
                    <br />
                    <h5>Plano de Contas</h5>
                    <input type="text" id="myCode" placeholder="Cod Plano Contas" onchange="setPlano()" >  <select name="conta_id" id="mySelect" onchange="setCod()">
                        @foreach($contascredito as $contacredito)
                        <option value="{{$contacredito->Codigo}}">
                            {{$contacredito->Descricao}}                            
                        </option>
                        @endforeach
                        <option value = "{{$item->Conta}}" selected >{{$item->Conta}}</option>
                    </select>
                    
                    <h5>Valor</h5>
                    @if ($item->Origem=="Caixa")
                        R$ <input type="Text" placeholder="Caixa" name="valuecaixa" size="10" maxlength="10" onkeydown="FormataMoeda(this,10,event)" onkeypress="return maskKeyPress(event)" value="{{number_format($item->Valor,2,',','.')}}" />
                    @else        
                        R$ <input type="Text" placeholder="Banco" name="valuebanco" size="10" maxlength="10" onkeydown="FormataMoeda(this,10,event)" onkeypress="return maskKeyPress(event)" value="{{number_format($item->Valor,2,',','.')}}" />
                    @endif
                    <h5>Observações</h5>
                    <input type="text" name="obs" size="50" placeholder="Observação" value="{{$item->Obs}}">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Remover Registro?');">Excluir</button>
                    <input type="button" value="Voltar" class="btn btn-success" onclick="history.back(-1)" />
                </div>
                    
            </form>
        </div>
        </form>
        @endif

      </div>

    </div>
  </div>
</div>


<script language="JavaScript" >
    function enviardados(){

    if(document.dados.data.value=="")
    {
    alert( "Por favor, preencha campo DATA" );
    document.dados.data.focus();
    return false;
    }


    if( document.dados.desc.value=="")
    {
    alert( "Por favor, preencha campo Descrição" );
    document.dados.desc.focus();
    return false;
    }

    if (document.dados.valuecaixa.value=="" && document.dados.valuebanco.value=="" )
    {
    alert( "Por favor, preencha um valor em Caixa ou Banco");
    document.dados.valuecaixa.focus();
    return false;
    }

    return true;
    }

</script>


<script language="JavaScript" >

    function setCod(){
        var x = document.getElementById("mySelect").value;
        document.getElementById("myCode").value = x;
    }
    
    function setPlano(){
        var x = document.getElementById("myCode").value;
        document.getElementById("mySelect").value = x;
    }
    
    function ConfirmDelete()
    {
          var x = confirm("Are you sure you want to delete?");
          if (x)
            return true;
          else
            return false;
        }
    }
    
    

</script>
@endsection