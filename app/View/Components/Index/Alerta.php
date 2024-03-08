<?php

namespace App\View\Components\index;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alerta extends Component
{
    public string $tipo;
    public string $mensagem;

    public function __construct($tipo, $mensagem)
    {
        $this->tipo = $tipo;
        $this->mensagem = $mensagem;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index.alerta');
    }
}
