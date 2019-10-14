<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerbaIndenizatoria extends Model
{
    protected $table = 'verbas_indenizatorias';
    protected $guarded = [];

    function itens() {
    	return $this->hasMany('App\Models\VerbaIndenizatoria\Despesa', 'id_verba_indenizatoria', 'id');
    }
}
