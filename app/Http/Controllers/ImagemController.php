<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagemController extends Controller
{
    public function exibir($nomeArquivo)
    {
        if (file_exists(storage_path('app/private/' . $nomeArquivo))) {
            return response()->file(storage_path('app/private/' . $nomeArquivo));
        }
    }
}
