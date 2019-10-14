<?php

namespace App\Models\VerbaIndenizatoria;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $table = 'verbas_indenizatorias_despesas';
    protected $guarded = [];

    function verba_indenizatoria(){
    	return $this->belongsTo('App\Models\VerbaIndenizatoria');
    }
}
