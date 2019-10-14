<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{	
	protected $table = 'deputados';
    protected $guarded = [];

    static function findById($id_deputado) {
    	return self::where('id_deputado', $id_deputado)->first();
    }
}
