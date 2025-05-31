<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('VOLGASHOT - Контакты')] 
class PageContact extends Component
{
    public function render()
    {
        return view('livewire.page-contact');
    }
}
