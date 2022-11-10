<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscellaneousController extends Controller
{
    public function index()
    {
        return redirect()->route('categories.index');
    }
}
