<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonPink extends Component
{
    public $href;
    public $icon;
    public $class;
    public $color;
    public $type;

    public function __construct($href = null, $icon = false, $class = '', $color = 'pink-800', $type = null)
    {
        $this->href = $href;
        $this->icon = $icon;
        $this->class = $class;
        $this->color = $color;
        $this->type = $type;
    }

    public function getHoverColor()
    {
        if (empty($this->color)) {
            return 'pink-700';
        }

        if (!str_contains($this->color, '-')) {
            return $this->color;
        }

        list($colorName, $intensity) = explode('-', $this->color);
        $hoverIntensity = max(100, intval($intensity) - 100);

        return "{$colorName}-{$hoverIntensity}";
    }

    public function render()
    {
        return view('components.button-pink');
    }
}
