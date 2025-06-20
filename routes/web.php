<?php

use App\Livewire\PageCart;
use App\Livewire\PageContact;
use App\Livewire\PageHome;
use App\Livewire\PageOrder;
use App\Livewire\PageThankYou;
use App\Livewire\SingleCategory;
use Illuminate\Support\Facades\Route;

Route::get('/', PageHome::class)->name('page.home');
Route::get('/category/{category_slug}', SingleCategory::class)->name('single.category');
Route::get('/contact', PageContact::class)->name('page.contact');
Route::get('/cart', PageCart::class)->name('page.cart');
Route::get('/cart/order', PageOrder::class)->name('page.order');
Route::get('cart/order/thank-you', PageThankYou::class)->name('page.thank.you');