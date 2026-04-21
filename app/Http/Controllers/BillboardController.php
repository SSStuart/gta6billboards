<?php

namespace App\Http\Controllers;

use App\Models\Billboard;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BillboardController extends Controller
{
    public function index(): View
    {
        $billboards = Billboard::get();

        return view('home', ['billboards' => $billboards]);
    }

    public function show($slug) {
        $billboard = Billboard::where('slug', $slug)->first();
        $previousBillboard = Billboard::where('id', '<', $billboard->id)->orderBy('id', 'desc')->first();
        $nextBillboard = Billboard::where('id', '>', $billboard->id)->orderBy('id')->first();
        
        return view('billboard', ['billboard' => $billboard, 'previousBillboard' => $previousBillboard, 'nextBillboard' => $nextBillboard]);
    }
}
