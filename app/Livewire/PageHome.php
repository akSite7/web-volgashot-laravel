<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('VOLGASHOT - Продажа охотничьей дроби и картечи от производителя')] 
class PageHome extends Component
{
    public function render()
    {
        return view('livewire.page-home');
    }
}
