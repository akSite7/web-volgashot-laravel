<?php

use App\Livewire\PageContact;
use App\Livewire\PageHome;
use App\Livewire\SingleCategory;
use Illuminate\Support\Facades\Route;

Route::get('/', PageHome::class)->name('page.home');
Route::get('/category/{category_slug}', SingleCategory::class)->name('single.category');
Route::get('/contact', PageContact::class)->name('page.contact');