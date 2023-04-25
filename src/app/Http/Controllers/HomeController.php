<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Helpers\PageHelper;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return PageHelper::standard(
            'Poopie',
            'silverowl::home',
            []
        );
    }
}
