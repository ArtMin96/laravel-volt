<?php

namespace App\Http\Controllers\Frontend;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('frontend.home');
    }
}
