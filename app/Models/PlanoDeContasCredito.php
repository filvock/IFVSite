<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoDeContasCredito extends Model
{
     protected $table = 'PlanoDeContasCredito';
     public $timestamps = false;
     public $primaryKey = 'Codigo';
     
     //protected $fillable = [
     //     'Data', 'NumDocumento', 'Descricao', 'Conta', 'Igreja', 'Valor',
     //    'Obs', 'Origem', 'Natureza', 'Usuario', 'DataLanc', 
     //];
 
     

}
