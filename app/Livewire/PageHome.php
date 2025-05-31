<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('VOLGASHOT - Продажа охотничьей дроби и картечи от производителя')] 
class PageHome extends Component
{
    public function render()
    {
        $products = Product::where('is_active', 1)->get();
        return view('livewire.page-home', [
            'products' => $products
        ]);
    }
}
