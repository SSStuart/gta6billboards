<?php

use App\Mail\ImagesUploaded;
use App\Models\Billboard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;

Schedule::call(function() {
    Log::info("Sending mail for awaiting uploaded images...");

    // Send email if new uploaded images
    $files = Storage::disk('public')->files("pictures/uploaded");

    $newFiles = [];

    $previousAlertTime = Carbon::now()->subWeek();
    foreach ($files as $file) {
        $fileTimestamp = explode("_", array_last(explode("/", $file)))[0];
        $fileParsedTimestamp = Carbon::createFromTimestamp($fileTimestamp);
        if ($fileParsedTimestamp > $previousAlertTime)
            $newFiles[] = $file;
    }

    if (count($newFiles) > 0)
        Mail::to("contact@ssstuart.net")->send(new ImagesUploaded($newFiles));
})->weekly();

Schedule::call(function() {
    Log::info("Running billboard sitemap update...");

    // Update billboards sitemap
    $billboards = Billboard::get();

    $generatedXML = view('xml.sitemap_billboards', compact('billboards'))->render();

    Storage::disk('public_root')->put("sitemap-billboards.xml", $generatedXML);
})->weekly();