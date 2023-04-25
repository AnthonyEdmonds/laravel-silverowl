<?php

namespace AnthonyEdmonds\SilverOwl\Helpers;

use AnthonyEdmonds\SilverOwl\Models\Category;
use Illuminate\Contracts\View\View;

class PageHelper
{
    public static function standard(
        string $title,
        string $blade,
        array $breadcrumbs,
    ): View {
        // TODO Load footer links
        // TODO Load header links
        
        return view($blade)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('footerLinks', self::loadFooterLinks())
            ->with('headerLinks', self::loadHeaderLinks())
            ->with('title', $title);
    }

    public static function loadFooterLinks(): array
    {
        return config('silverowl.footer.links');
    }
    
    public static function loadHeaderLinks(): array
    {
        return Category::query()
            ->atRootLevel()
            ->pluck('name', 'id')
            ->mapWithKeys(function ($name, $id) {
                return [ $name => route('categories.show', $id) ];
            });
    }
}
