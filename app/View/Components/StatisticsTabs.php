<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatisticsTabs extends Component
{
    public $stats;
    public $isAdmin;

    public function __construct($stats = [], $isAdmin = false)
    {
        $this->stats = $stats;
        $this->isAdmin = $isAdmin;
    }

    public function render(): View|Closure|string
    {
        return view('components.statistics-tabs');
    }
}