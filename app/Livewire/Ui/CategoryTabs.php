<?php

namespace App\Livewire\Ui;

use App\Models\Category;
use Livewire\Component;

class CategoryTabs extends Component
{
    public $categorySlug = 'fraction';

    public function changeCategory($slug)
    {
        $this->categorySlug = $slug;
    }

    public function render()
    {
        $category = Category::where('category_slug', $this->categorySlug)->first();
        $products = $category ? $category->products()->where('is_active', true)->orderBy('updated_at', 'DESC')->get(): collect();
        return view('livewire.ui.category-tabs', [
            'category' => $category,
            'products' => $products
        ]);
    }
}