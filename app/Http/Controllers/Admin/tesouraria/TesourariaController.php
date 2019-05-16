<?php

namespace App\Http\Controllers\Admin\tesouraria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TesourariaGeral;
use App\Models\PlanoDeContasCredito;
use App\Models\PlanoDeContasDebito;
use App\Models\Usuarios;

class TesourariaController extends Controller
{
    public $request;
    public $users;
    public $tesouraria;
    public $contascredito;
    public $contasdebito;
    public $igreja;
    
    public function __construct(Request $request, User $users, TesourariaGeral $tesourariaAll, PlanoDeContasCredito $contascredito, PlanoDeContasDebito $contasdebito)
    {    
        $this->request = $request;
        $this->users = $users;
        $this->contascredito = $contascredito;
        $this->contasdebito = $contasdebito;
        $this->tesouraria = $tesourariaAll;
        
        
    }

    public function index()
    {
        $user = Auth()->User();
        return view('admin.tesouraria.index', compact('user'));
    }
    
    public function viewTesouraria()
    {
        $user = Auth()->User();
        
        $uri = ($this->request->route()->uri());
        
        return view('admin.tesouraria.index', compact('user', 'uri'));
    }
    
     public function viewTesourariaEntradas()
    {
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
         
        $contascredito = $this->contascredito->all();
        
        return view('admin.tesouraria.entradas.index', compact('user', 'uri', 'contascredito'));
    }
    
    public function viewTesourariaSaidas()
    {
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
                
        $contasdebito = $this->contasdebito->all();
        
        return view('admin.tesouraria.saidas.index', compact('user', 'uri','contasdebito'));
    }
    
    public function viewTesourariaTransferencias()
    {
        $user = Auth()->User();
        
        $uri = ($this->request->route()->uri());
       
        return view('admin.tesouraria.transferencias.index', compact('user', 'uri'));
    }
    
    public function viewTesourariaExcluir()
    {
        $user = Auth()->User();
        
        $uri = ($this->request->route()->uri());
        
        return view('admin.tesouraria.excluir.index', compact('user', 'uri'));
    }
    
