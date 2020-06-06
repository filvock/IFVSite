<?php

namespace App\Http\Controllers\Admin\relatorioslocais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TesourariaGeral;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class RelatoriosContasTotalController extends Controller
{
    public $request;
    public $usuarios;
    public $tesouraria;
    
    public function __construct(Request $request, User $usuarios, TesourariaGeral $tesourariaAll)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->tesouraria = $tesourariaAll;
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        
        return view('Admin.relatorios.locais.contastotal.index', compact('user', 'uri'));
    }
    
 
    public function GeraLivroPCTotal(Request $request)
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        
        session_start();
        $_SESSION["dataInicio"] = $request->dataInicio ;
        $_SESSION["dataFim"] = $request->dataFim ;
        

        $dadosRelatorio = $this->tesouraria->whereBetween('Data',[$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
           

        $contasdebito = $this->tesouraria->select('Conta', 'Valor')->whereBetween('Data',[$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->where('Natureza', 'Débito')->get()->toarray();

        $contascredito = $this->tesouraria->select('Conta', 'Valor')->whereBetween('Data',[$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->where('Natureza', 'Crédito')->get()->toarray();

      
        $contasdebito = collect($contasdebito)->groupby('Conta');
        $contascredito = collect($contascredito)->groupby('Conta');
        
        $contasEntradas = collect();
        $contasSaidas = collect();
            
        $totalEntrada = 0;
        $totalSaida = 0;
            //dd($contascredito); 

        foreach ($contascredito as $item){
            $item = $item->toarray();
            //$total = array_sum($item('Valor')->number());
            $total = 0;


            for ($j=0; $j<count($item); $j++){            
                $total = $total + $item[$j]['Valor'];
            }
            $totalEntrada = $totalEntrada + $total;
            $contasEntradas->push([$item[0]['Conta'], number_format($total,  2, ',', '.')]);

          //  $contasEntradas = array_add($contasEntradas, $item[0]['Conta'], number_format($total,  2, ',', '.'));
             
//            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');          
        }


        foreach ($contasdebito as $item){
            $item = $item->toarray();
            //$total = array_sum($item('Valor')->number());
            $total = 0;


            for ($j=0; $j<count($item); $j++){            
                $total = $total + $item[$j]['Valor'];
            }
            $totalSaida = $totalSaida + $total;
            $contasSaidas->push([$item[0]['Conta'], number_format($total,  2, ',', '.')]);
             
        }

        $totalEntrada = number_format($totalEntrada,  2, ',', '.');
        $totalSaida = number_format($totalSaida,  2, ',', '.');

        $contasEntradas = $contasEntradas->sort();
        $contasSaidas = $contasSaidas->sort();


        //dd($contasEntradas);
        
        return view('Admin.relatorios.locais.contastotal.relatorio', compact('user', 'uri', 'contasEntradas','contasSaidas', 'totalSaida', 'totalEntrada'));
    }
    
    public function GeraPDFLivroPCTotal(Request $request)
    {   
        $pdf = new Dompdf();
        $data = $this->ConvertHtmlPdfLivroPCTotal();
        $pdf->loadHTML($data);
        $font = $pdf->getFontMetrics()->getFont("Arial", "bold");
        $pdf->get_canvas()->page_text(510, 18, "Pág {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0, 0, 0));
        $pdf->render();
        return $pdf->stream();       
    }
    
    public function ConvertHtmlPdfLivroPCTotal()
    {               
        $user = Auth()->User();        
        session_start();


      
        $dadosRelatorio = $this->tesouraria->whereBetween('Data',[$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
           

        $contasdebito = $this->tesouraria->select('Conta', 'Valor')->whereBetween('Data',[$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->where('Natureza', 'Débito')->get()->toarray();

        $contascredito = $this->tesouraria->select('Conta', 'Valor')->whereBetween('Data',[$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->where('Natureza', 'Crédito')->get()->toarray();

      
        $contasdebito = collect($contasdebito)->groupby('Conta');
        $contascredito = collect($contascredito)->groupby('Conta');
        
        $contasEntradas = collect();
        $contasSaidas = collect();
            
        $totalEntrada = 0;
        $totalSaida = 0;
            //dd($contascredito); 

        foreach ($contascredito as $item){
            $item = $item->toarray();
            //$total = array_sum($item('Valor')->number());
            $total = 0;


            for ($j=0; $j<count($item); $j++){            
                $total = $total + $item[$j]['Valor'];
            }
            $totalEntrada = $totalEntrada + $total;
            $contasEntradas->push([$item[0]['Conta'], number_format($total,  2, ',', '.')]);

          //  $contasEntradas = array_add($contasEntradas, $item[0]['Conta'], number_format($total,  2, ',', '.'));
             
//            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');          
        }


        foreach ($contasdebito as $item){
            $item = $item->toarray();
            //$total = array_sum($item('Valor')->number());
            $total = 0;


            for ($j=0; $j<count($item); $j++){            
                $total = $total + $item[$j]['Valor'];
            }
            $totalSaida = $totalSaida + $total;
            $contasSaidas->push([$item[0]['Conta'], number_format($total,  2, ',', '.')]);
             

        }

        $saldo = $totalEntrada + $totalSaida;
        $totalEntrada = number_format($totalEntrada,  2, ',', '.');
        $totalSaida = number_format($totalSaida,  2, ',', '.');
        $saldo = number_format($saldo,  2, ',', '.');


        $contasEntradas = $contasEntradas->sort();
        $contasSaidas = $contasSaidas->sort();
        
        $output = '<html><head>
        <style type="text/css">
       @page {
            margin-top: 100px;
            margin-bottom: 60px;
            margin-right: 30px;
            margin-left: 0px;
        }
        #head{
            font-size: 25px;
            text-align: center;
            height: 110px;
            width: 100%;
            position: fixed;
            top: -100px;
            left: 0;
            right: 0;
            margin: auto;
        }
        #corpo{
            width: 600px;
            position: relative;
            margin: auto;
        }
        table{
            width: 100%;
            position: relative;
        }
        td{
            padding: 3px;
            cellspacing: 0.1px;
        }
        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            border-top: 1px solid gray;
        }
        #footer .page:after{ 
            content: counter(page); 
        }
        </style></head><body>
    
        <div id="head" ><br />Relatório Plano de Contas - Totais - '.$user->user_igreja.' <br />
            De '.date('d-m-y', strtotime($_SESSION["dataInicio"])).' à '.date('d-m-y', strtotime($_SESSION["dataFim"])).'
                </div>
           <div id="corpo">
            <table border="1" cellspacing=0.1 page-break-inside: auto;>
                 <thead>
                    <tr>
                      <th colspan="2" align="center">Crédito</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                      <th align="center">Conta</th>
                      <th align="center">Valor</th>                      
                    </tr>
                </thead>
                   ';
        
        foreach ($contasEntradas as $linha){
            $output .= '
                <tr>
                  <td width="130">'.$linha[0].'</td>
                  <td align="center" width="130">R$ '.$linha[1].'</td>
                </tr>';                  
        }
        
        $output .= '
                <tr>
                    <th colspan="1" align="center">Total</th>
                    <th align="center">R$ '.$totalEntrada.'</th>                    
                </tr>  

                <thead>
                    <tr>
                      <th colspan="2" align="center">Débito</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                      <th align="center">Conta</th>
                      <th align="center">Valor</th>                      
                    </tr>
                </thead>
                   ';
        
        foreach ($contasSaidas as $linha){
            $output .= '
                <tr>
                  <td width="130">'.$linha[0].'</td>
                  <td align="center" width="130"> <font color="red"> R$ '.$linha[1].'</font></td>
                </tr>';                  
        }
        
        $output .= '
                <tr>
                    <th colspan="1" align="center">Total</th>
                    <th align="center"><font color="red"> R$ '.$totalSaida.'</font></th>                    
                </tr>
        
                <tr>
                    <th align="center">DIFERENÇA ENTRADAS/SAÍDAS</th>';
                    if($saldo<0){$output .= '<th align="center"> <font color="red">R$ '.$saldo.'</font></th></tr></table>';}
                    else {$output .= '<th align="center"> R$ '.$saldo.'</th></tr></table>';}  
        
        return $output;
    }
}
