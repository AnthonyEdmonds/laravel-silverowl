<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use Illuminate\Http\RedirectResponse;

class ContentTagController extends Controller
{
    public function link(Content $content, Tag $tag): RedirectResponse
    {
        $content->tags()->attach($tag);

        flash()->success("Added the \"$tag->label\" Tag to the \"$content->title\" Content.");

        return redirect()->route('admin.contents.edit', $content);
    }

    public function unlink(Content $content, Tag $tag): RedirectResponse
    {
        $content->tags()->detach($tag);

        flash()->success("Removed the \"$tag->label\" Tag from the \"$content->title\" Content.");

        return redirect()->route('admin.contents.edit', $content);
    }
}
