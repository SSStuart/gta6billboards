<?php

namespace App\Http\Controllers;

use App\Models\Contributor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContributionController extends Controller
{
    public function index() {
        $contributors = Contributor::where('contribution_number', '>' ,0)->orderBy('contribution_number', 'desc')->get();

        return view('contribute', ['contributors' => $contributors]);
    }

    public function store(Request $request) {
        return redirect()
            ->back()
            ->with('error', 'Still coming soon');

        $validated = $request->validate([
            "images" => "required|array",
            "images.*" => "required|image|max:2000",
            "comment" => "nullable|string",
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
        }

        $comment = [
            Carbon::now()->timestamp => [
                "files" => $filenames,
                "username" => $validated["username"],
                "comment" => $validated['comment'],
            ]
        ];

        Storage::append('uploaded_comments.json', ",\r\n".json_encode($comment, JSON_PRETTY_PRINT));

        return redirect()
            ->back()
            ->with('success', 'Contribution saved. Thank you!');
    }
}
