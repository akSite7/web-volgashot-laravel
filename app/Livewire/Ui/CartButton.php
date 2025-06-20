<?php

namespace App\Livewire\Ui;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class CartButton extends Component
{
  public $total_count = 0;

  public function mount() {
    $this->total_count = count(CartManagement::getCartItemsFromSession());
  }

  #[On('update-cart-count')]
  public function updateCartCount($total_count) {
    $this->total_count = $total_count;
  }

  public function render()
  {
    return view('livewire.ui.cart-button');
  }
}
