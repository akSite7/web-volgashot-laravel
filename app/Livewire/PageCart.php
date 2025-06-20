<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Ui\CartButton;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Корзина')]
class PageCart extends Component
{
  public $cart_items = [];
  public $total_price;
  public $total_quantity;

  public function mount()
  {
    $this->syncCart();
  }

  public function hydrate()
  {
    $this->syncCart();
  }

  public function removeItem($product_id)
  {
    CartManagement::removeCartItem($product_id);
    $this->syncCart();
  }

  public function increasedQty($product_id)
  {
    CartManagement::incrementQuantityToCartItem($product_id);
    $this->syncCart();
  }

  public function decreasedQty($product_id)
  {
    CartManagement::decrementQuantityToCartItem($product_id);
    $this->syncCart();
  }

  private function syncCart()
  {
    $stats = CartManagement::getCartStats();
    $this->cart_items = $stats['items'];
    $this->total_price = $stats['total_price'];
    $this->total_quantity = $stats['total_quantity'];
    $this->dispatch('update-cart-count', total_count: $stats['unique_count'])->to(CartButton::class);
  }

  public function render()
  {
    return view('livewire.page-cart');
  }
}