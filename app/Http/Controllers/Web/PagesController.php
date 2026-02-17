<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.pages');
    }
}
