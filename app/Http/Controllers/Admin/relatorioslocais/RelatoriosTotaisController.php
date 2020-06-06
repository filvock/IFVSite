<?php

namespace App\Http\Controllers\Admin\relatorioslocais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TesourariaGeral;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class RelatoriosTotaisController extends Controller
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
        
        return view('Admin.relatorios.locais.totais.index', compact('user', 'uri'));
    }
    
 
    public function GeraLivroTotais(Request $request)
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        
        session_start();
        $_SESSION["dataInicio"] = $request->dataInicio ;
        $_SESSION["dataFim"] = $request->dataFim ;
        
        $contasdebito = $this->tesouraria->select('Valor')->whereBetween('Data',[$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->where('Natureza', 'Débito')->get()->toarray();

        $contascredito = $this->tesouraria->select('Valor')->whereBetween('Data',[$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->where('Natureza', 'Crédito')->get()->toarray();

        $totalEntrada = 0;
        $totalSaida = 0;
        

        foreach ($contascredito as $item){
            $totalEntrada = $totalEntrada + $item['Valor'];
        }

        foreach ($contasdebito as $item){
            $totalSaida = $totalSaida + $item['Valor'];
        }

        $saldo = $totalSaida + $totalEntrada;

        $negativo = 0;

        if($totalSaida>$totalEntrada)$negativo=1;

        $totalEntrada = number_format($totalEntrada,  2, ',', '.');
        $totalSaida = number_format($totalSaida,  2, ',', '.');
        $saldo = number_format($saldo,  2, ',', '.');

        return view('Admin.relatorios.locais.totais.relatorio', compact('user', 'uri', 'totalSaida', 'totalEntrada','negativo','saldo'));
    }
    
    public function GeraPDFLivroTotais(Request $request)
    {   
        $pdf = new Dompdf();
        $data = $this->ConvertHtmlPdfLivroTotais();
        $pdf->loadHTML($data);
        $font = $pdf->getFontMetrics()->getFont("Arial", "bold");
        $pdf->get_canvas()->page_text(510, 18, "Pág {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0, 0, 0));
        $pdf->render();
        return $pdf->stream();       
    }
    
    public function ConvertHtmlPdfLivroTotais()
    {               
        $user = Auth()->User();        
        session_start();


        $contasdebito = $this->tesouraria->select('Valor')->whereBetween('Data',[$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->where('Natureza', 'Débito')->get()->toarray();

        $contascredito = $this->tesouraria->select('Valor')->whereBetween('Data',[$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->where('Natureza', 'Crédito')->get()->toarray();

      

        $totalEntrada = 0;
        $totalSaida = 0;
        

        foreach ($contascredito as $item){
            $totalEntrada = $totalEntrada + $item['Valor'];
        }

        foreach ($contasdebito as $item){
            $totalSaida = $totalSaida + $item['Valor'];
        }

        $saldo = $totalSaida + $totalEntrada;

        $totalEntrada = number_format($totalEntrada,  2, ',', '.');
        $totalSaida = number_format($totalSaida,  2, ',', '.');

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
    
        <div id="head" ><br />Relatório Total de Entradas e Saídas - '.$user->user_igreja.' <br />
            De '.date('d-m-y', strtotime($_SESSION["dataInicio"])).' à '.date('d-m-y', strtotime($_SESSION["dataFim"])).'
                </div>
           <div id="corpo">
            <table border="1" cellspacing=0.1 page-break-inside: auto;>                 
                <thead>
                    <tr>
                      <th align="center">Natureza</th>
                      <th align="center">Valor</th>                      
                    </tr>
                </thead>
                   ';
        
        $output .= '
                <tr>
                    <th align="left">Crédito</th>
                    <th align="center">R$ '.$totalEntrada.'</th>                    
                </tr>  
                <tr>
                    <th align="left">Débito</th>
                    <th align="center">R$ '.$totalSaida.'</th>                    
                </tr>  
                <tr>
                    <th align="left">Total</th>';
                    if($saldo>0)$output .= '<th align="center">R$ '.number_format($saldo,  2, ',', '.').'</th>';
                    else $output .= '<th align="center"> <font color="red">R$ '.number_format($saldo,  2, ',', '.').'</font></th>';           
                $output .= '</tr>  

                </table>';
        
        return $output;
    }
}
