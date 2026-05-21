<?php

use App\Models\Billboard;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->weekly();

Schedule::call(function() {
    // Update billboards sitemap
    $billboards = Billboard::get();

    $generatedXML = view('xml.sitemap_billboards', compact('billboards'))->render();

    Storage::disk('public_root')->put("sitemap-billboards.xml", $generatedXML);
})->weekly();