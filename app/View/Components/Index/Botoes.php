<?php

namespace App\View\Components\index;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Botoes extends Component
{

    public $rota;
    public $create;

    public function __construct($rota, $create = false)
    {
        $this->rota = $rota;
        $this->create = $create;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index.botoes');
    }
}
