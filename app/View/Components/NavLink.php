<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
    public $route;
    public $title;
    public $icon;
    public $isActive;

    public function __construct($route, $title, $icon)
    {
        $this->route = $route;
        $this->title = $title;
        $this->icon = $icon;
        $this->isActive = request()->routeIs($route) ? 'active' : '';
    }

    public function render()
    {
        return view('components.nav-link');
    }
}
