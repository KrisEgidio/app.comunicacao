<?php

namespace App\View\Components\index;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Botoes extends Component
{

    public $rota;
    public $create;
    public $index;

    public function __construct($rota, $create = false, $index = false)
    {
        $this->rota = $rota;
        $this->create = $create;
        $this->index = $index;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index.botoes');
    }
}
