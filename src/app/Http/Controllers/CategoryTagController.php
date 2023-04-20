<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use Illuminate\Http\RedirectResponse;

class CategoryTagController extends Controller
{
    public function link(Category $category, Tag $tag): RedirectResponse
    {
        $category->tags()->attach($tag);

        flash()->success("Added the \"$tag->label\" Tag to the $category->name Category.");

        return redirect()->route('admin.categories.edit', $category);
    }

    public function unlink(Category $category, Tag $tag): RedirectResponse
    {
        $category->tags()->detach($tag);

        flash()->success("Removed the \"$tag->label\" Tag from the $category->name Category.");

        return redirect()->route('admin.categories.edit', $category);
    }
}
