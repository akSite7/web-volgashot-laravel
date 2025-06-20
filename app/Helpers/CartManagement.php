<?php

namespace App\Helpers;

use App\Models\Product;

class CartManagement {

  public static function addItemToCart($product_id) 
  {
    $cart_items = self::getCartItemsFromSession();
    $existing_item = null;

    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        $existing_item = $key;
        break;
      }
    }
    if ($existing_item !== null) {
      $cart_items[$existing_item]['quantity']++;
      $cart_items[$existing_item]['total_amount'] =
        $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
    } else {
      $product = Product::find($product_id, ['id', 'name', 'price', 'image']);
      if ($product) {
        $cart_items[] = [
          'product_id' => $product->id,
          'name' => $product->name,
          'image' => $product->image,
          'quantity' => 1,
          'unit_amount' => $product->price,
          'total_amount' => $product->price
        ];
      }
    }

    self::addCartItemsToSession($cart_items);
    return count($cart_items);
  }

  public static function removeCartItem($product_id) 
  {
    $cart_items = self::getCartItemsFromSession();
    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        unset($cart_items[$key]);
      }
    }
    self::addCartItemsToSession(array_values($cart_items));
    return $cart_items;
  }

  public static function incrementQuantityToCartItem($product_id) 
  {
    $cart_items = self::getCartItemsFromSession();
    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        $cart_items[$key]['quantity']++;
        $cart_items[$key]['total_amount'] =
        $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
      }
    }

    self::addCartItemsToSession($cart_items);
    return $cart_items;
  }

  public static function decrementQuantityToCartItem($product_id) 
  {
    $cart_items = self::getCartItemsFromSession();
    foreach ($cart_items as $key => $item) {
      if ($item['product_id'] == $product_id) {
        if ($item['quantity'] > 1) {
            $cart_items[$key]['quantity']--;
            $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
        } else {
            unset($cart_items[$key]);
        }
        break;
      }
    }

    self::addCartItemsToSession($cart_items);
    return $cart_items;
  }

  public static function clearCartItems() 
  {
    session()->forget('cart_items');
  }

  public static function getCartItemsFromSession() 
  {
    return session('cart_items', []);
  }

  public static function addCartItemsToSession($cart_items) 
  {
    session(['cart_items' => $cart_items]);
  }

  public static function calculateTotalPrice($items) 
  {
    return array_sum(array_column($items, 'total_amount'));
  }

  public static function calculateTotalQuantity($items) 
  {
    return array_sum(array_column($items, 'quantity'));
  }

  public static function calculateTotalUniqueItems($items) 
  {
    return count($items);
  }

  public static function getCartStats() 
  {
    $items = self::getCartItemsFromSession();
    return [
      'items' => $items,
      'total_price' => self::calculateTotalPrice($items),
      'total_quantity' => self::calculateTotalQuantity($items),
      'unique_count' => self::calculateTotalUniqueItems($items),
    ];
  }
}