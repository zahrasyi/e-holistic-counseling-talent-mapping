<?php

namespace App\View\Components\partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tabs extends Component
{
    public $tabs;
    public $active;

    /**
     * Create a new component instance.
     */
    public function __construct($tabs = [], $active = [])
    {
        $this->tabs = $tabs;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.partials.tabs');
    }
}
