<?php

namespace App\Http\Controllers;

use App\Mail\BillboardsSuggested;
use App\Models\Contributor;
use App\Models\PendingContribution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ContributionController extends Controller
{
    public function index() {
        $contributors = Contributor::where('contribution_number', '>' ,0)->orderBy('contribution_number', 'desc')->get();

        return view('contribute', ['contributors' => $contributors]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "images" => "required|array",
            "images.*" => "required|image|max:5000",
            "comment" => "nullable|string|max:2500",
            "username" => "nullable|string",
        ]);

        $filenames = [];

        foreach ($validated["images"] as $key => $image) {
            if ($key > 9)
                break;

            $fileName = Carbon::now()->timestamp ."_". Str::uuid()->toString() .".". $image->getClientOriginalExtension();

            $image->storeAs(
                'pictures/uploaded/', $fileName
            );

            $filenames[] = $fileName;

            PendingContribution::create([
                "username" => $validated["username"] ?? "Anonymous",
                "comment" => $validated["comment"],
                "filename" => $fileName,
            ]);
        }

        Mail::to('contact@ssstuart.net')->send(new BillboardsSuggested($validated["username"] ?? "Anonymous", $validated["comment"] ?? "", $filenames));

        return redirect()
            ->back()
            ->with('success', 'Contribution saved. Thank you!');
    }
}
