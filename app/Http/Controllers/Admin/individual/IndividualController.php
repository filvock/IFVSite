<?php

namespace App\Http\Controllers\Admin\individual;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TesourariaGeral;


class IndividualController extends Controller
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
        return view('admin.individual.index', compact('user'));
    }
    
    public function viewIndividual()
    {
        $user = Auth()->User();
        //dd($this->request->route());
        
        $uri = ($this->request->route()->uri());
        
        $exploder = explode("/", $uri);
        $uriAtual = $exploder[1];
        $usuarios =$this->usuarios->all();
        
        return view('admin.individual.index', compact('user', 'uriAtual', 'usuarios'));
    }
}
