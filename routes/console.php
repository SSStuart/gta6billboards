<?php

use App\Mail\PendingContributionNotification;
use App\Models\Billboard;
use App\Models\PendingContribution;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;

Schedule::call(function() {
    Log::info("Sending weekly mail for pending contributions...");

    $pendingContributions = PendingContribution::get();

    if ($pendingContributions->count > 0)
        Mail::to("contact@ssstuart.net")->send(new PendingContributionNotification($pendingContributions));
})->weekly();

Schedule::call(function() {
    Log::info("Running billboard sitemap update...");

    // Update billboards sitemap
    $billboards = Billboard::get();

    $generatedXML = view('xml.sitemap_billboards', compact('billboards'))->render();

    Storage::disk('public_root')->put("sitemap-billboards.xml", $generatedXML);
})->weekly();