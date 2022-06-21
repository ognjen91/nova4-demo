<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LayoutBase extends Component
{
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $class = '')
    {
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout-base');
    }
}
