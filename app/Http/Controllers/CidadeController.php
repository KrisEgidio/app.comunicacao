<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{

    public function getCidades($estado_id)
    {
        try {
            $cidades = Cidade::where('estado_id', $estado_id)->get();
            return response()->json($cidades);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
