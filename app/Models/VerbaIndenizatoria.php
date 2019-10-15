<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerbaIndenizatoria extends Model
{
    protected $table = 'verbas_indenizatorias';
    protected $guarded = [];

    function despesas() {
    	return $this->hasMany('App\Models\VerbaIndenizatoria\Despesa', 'id_verba_indenizatoria');
    }

    function deputado() {
    	return $this->belongsTo('App\Models\Deputado', 'id_deputado', 'id_deputado');
    }

    function scopeInfo() {
    	return $this->with(['deputado', 'despesas']);
    }

}
