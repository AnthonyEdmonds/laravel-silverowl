<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Http\Requests\StoreTagRequest;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TagController extends Controller
{
    public function index(): View
    {
        // TODO List all tags
    }

    public function create(): View
    {
        // TODO Create a tag
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        // TODO Store a created Tag
    }

    public function show(Tag $Tag): View
    {
        // TODO List all content with this tag
    }

    public function edit(Tag $Tag): View
    {
        // TODO Edit a tag
    }

    public function update(StoreTagRequest $request, Tag $Tag): RedirectResponse
    {
        // TODO Update the edited Tag
    }

    public function destroy(Tag $Tag): RedirectResponse
    {
        // TODO Destroy the Tag
    }
}
