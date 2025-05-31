<?php

use App\Livewire\PageContact;
use App\Livewire\PageHome;
use Illuminate\Support\Facades\Route;

Route::get('/', PageHome::class)->name('page.home');
Route::get('/contact', PageContact::class)->name('page.contact');
