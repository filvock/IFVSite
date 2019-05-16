<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoDeContasDebito extends Model
{
    protected $table = 'PlanoDeContasDebito';
     public $timestamps = false;
     public $primaryKey = 'Codigo';
     
     //protected $fillable = [
     //     'Data', 'NumDocumento', 'Descricao', 'Conta', 'Igreja', 'Valor',
     //    'Obs', 'Origem', 'Natureza', 'Usuario', 'DataLanc', 
     //];
 
    
    
}
