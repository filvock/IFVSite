<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('admin.index');
});

Route::get('/', 'Admin\AdminController@index')->middleware('auth')->name('admin.index');
Route::get('/home', 'Admin\AdminController@index')->middleware('auth')->name('admin.index');
Route::get('/Admin', 'Admin\AdminController@index')->middleware('auth')->name('admin.index');
Route::get('/admin', 'Admin\AdminController@index')->middleware('auth')->name('admin.index');


//Route::prefix('admin/tesouraria')->middleware('auth','role.igrejalocal')->namespace('Admin\tesouraria')->group(function () {        
Route::prefix('admin/tesouraria')->middleware('auth')->namespace('Admin\tesouraria')->group(function () {        
    Route::get('/', 'TesourariaController@viewTesouraria')->name('admin.tesouraria.index');
    Route::get('/entradas', 'TesourariaController@viewTesourariaEntradas')->name('admin.tesouraria.entradas.index');
    Route::get('/saidas', 'TesourariaController@viewTesourariaSaidas')->name('admin.tesouraria.saidas.index');
    Route::get('/transferencias', 'TesourariaController@viewTesourariaTransferencias')->name('admin.tesouraria.transferencias.index');
    Route::post('/transferencias', 'TesourariaController@Transferencias')->name('admin.tesouraria.transferencias.index');
    Route::get('/excluir', 'TesourariaController@viewTesourariaExcluir')->name('admin.tesouraria.excluir.index');
  
    Route::post('/excluir', 'TesourariaController@CriarRelatorio')->name('admin.tesouraria.excluir.relatorio');
    Route::post('/entradas', 'TesourariaController@NovaEntrada')->name('admin.tesouraria.entradas.index');
    Route::post('/saidas', 'TesourariaController@NovaSaida')->name('admin.tesouraria.saidas.index');
});

Route::get('/delete/{id}', 'Admin\tesouraria\TesourariaController@delete')->name('admin.tesouraria.excluir.relatorio');


Route::prefix('admin/sistema')->middleware('auth','role.admin')->namespace('Admin\sistema')->group(function () {
    Route::get('/', 'SistemaController@viewSistema')->name('admin.sistema.index');
    Route::get('/cidades', 'SistemaController@viewSistemaCidades')->name('admin.sistema.cidades.index');
    Route::get('/usuarios', 'SistemaController@viewSistemaUsuarios')->name('admin.sistema.usuarios.index');
    Route::get('/igrejas', 'Sistematroller@viewSistemaIgrejas')->name('admin.sistema.igrejas.index');
    Route::get('/planoscontas', 'SistemaController@viewSistemaPlanosContas')->name('admin.sistema.planoscontas.index');
});

Route::get('admin/relatorios/', 'Admin\relatorios\RelatoriosController@index')->name('admin.relatorios.index');   

Route::prefix('admin/relatorios/locais')->middleware('auth')->namespace('Admin\relatorioslocais')->group(
function () 

{
    Route::get('/', 'RelatoriosLocaisController@index')->name('admin.relatorios.locais.index');   
    
    Route::get('/livrocaixa', 'RelatoriosLocaisController@GeraLivro')->name('admin.relatorios.locais.livrocaixa.index'); 

    Route::get('/livrocaixa/caixa', 'RelatoriosLocaisController@GeraPaginaLivroCaixa')->name('admin.relatorios.locais.livrocaixa.caixa.index');   

    Route::post('/livrocaixa/caixa', 'RelatoriosLocaisController@GeraLivroCaixa')->name('admin.relatorios.locais.livrocaixa.caixa.index');

    Route::get('/livrocaixa/banco', 'RelatoriosLocaisController@GeraPaginaLivroBanco')->name('admin.relatorios.locais.livrocaixa.banco.index');   

    Route::post('/livrocaixa/banco', 'RelatoriosLocaisController@GeraLivroBanco')->name('admin.relatorios.locais.livrocaixa.banco.index');   

    Route::get('/livrocaixa/caixabanco', 'RelatoriosLocaisController@GeraPaginaLivroCaixaBanco')->name('admin.relatorios.locais.livrocaixa.caixabanco.index');   

    Route::post('/livrocaixa/caixabanco', 'RelatoriosLocaisController@GeraLivroCaixaBanco')->name('admin.relatorios.locais.livrocaixa.caixabanco.index');   
    
    
    Route::get('/livrocaixa/caixa/pdf', 'RelatoriosLocaisController@GeraPDFLivroCaixa');   
    Route::get('/livrocaixa/banco/pdf', 'RelatoriosLocaisController@GeraPDFLivroBanco');   
    Route::get('/livrocaixa/caixabanco/pdf', 'RelatoriosLocaisController@GeraPDFLivroCaixaBanco'); 


    Route::get('/contastotal', 'RelatoriosContasTotalController@index')->name('admin.relatorios.locais.contastotal.index');       
    Route::post('/contastotal', 'RelatoriosContasTotalController@GeraLivroPCTotal')->name('admin.relatorios.locais.contastotal.index');
    Route::get('/contastotal/pdf', 'RelatoriosContasTotalController@GeraPDFLivroPCTotal');     


    Route::get('/contasdetal', 'RelatoriosContasDetalController@index')->name('admin.relatorios.locais.contasdetal.index');       
    Route::post('/contasdetal', 'RelatoriosContasDetalController@GeraLivroPCDetal')->name('admin.relatorios.locais.contasdetal.index');
    Route::get('/contasdetal/pdf', 'RelatoriosContasDetalController@GeraPDFLivroPCDetal');     

    Route::get('/totais', 'RelatoriosTotaisController@index')->name('admin.relatorios.locais.totais.index');
    Route::post('/totais', 'RelatoriosTotaisController@GeraLivroTotais')->name('admin.relatorios.locais.totais.index');
    Route::get('/totais/pdf', 'RelatoriosTotaisController@GeraPDFLivroTotais');     



    
});

Route::prefix('admin/relatorios/gerenciais')->middleware('auth','role.admin')->namespace('Admin\relatoriosgerenciais')->group(function () 
{
    Route::get('/', 'RelatoriosController@RelatorioGerencial')->name('admin.relatorios.gerenciais.index');   	
    Route::get('/livrocaixa', 'RelatoriosController@GeraLivro')->name('admin.relatorios.gerenciais.livrocaixa.index');   
    Route::get('/livrocaixa/caixa', 'RelatoriosController@GeraPaginaLivroCaixa')->name('admin.relatorios.gerenciais.livrocaixa.caixa.index');   
    Route::post('/livrocaixa/caixa', 'RelatoriosController@GeraLivroCaixa')->name('admin.relatorios.gerenciais.livrocaixa.caixa.index');
    Route::get('/livrocaixa/banco', 'RelatoriosController@GeraPaginaLivroBanco')->name('admin.relatorios.livrocaixa.gerenciais.banco.index');   
    Route::post('/livrocaixa/banco', 'RelatoriosController@GeraLivroBanco')->name('admin.relatorios.livrocaixa.gerenciais.banco.index');   
    Route::get('/livrocaixa/caixabanco', 'RelatoriosController@GeraPaginaLivroCaixaBanco')->name('admin.relatorios.gerenciais.livrocaixa.caixabanco.index');   
    Route::post('/livrocaixa/caixabanco', 'RelatoriosController@GeraLivroCaixaBanco')->name('admin.relatorios.gerenciais.livrocaixa.caixabanco.index');   
});


Route::get('/admin/individual', 'Admin\individual\IndividualController@viewIndividual')->name('admin.individual.index');


Auth::routes();
