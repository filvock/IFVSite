<?php

namespace App\Http\Controllers\Admin\relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TesourariaGeral;
use PDF;
use Dompdf\Dompdf;

class RelatoriosCaixaController extends Controller
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

    public function index()
    {
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        
        return view('admin.relatorios.locais.livrocaixa.index', compact('user', 'uri'));
    }
        
    public function RelatorioLocal()
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        $usuarios =$this->usuarios->all();
        
        return view('admin.relatorios.locais.livrocaixa.index', compact('user', 'uri', 'usuarios'));
    }    
            /**
     * Relatórios de livro caixa
     *
     */
    
    public function GeraLivro()
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        $usuarios =$this->usuarios->all();
        
        return view('admin.relatorios.locais.livrocaixa.index', compact('user', 'uri', 'usuarios'));
    }
    
    public function GeraPaginaLivroCaixa(Request $request)
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        $usuarios =$this->usuarios->all();
        
        return view('admin.relatorios.locais.livrocaixa.caixa.index', compact('user', 'uri', 'usuarios')); 
    }
    
    public function GeraPDFLivroCaixa(Request $request)
    {   
        $pdf = new Dompdf();
        $data = $this->ConvertHtmlPdfLivroCaixa();
        $pdf->loadHTML($data);
        $font = $pdf->getFontMetrics()->getFont("Arial", "bold");
        $pdf->get_canvas()->page_text(510, 18, "Pág {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0, 0, 0));
        $pdf->render();
        return $pdf->stream();       
    }
    
    public function ConvertHtmlPdfLivroCaixa()
    {               
        $user = Auth()->User();        
        session_start();
        $dadosRelatorio = $this->tesouraria->where('Origem','=','Caixa')->whereBetween('Data', [$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
        $dadosTotal = $this->tesouraria->where('Origem','=','Caixa')->whereBetween('Data',['2014/01/01', $_SESSION["dataInicio"]])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();       
        
        $totalEntradas = 0;
        $totalSaidas = 0;
        $totalCaixa = 0;
        
        for ($j=0; $j<count($dadosTotal); $j++){            
            $totalCaixa = $totalCaixa + $dadosTotal[$j]->Valor;            
        }
                    
        for ($j=0; $j<count($dadosRelatorio); $j++){            
            if ($dadosRelatorio[$j]->Valor > 0){
                $totalEntradas = $totalEntradas + $dadosRelatorio[$j]->Valor;
            }
            else{
                $totalSaidas = $totalSaidas + $dadosRelatorio[$j]->Valor;
            }            
            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');
            
        }
        $diferenca = $totalSaidas + $totalEntradas;
        $saldoAtual = $diferenca + $totalCaixa;
        $totalSaidas = number_format($totalSaidas,  2, ',', '.');
        $totalEntradas = number_format($totalEntradas,  2, ',', '.');
        $totalCaixa = number_format($totalCaixa,  2, ',', '.');
        $diferenca = number_format($diferenca,  2, ',', '.');
        $saldoAtual = number_format($saldoAtual,  2, ',', '.');
        
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
    
        <div id="head" ><br />Relatório Livro Caixa - '.$user->user_igreja.' <br />
            De '.$_SESSION["dataInicio"].' à '.$_SESSION["dataFim"].'
                </div>
           <div id="corpo">
            <table border="1" cellspacing=0.1 page-break-inside: auto;>
                <thead>
                    <tr>
                      <th align="center">Data</th>
                      <th align="center">Descrição</th>
                      <th align="center">Entrada</th>
                      <th align="center">Saída</th>                      
                    </tr>
                </thead>
                   ';
        
        for ($j=0; $j<count($dadosRelatorio); $j++){
            $output .= '
                <tr>
                  <td width="60">'.$dadosRelatorio[$j]->Data.'</td>
                  <td width="200">'.$dadosRelatorio[$j]->Descricao.'</td>';
            if ($dadosRelatorio[$j]->Valor > 0)
                    $output .=' 
                    <td width="90" align="center">R$ '.$dadosRelatorio[$j]->Valor.'</td>
                    <td width="90" align="center"></td>';
            else
                    $output .='<td width="90" align="center"></td>
                    <td width="90" align="center"><font color="red"> R$ '.$dadosRelatorio[$j]->Valor.'</font></td>
                    </tr>';                  
        }
        
        $output .= '
                <tr>
                    <th colspan="2" align="center">Totais</th>
                    <th align="center">R$ '.$totalEntradas.'</th>
                    <th align="center"><font color="red"> R$ '.$totalSaidas.' </font></th>                  
                </tr>                    
                <tr>
                    <th colspan="2" align="center">Resultado</th>
                    <th colspan="2" align="center">R$ '.$diferenca.'</th>                    
                </tr>
                <tr>
                    <th colspan="2" align="center">Saldo Anterior</th>
                    <th colspan="2" align="center">R$ '.$totalCaixa.'</th>                    
                </tr>
                <tr>
                    <th colspan="2" align="center">Saldo Atual</th>
                    <th colspan="2" align="center">R$ '.$saldoAtual.'</th>                    
                </tr>
              </table>';
        
        
        
        return $output;
    }
    
    
    public function GeraLivroCaixa(Request $request)
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        
        session_start();
        $_SESSION["dataInicio"] = $request->dataInicio ;
        $_SESSION["dataFim"] = $request->dataFim ;
        
        $dadosRelatorio = $this->tesouraria->where('Origem','=','Caixa')->whereBetween('Data',[$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
         
        $totalEntradas = 0;
        $totalSaidas = 0;
                    
        for ($j=0; $j<count($dadosRelatorio); $j++){            
            if ($dadosRelatorio[$j]->Valor > 0){
                $totalEntradas = $totalEntradas + $dadosRelatorio[$j]->Valor;
            }
            else{
                $totalSaidas = $totalSaidas + $dadosRelatorio[$j]->Valor;
            }            
            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');
            
        }
        
        $totalSaidas = number_format($totalSaidas,  2, ',', '.');
        $totalEntradas = number_format($totalEntradas,  2, ',', '.');
        //dd($dadosRelatorio->all());
            
        
        return view('admin.relatorios.locais.livrocaixa.caixa.relatorio', compact('user', 'uri', 'dadosRelatorio', 'totalEntradas','totalSaidas'));
    }
        
     public function GeraPaginaLivroBanco()
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        $usuarios =$this->usuarios->all();
        
        return view('admin.relatorios.locais.livrocaixa.banco.index', compact('user', 'uri', 'usuarios'));
    }
    
    public function GeraLivroBanco(Request $request)
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        
        session_start();
        $_SESSION["dataInicio"] = $request->dataInicio ;
        $_SESSION["dataFim"] = $request->dataFim ;
        
        $dadosRelatorio = $this->tesouraria->where('Origem','=','Banco')->whereBetween('Data',[$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();

        $totalEntradas = 0;
        $totalSaidas = 0;
                    
        for ($j=0; $j<count($dadosRelatorio); $j++){            
            if ($dadosRelatorio[$j]->Valor > 0){
                $totalEntradas = $totalEntradas + $dadosRelatorio[$j]->Valor;
            }
            else{
                $totalSaidas = $totalSaidas + $dadosRelatorio[$j]->Valor;
            }            
            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');
            
        }
        
        $totalSaidas = number_format($totalSaidas,  2, ',', '.');
        $totalEntradas = number_format($totalEntradas,  2, ',', '.');
        //dd($dadosRelatorio->all());
        
        return view('admin.relatorios.locais.livrocaixa.banco.relatorio', compact('user', 'uri', 'dadosRelatorio', 'totalEntradas','totalSaidas'));
    }
    
    public function GeraPDFLivroBanco(Request $request)
    {   
        $pdf = new Dompdf();
        $data = $this->ConvertHtmlPdfLivroBanco();
        $pdf->loadHTML($data);
        $font = $pdf->getFontMetrics()->getFont("Arial", "bold");
        $pdf->get_canvas()->page_text(510, 18, "Pág {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0, 0, 0));
        $pdf->render();
        return $pdf->stream();       
    }
    
    public function ConvertHtmlPdfLivroBanco()
    {               
        $user = Auth()->User();        
        session_start();
        $dadosRelatorio = $this->tesouraria->where('Origem','=','Banco')->whereBetween('Data', [$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
        $dadosTotal = $this->tesouraria->where('Origem','=','Banco')->whereBetween('Data',['2014/01/01', $_SESSION["dataInicio"]])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();       
        
        $totalEntradas = 0;
        $totalSaidas = 0;
        $totalCaixa = 0;
        
        for ($j=0; $j<count($dadosTotal); $j++){            
            $totalCaixa = $totalCaixa + $dadosTotal[$j]->Valor;            
        }
                    
        for ($j=0; $j<count($dadosRelatorio); $j++){            
            if ($dadosRelatorio[$j]->Valor > 0){
                $totalEntradas = $totalEntradas + $dadosRelatorio[$j]->Valor;
            }
            else{
                $totalSaidas = $totalSaidas + $dadosRelatorio[$j]->Valor;
            }            
            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');
            
        }
        $diferenca = $totalSaidas + $totalEntradas;
        $saldoAtual = $diferenca + $totalCaixa;
        $totalSaidas = number_format($totalSaidas,  2, ',', '.');
        $totalEntradas = number_format($totalEntradas,  2, ',', '.');
        $totalCaixa = number_format($totalCaixa,  2, ',', '.');
        $diferenca = number_format($diferenca,  2, ',', '.');
        $saldoAtual = number_format($saldoAtual,  2, ',', '.');
        
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
    
        <div id="head" ><br />Relatório Livro Banco - '.$user->user_igreja.' <br />
            De '.$_SESSION["dataInicio"].' à '.$_SESSION["dataFim"].'
                </div>
           <div id="corpo">
            <table border="1" cellspacing=0.1 page-break-inside: auto;>
                <thead>
                    <tr>
                      <th align="center">Data</th>
                      <th align="center">Descrição</th>
                      <th align="center">Entrada</th>
                      <th align="center">Saída</th>                      
                    </tr>
                </thead>
                   ';
        
        for ($j=0; $j<count($dadosRelatorio); $j++){
            $output .= '
                <tr>
                  <td width="60">'.$dadosRelatorio[$j]->Data.'</td>
                  <td width="200">'.$dadosRelatorio[$j]->Descricao.'</td>';
            if ($dadosRelatorio[$j]->Valor > 0)
                    $output .=' 
                    <td width="90" align="center">R$ '.$dadosRelatorio[$j]->Valor.'</td>
                    <td width="90" align="center"></td>';
            else
                    $output .='<td width="90" align="center"></td>
                    <td width="90" align="center"><font color="red"> R$ '.$dadosRelatorio[$j]->Valor.'</font></td>
                    </tr>';                  
        }
        
        $output .= '
                <tr>
                    <th colspan="2" align="center">Totais</th>
                    <th align="center">R$ '.$totalEntradas.'</th>
                    <th align="center"><font color="red"> R$ '.$totalSaidas.' </font></th>                  
                </tr>                    
                <tr>
                    <th colspan="2" align="center">Resultado</th>
                    <th colspan="2" align="center">R$ '.$diferenca.'</th>                    
                </tr>
                <tr>
                    <th colspan="2" align="center">Saldo Anterior</th>
                    <th colspan="2" align="center">R$ '.$totalCaixa.'</th>                    
                </tr>
                <tr>
                    <th colspan="2" align="center">Saldo Atual</th>
                    <th colspan="2" align="center">R$ '.$saldoAtual.'</th>                    
                </tr>
              </table>';
        
        
        
        return $output;
    }
    
    public function GeraPaginaLivroCaixaBanco()
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        $usuarios =$this->usuarios->all();
        
        return view('admin.relatorios.locais.livrocaixa.caixabanco.index', compact('user', 'uri', 'usuarios'));
    }
    public function GeraLivroCaixaBanco(Request $request)
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        
        session_start();
        $_SESSION["dataInicio"] = $request->dataInicio ;
        $_SESSION["dataFim"] = $request->dataFim ;
        
        $dadosRelatorio = $this->tesouraria->whereBetween('Data',[$request->dataInicio, $request->dataFim])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
           
        $totalEntradas = 0;
        $totalSaidas = 0;
                    
        for ($j=0; $j<count($dadosRelatorio); $j++){            
            if ($dadosRelatorio[$j]->Valor > 0){
                $totalEntradas = $totalEntradas + $dadosRelatorio[$j]->Valor;
            }
            else{
                $totalSaidas = $totalSaidas + $dadosRelatorio[$j]->Valor;
            }            
            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');
            
        }
        
        $totalSaidas = number_format($totalSaidas,  2, ',', '.');
        $totalEntradas = number_format($totalEntradas,  2, ',', '.');
        //dd($dadosRelatorio->all());
            
        
        return view('admin.relatorios.locais.livrocaixa.caixabanco.relatorio', compact('user', 'uri', 'dadosRelatorio', 'totalEntradas','totalSaidas'));
    }
    
    public function GeraPDFLivroCaixaBanco(Request $request)
    {   
        $pdf = new Dompdf();
        $data = $this->ConvertHtmlPdfLivroCaixaBanco();
        $pdf->loadHTML($data);
        $font = $pdf->getFontMetrics()->getFont("Arial", "bold");
        $pdf->get_canvas()->page_text(510, 18, "Pág {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0, 0, 0));
        $pdf->render();
        return $pdf->stream();       
    }
    
    public function ConvertHtmlPdfLivroCaixaBanco()
    {               
        $user = Auth()->User();        
        session_start();
        $dadosRelatorio = $this->tesouraria->where('Origem','=','Caixa')->whereBetween('Data', [$_SESSION["dataInicio"], $_SESSION["dataFim"]])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();
        $dadosTotal = $this->tesouraria->whereBetween('Data',['2014/01/01', $_SESSION["dataInicio"]])->where('Igreja', $user->user_igreja)->orderby('Data','asc')->get();       
        
        $totalEntradas = 0;
        $totalSaidas = 0;
        $totalCaixa = 0;
        
        for ($j=0; $j<count($dadosTotal); $j++){            
            $totalCaixa = $totalCaixa + $dadosTotal[$j]->Valor;            
        }
                    
        for ($j=0; $j<count($dadosRelatorio); $j++){            
            if ($dadosRelatorio[$j]->Valor > 0){
                $totalEntradas = $totalEntradas + $dadosRelatorio[$j]->Valor;
            }
            else{
                $totalSaidas = $totalSaidas + $dadosRelatorio[$j]->Valor;
            }            
            $dadosRelatorio[$j]->Valor = number_format($dadosRelatorio[$j]->Valor,  2, ',', '.');
            
        }
        $diferenca = $totalSaidas + $totalEntradas;
        $saldoAtual = $diferenca + $totalCaixa;
        $totalSaidas = number_format($totalSaidas,  2, ',', '.');
        $totalEntradas = number_format($totalEntradas,  2, ',', '.');
        $totalCaixa = number_format($totalCaixa,  2, ',', '.');
        $diferenca = number_format($diferenca,  2, ',', '.');
        $saldoAtual = number_format($saldoAtual,  2, ',', '.');
        
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
    
        <div id="head" ><br />Relatório Livro Caixa e Banco- '.$user->user_igreja.' <br />
            De '.$_SESSION["dataInicio"].' à '.$_SESSION["dataFim"].'
                </div>
           <div id="corpo">
            <table border="1" cellspacing=0.1 page-break-inside: auto;>
                <thead>
                    <tr>
                      <th align="center">Data</th>
                      <th align="center">Descrição</th>
                      <th align="center">Entrada</th>
                      <th align="center">Saída</th>                      
                    </tr>
                </thead>
                   ';
        
        for ($j=0; $j<count($dadosRelatorio); $j++){
            $output .= '
                <tr>
                  <td width="60">'.$dadosRelatorio[$j]->Data.'</td>
                  <td width="200">'.$dadosRelatorio[$j]->Descricao.'</td>';
            if ($dadosRelatorio[$j]->Valor > 0)
                    $output .=' 
                    <td width="90" align="center">R$ '.$dadosRelatorio[$j]->Valor.'</td>
                    <td width="90" align="center"></td>';
            else
                    $output .='<td width="90" align="center"></td>
                    <td width="90" align="center"><font color="red"> R$ '.$dadosRelatorio[$j]->Valor.'</font></td>
                    </tr>';                  
        }
        
        $output .= '
                <tr>
                    <th colspan="2" align="center">Totais</th>
                    <th align="center">R$ '.$totalEntradas.'</th>
                    <th align="center"><font color="red"> R$ '.$totalSaidas.' </font></th>                  
                </tr>                    
                <tr>
                    <th colspan="2" align="center">Resultado</th>
                    <th colspan="2" align="center">R$ '.$diferenca.'</th>                    
                </tr>
                <tr>
                    <th colspan="2" align="center">Saldo Anterior</th>
                    <th colspan="2" align="center">R$ '.$totalCaixa.'</th>                    
                </tr>
                <tr>
                    <th colspan="2" align="center">Saldo Atual</th>
                    <th colspan="2" align="center">R$ '.$saldoAtual.'</th>                    
                </tr>
              </table>';
        
        
        
        return $output;
    }
    
}
