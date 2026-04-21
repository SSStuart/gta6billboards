<?php

namespace App\Http\Controllers;

use App\Models\Billboard;
use App\Models\Contributor;
use App\Models\Zone;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addBillboard() {
        $newId = Billboard::orderBy('id', 'desc')->first('id')->id + 1;

        $existingNames = Billboard::select('name')->distinct()->get();

        $zones = Zone::get();
        $contributors = Contributor::get();

        return view('admin.add_billboard', [
            'newId' => $newId,
            'existingBillboardNames' => $existingNames, 
            'zones' => $zones, 
            'contributors' => $contributors, 
        ]);
    }
}
