<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Helpers\PageHelper;
use AnthonyEdmonds\SilverOwl\Models\Content;
use Illuminate\Contracts\View\View;

class ContentController extends Controller
{
    public function show(Content $content): View
    {
        $content->addView();

        return PageHelper::standard(
            $content->title,
            'silverowl::contents.show',
            $content->breadcrumbs,
        )
            ->with('category', $content->category)
            ->with('content', $content);
    }
}
