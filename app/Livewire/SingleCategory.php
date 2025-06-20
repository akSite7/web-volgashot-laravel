<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Ui\CartButton;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Товары')]
class SingleCategory extends Component
{
  public $category_slug;
  public $cart_items = [];
  public $total_price;
  public $total_quantity;

  public function mount($category_slug)
  {
    $this->category_slug = $category_slug;
    $this->syncCart();
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
    $this->total_price = $stats['total_price'];
    $this->total_quantity = $stats['total_quantity'];
    $this->dispatch('update-cart-count', total_count: $stats['unique_count'])->to(CartButton::class);
  }

  public function render()
  {
    $category = Category::where('category_slug', $this->category_slug)->first();
    $products = $category->products()->where('is_active', true)->orderBy('updated_at', 'DESC')->get();
    $categories = collect([$category]);

    return view('livewire.single-category', [
      'category' => $category,
      'products' => $products,
      'categories' => $categories,
      'cart_items' => $this->cart_items,
    ]);
  }
}