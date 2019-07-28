<?php

namespace App\Http\Controllers\Admin\relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TesourariaGeral;
use PDF;
use Dompdf\Dompdf;

class RelatoriosController extends Controller
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
        
        return view('admin.relatorios.index', compact('user', 'uri'));
    }
        
    public function RelatorioLocal()
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        $usuarios =$this->usuarios->all();
        
        return view('admin.relatorios.locais.index', compact('user', 'uri', 'usuarios'));
    }
    
    public function RelatorioGerencial()
    {   
        $user = Auth()->User();
        $uri = ($this->request->route()->uri());
        $usuarios =$this->usuarios->all();
        
        return view('admin.relatorios.gerencial.index', compact('user', 'uri', 'usuarios'));
    }
}
