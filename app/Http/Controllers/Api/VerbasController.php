<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VerbaIndenizatoria;

class VerbasController extends Controller
{
    /**
     * lista os dados das verbas indenizatorias
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $validator = \Validator::make($request->all(), [
          'ordem' => 'nullable|in:asc,desc',
          'limite' => 'nullable|numeric',
          'mes' => 'required|numeric|digits_between:1,12'
      ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()->all()], 422);

        $ordem = $request->filled('ordem') ? $request->ordem : 'desc';
        $limite = $request->filled('limite') ? $request->limite : 5;
        
        //pequeno helper que so altera o mes da data
        $mes = createDateByMonth($request->mes);

        $verbas = VerbaIndenizatoria::with('deputado')
        ->select(\DB::raw('SUM(valor) AS valor_total'), 'id_deputado', 'data_referencia' )
        ->whereDate('data_referencia', $mes)
        ->groupBy('id_deputado', 'data_referencia')
        ->orderBy( \DB::raw('valor_total'), $ordem )
        ->limit($limite)
        ->get();

        return response()->json( $verbas );
    }
}
