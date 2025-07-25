<?php

namespace App\Livewire\Ui;

use App\Helpers\CartManagement;
use App\Livewire\Ui\CartButton;
use App\Models\Category;
use Livewire\Component;

class CategoryTabs extends Component
{
  public $categorySlug = 'fraction';
  public $cart_items = [];

  public function mount()
  {
    $this->syncCart();
  }

  public function changeCategory($slug)
  {
    $this->categorySlug = $slug;
  }

  public function addToCart($product_id)
  {
    CartManagement::addItemToCart($product_id);
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
    $this->dispatch('update-cart-count', total_count: $stats['unique_count'])->to(CartButton::class);
  }

  public function render()
  {
      $categories = Category::with(['products' => function($q) {
          $q->where('is_active', true)->orderBy('updated_at', 'DESC');
      }])->get();

      $cart_items = CartManagement::getCartStats()['items'];

      return view('livewire.ui.category-tabs', [
          'categories' => $categories,
          'cart_items' => $cart_items,
      ]);
  }
}