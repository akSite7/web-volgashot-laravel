<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Оформление заказа')]
class PageOrder extends Component
{
  public $first_name;
  public $last_name;
  public $phone;
  public $city;
  public $address;
  public $notes;

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
  }

  public function placeOrder()
  {
    $this->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'phone' => 'required',
      'city' => 'required',
      'address' => 'required',
      'notes' => 'required',
    ]);

    $cart_items = CartManagement::getCartItemsFromSession();

    if (empty($cart_items)) {
      session()->flash('error', 'Корзина пуста');
      return;
    }

    $order = Order::create([
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'phone' => $this->phone,
      'city' => $this->city,
      'address' => $this->address,
      'notes' => $this->notes,
      'status' => 'new',
      'total_price' => CartManagement::calculateTotalPrice($cart_items),
    ]);

    $order->items()->createMany(array_map(fn($item) => [
      'product_id' => $item['product_id'],
      'quantity' => $item['quantity'],
      'unit_amount' => $item['unit_amount'],
      'total_amount' => $item['unit_amount'] * $item['quantity'],
    ], $cart_items));
      CartManagement::clearCartItems();
      return redirect('cart/order/thank-you');
  }

  public function render()
  {
    return view('livewire.page-order', [
      'cart_items' => $this->cart_items,
      'total_price' => $this->total_price,
      'total_quantity' => $this->total_quantity,
    ]);
  }
}