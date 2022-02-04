<?php

namespace App\Http\Controllers;

class NavActive extends Controller
{
    public function navigation()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