    public function CriarRelatorio(Request $request)
    {        
        $user = Auth()->User();        
        $uri = ($this->request->route()->uri());
        
        $tesouraria = $this->tesouraria->whereBetween('Data', [$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
        
        //dd($tesouraria);
        
        session_start();
        $_SESSION["dataInicio"] = $request->dataInicio ;
        $_SESSION["dataFim"] = $request->dataFim ;        
        
        return view('admin.tesouraria.excluir.relatorio', compact('user', 'uri','tesouraria'));
    }
    
    public function delete($id)
    {
        $user = Auth()->User();        
        $uri = ($this->request->route()->uri());
        $exploder = explode("/", $uri);
        $uriAtual = $exploder[1];
        
        $item = $this->tesouraria->where('CodLancamento', '=', $id)->first();

        $item->delete();
       
        session_start();
        
        $tesouraria = $this->tesouraria->whereBetween('Data', [$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
                
        return view('admin.tesouraria.excluir.relatorio', compact('user', 'uriAtual','tesouraria'));
    }
    
    
    public function NovaEntrada(Request $request)
    {
        $entradacaixa = new TesourariaGeral;
        $entradabanco = new TesourariaGeral;
        
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        $contascredito = $this->contascredito->all();
        
        //dd($contascredito->find($request->conta_id)->Descricao);
        if($request->valuecaixa){
            $entradacaixa->Data = $request->data;
            $entradacaixa->NumDocumento = $request->numDoc;
            $entradacaixa->Descricao = $request->desc;
            $entradacaixa->Conta = $contascredito->find($request->conta_id)->Descricao;
            $entradacaixa->Igreja = $user->user_igreja;
            $entradacaixa->Valor = str_replace(',','.',str_replace('.','',$request->valuecaixa));
            $entradacaixa->Origem = 'Caixa';
            $entradacaixa->Natureza = 'Crédito';
            $entradacaixa->Usuario = Auth()->User()->email;
            $entradacaixa->DataLanc = date('y-m-d H:i:s');
            $entradacaixa->Obs = $request->obs;
           
            $entradacaixa->save();
            
        }
        if($request->valuebanco){
            $entradabanco->Data = $request->data;
            $entradabanco->NumDocumento = $request->numDoc;
            $entradabanco->Descricao = $request->desc;
            $entradabanco->Conta = $contascredito->find($request->conta_id)->Descricao;
            $entradabanco->Igreja = $user->user_igreja;
            $entradabanco->Valor = str_replace(',','.',str_replace('.','',$request->valuebanco));
            $entradabanco->Origem = 'Banco';
            $entradabanco->Natureza = 'Crédito';
            $entradabanco->Usuario = Auth()->User()->email;
            $entradabanco->DataLanc = date('y-m-d H:i:s');
            $entradabanco->Obs = $request->obs;
            
            $entradabanco->save();
        }
        
  
        
        return view('admin.tesouraria.entradas.index', compact('user', 'uri','contascredito'));
    }
    public function NovaSaida(Request $request)
    {        
        $saidacaixa = new TesourariaGeral;
        $saidabanco = new TesourariaGeral;
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());                
        $contasdebito = $this->contasdebito->all();
        
        if($request->valuecaixa){
            $saidacaixa->Data = $request->data;
            $saidacaixa->NumDocumento = $request->numDoc;
            $saidacaixa->Descricao = $request->desc;
            $saidacaixa->Conta = $contasdebito->find($request->conta_id)->Descricao;
            $saidacaixa->Igreja = $user->user_igreja;
            $temp = str_replace(',','.',str_replace('.','',$request->valuecaixa));
            $saidacaixa->Valor = "-".$temp;
            $saidacaixa->Origem = 'Caixa';
            $saidacaixa->Natureza = 'Débito';
            $saidacaixa->Usuario = Auth()->User()->email;
            $saidacaixa->DataLanc = date('y-m-d H:i:s');
            $saidacaixa->Obs = $request->obs;
            
            //dd($saidacaixa);
            $saidacaixa->save();   
            
            
        }
        if($request->valuebanco){
            $saidabanco->Data = $request->data;
            $saidabanco->NumDocumento = $request->numDoc;
            $saidabanco->Descricao = $request->desc;
            $saidabanco->Conta = $contasdebito->find($request->conta_id)->Descricao;;
            $saidabanco->Igreja = $user->user_igreja;
            $temp = str_replace(',','.',str_replace('.','',$request->valuebanco));
            $saidabanco->Valor = "-".$temp;
            $saidabanco->Origem = 'Banco';
            $saidabanco->Natureza = 'Débito';
            $saidabanco->Usuario = Auth()->User()->email;
            $saidabanco->DataLanc = date('y-m-d H:i:s');
            $saidabanco->Obs = $request->obs;
            
            $saidabanco->save();
        }
                
        
        
        return view('admin.tesouraria.saidas.index', compact('user', 'uri','contasdebito'));
    }
    
    public function Transferencias(Request $request)
    {        
        $saidacaixa = new TesourariaGeral;
        $saidabanco = new TesourariaGeral;
        $entradacaixa = new TesourariaGeral;
        $entradabanco = new TesourariaGeral;
        $user = Auth()->User();
        $uri = ($this->request->route()->uri()); 
        
        if($request->valuecaixabanco){
            $saidacaixa->Data = $request->data;
            $saidacaixa->NumDocumento = "";
            $saidacaixa->Descricao = "Transferência Caixa para Banco";
            $saidacaixa->Conta = "Transferência Caixa/Banco";
            $saidacaixa->Igreja = $user->user_igreja;
            $temp = str_replace(',','.',str_replace('.','',$request->valuecaixabanco));
            $saidacaixa->Valor = "-".$temp;
            $saidacaixa->Origem = 'Caixa';
            $saidacaixa->Natureza = 'Débito';
            $saidacaixa->Usuario = Auth()->User()->email;
            $saidacaixa->DataLanc = date('y-m-d H:i:s');
            $saidacaixa->Obs = "";
                     
            //dd($user);
            $saidacaixa->save();  
            
            $entradabanco->Data = $request->data;
            $entradabanco->NumDocumento = "";
            $entradabanco->Descricao = "Transferência Caixa para Banco";
            $entradabanco->Conta = "Transferência Caixa/Banco";
            $entradabanco->Igreja = $user->user_igreja;
            $entradabanco->Valor = str_replace(',','.',$request->valuecaixabanco);
            $entradabanco->Origem = 'Banco';
            $entradabanco->Natureza = 'Crédito';
            $entradabanco->Usuario = Auth()->User()->email;
            $entradabanco->DataLanc = date('y-m-d H:i:s');
            $entradabanco->Obs = "";
            
            $entradabanco->save();
        }
                
        if($request->valuebancocaixa){
            $saidabanco->Data = $request->data;
            $saidabanco->NumDocumento = "";
            $saidabanco->Descricao = "Transferência Banco para Caixa";
            $saidabanco->Conta = "Transferência Banco/Caixa";
            $saidabanco->Igreja = $user->user_igreja;
            $temp = str_replace(',','.',str_replace('.','',$request->valuebancocaixa));
            $saidabanco->Valor = "-".$temp;
            $saidabanco->Origem = 'Banco';
            $saidabanco->Natureza = 'Débito';
            $saidabanco->Usuario = Auth()->User()->email;
            $saidabanco->DataLanc = date('y-m-d H:i:s');
            $saidabanco->Obs = "";
            
          
            $saidabanco->save();  
            
          
            $entradacaixa->Data = $request->data;
            $entradacaixa->NumDocumento = "";
            $entradacaixa->Descricao = "Transferência Banco para Caixa";
            $entradacaixa->Conta = "Transferência Banco/Caixa";
            $entradacaixa->Igreja = $user->user_igreja;
            $entradacaixa->Valor = str_replace(',','.',$request->valuebancocaixa);
            $entradacaixa->Origem = 'Caixa';
            $entradacaixa->Natureza = 'Crédito';
            $entradacaixa->Usuario = Auth()->User()->email;
            $entradacaixa->DataLanc = date('y-m-d H:i:s');
            $entradacaixa->Obs = "";
            
            $entradacaixa->save();
        }
        return view('admin.tesouraria.transferencias.index', compact('user', 'uri'));
    }
     
    
    public function Excluir(Request $request)
    {
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        
        $dadosRelatorio = $this->tesouraria->whereBetween('Data',[$request->dataInicio, $request->dataFim])->get();
        
        for ($j=0; $j<count($dadosRelatorio); $j++){            
            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');
            
        }
        
        return view('admin.tesouraria.editar.relatorio', compact('user', 'uri', 'dadosRelatorio'));
    }
    
    
    
}
