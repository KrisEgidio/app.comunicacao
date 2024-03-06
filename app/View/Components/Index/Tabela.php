<?php

namespace App\View\Components\Index;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tabela extends Component
{

    public $dados;
    public $colunas;

    public function __construct($dados = [], $colunas = [])
    {
        $this->dados = $dados;
        $this->colunas = $colunas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index.tabela');
    }
}
