<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Http\Requests\StoreContentRequest;
use AnthonyEdmonds\SilverOwl\Models\Content;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContentController extends Controller
{
    public function index(): View
    {
        // TODO Show all content?
    }

    public function create(): View
    {
        // TODO Create a content
    }

    public function store(StoreContentRequest $request): RedirectResponse
    {
        // TODO Store the crreated content
    }

    public function show(Content $content): View
    {
        // TODO View a piece fo content
    }

    public function edit(Content $content): View
    {
        // TODO Edit a piece of content
    }

    public function update(StoreContentRequest $request, Content $content): RedirectResponse
    {
        // TODO Save the changes to a content
    }

    public function destroy(Content $content): RedirectResponse
    {
        // TODO Delete a content
    }
}
