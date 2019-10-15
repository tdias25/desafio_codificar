<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{	
	protected $table = 'deputados';
    protected $guarded = [];

    static function findByIdDeputado($id_deputado) {
    	return self::where('id_deputado', $id_deputado)->first();
    }

    function verbas_indenizatorias() {
    	return $this->hasMany('App\Models\VerbaIndenizatoria', 'id_deputado');
    }
}
