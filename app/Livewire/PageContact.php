<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Контакты')] 
class PageContact extends Component
{
  public function render()
  {
    return view('livewire.page-contact', [
      'contacts' => Contact::all(),
    ]);
  }
}
