<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    public function basket(Request $request)
    {
        return view('basket');
    }
    public function contacts(Request $request)
    {
        return view('contacts');
    }
    public function categories(Request $request)
    {
        return view('categories');
    }
    public function subcategories(Request $request)
    {
        return view('subcategories');
    }
    public function products(Request $request)
    {
        return view('products');
    }
    public function home(Request $request)
    {
        return view('home');
    }
}
