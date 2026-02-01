<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public function __construct(
        public string $title,
        public string $value,
        public string $icon,
        public string $iconColor = 'text-blue-600',
        public string $subtitle = ''
    ) {}

    public function render()
    {
        return view('components.stat-card');
    }
}
