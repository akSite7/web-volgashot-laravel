<?php

namespace App\Livewire\Ui;

use App\Models\About;
use Livewire\Component;

class AboutBlock extends Component
{
    public function render()
    {
        return view('livewire.ui.about-block', [
            'abouts' => About::all()
        ]);
    }
}
