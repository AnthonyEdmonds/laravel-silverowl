<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Models\Content;
use Illuminate\Contracts\View\View;

class ContentController extends Controller
{
    public function show(Content $content): View
    {
        $content->addView();

        return view('silverowl::contents.show');
    }
}
