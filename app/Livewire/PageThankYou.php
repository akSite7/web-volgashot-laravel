<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Спасибо за заказ!')] 
class PageThankYou extends Component
{
  public function render()
  {
    return view('livewire.page-thank-you');
  }
}
