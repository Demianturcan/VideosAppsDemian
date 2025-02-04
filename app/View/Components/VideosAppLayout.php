<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class VideosAppLayout extends Component
{
    private ?string $view = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->view = 'layouts.videos-app';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render(): View|string
    {
        return view($this->view);
    }
}


