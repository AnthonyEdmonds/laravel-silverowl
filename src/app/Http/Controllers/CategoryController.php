<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Http\Requests\StoreCategoryRequest;
use AnthonyEdmonds\SilverOwl\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        // TODO List all categories
    }

    public function create(): View
    {
        // TODO Create a category
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        // TODO Store the created category
    }

    public function show(Category $Category): View
    {
        // TODO Show the contents of a category
    }

    public function edit(Category $Category): View
    {
        // TODO Edit a category
    }

    public function update(StoreCategoryRequest $request, Category $Category): RedirectResponse
    {
        // TODO Save the changes to a Category
    }

    public function destroy(Category $Category): RedirectResponse
    {
        // TODO Remove a category
    }
}
