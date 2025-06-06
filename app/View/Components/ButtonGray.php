<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonGray extends Component
{
    public $href;
    public $class;
    public $color;

    public function __construct($href = '#', $class = '', $color = 'gray-100')
    {
        $this->href = $href;
        $this->class = $class;
        $this->color = $color;
    }

    public function getHoverColor()
    {
        if (empty($this->color)) {
            return 'gray-300';
        }

        if (!str_contains($this->color, '-')) {
            return $this->color;
        }

        list($colorName, $intensity) = explode('-', $this->color);
        $hoverIntensity = max(100, intval($intensity) + 100);

        return "{$colorName}-{$hoverIntensity}";
    }

    public function render()
    {
        return view('components.button-gray');
    }
}
