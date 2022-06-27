<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $show;
    public $type;


    public function __construct($show, $type)
    {
        $this->show = $show;
        $this->type = $type;



    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.badge');
    }
}
