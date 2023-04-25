<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Helpers\PageHelper;
use AnthonyEdmonds\SilverOwl\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function show(Category $category): View
    {
        return PageHelper::standard(
            $category->name,
            'silverowl::categories.show',
            $category->breadcrumbs,
        )
            ->with('category', $category);
    }
}
