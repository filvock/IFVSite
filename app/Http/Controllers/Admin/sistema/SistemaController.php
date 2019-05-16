<?php

namespace App\Http\Controllers\Admin\sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TesourariaGeral;


class SistemaController extends Controller
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
        return view('admin.sistema.index', compact('user'));
    }
     
    public function viewSistemaCidades()
    {
        $user = Auth()->User();
        //dd($this->request->route());
        
        $uri = ($this->request->route()->uri());
        
        $exploder = explode("/", $uri);
        $uriAtual = $exploder[1];
        $usuarios =$this->usuarios->all();
        
        return view('admin.sistema.cidades.index', compact('user', 'uriAtual', 'usuarios'));
    }
    
    public function viewSistemaPlanosContas()
    {
        $user = Auth()->User();
        //dd($this->request->route());
        
        $uri = ($this->request->route()->uri());
        
        $exploder = explode("/", $uri);
        $uriAtual = $exploder[1];
        $usuarios =$this->usuarios->all();
        
        return view('admin.sistema.planoscontas.index', compact('user', 'uriAtual', 'usuarios'));
    }
    
    public function viewSistemaUsuarios()
    {
        $user = Auth()->User();
        //dd($this->request->route());
        
        $uri = ($this->request->route()->uri());
        
        $exploder = explode("/", $uri);
        $uriAtual = $exploder[1];
        $usuarios =$this->usuarios->all();
        
        return view('admin.sistema.usuarios.index', compact('user', 'uriAtual', 'usuarios'));
    }
    
    public function viewSistemaIgrejas()
    {
        $user = Auth()->User();
        //dd($this->request->route());
        
        $uri = ($this->request->route()->uri());
        
        $exploder = explode("/", $uri);
        $uriAtual = $exploder[1];
        $usuarios =$this->usuarios->all();
        
        return view('admin.sistema.igrejas.index', compact('user', 'uriAtual', 'usuarios'));
    }
 
 
    
    public function viewSistema()
    {
        $user = Auth()->User();
        //dd($this->request->route());
        
        $uri = ($this->request->route()->uri());
        
        $exploder = explode("/", $uri);
        $uriAtual = $exploder[1];
        $usuarios =$this->usuarios->all();
        
        return view('admin.sistema.index', compact('user', 'uriAtual', 'usuarios'));
    }
}
