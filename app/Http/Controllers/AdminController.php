<?php

namespace App\Http\Controllers;

use App\Models\Billboard;
use App\Models\Contributor;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

use function Illuminate\Support\now;

class AdminController extends Controller
{
    public function show() {
        if (Auth::guard('admin')->check())
            return redirect(route('admin.create'));

        else
            return view('admin.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            $redir = $request->input('redir');
            $params = request()->input('params');
            return redirect($redir ? route($redir, [$params]) : route('admin.create')); // Fallback if no redir
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match.',
        ])->onlyInput('username');
    }

    public function create() {
        $newId = 1;
        if (Billboard::count() > 0)
            $newId = Billboard::orderBy('id', 'desc')->first('id')->id + 1;

        $existingNames = Billboard::select('name')->distinct()->get();

        $groups = Billboard::distinct('group')->select('id', 'group', 'name')->get();

        $zones = Zone::get();
        $contributors = Contributor::get();

        return view('admin.add_billboard', [
            'newId' => $newId,
            'existingBillboardNames' => $existingNames,
            'groups' => $groups,
            'zones' => $zones,
            'contributors' => $contributors,
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "id" => "required|integer|unique:App\Models\Billboard,id",
            "contributorId" => "nullable|integer|exists:App\Models\Contributor,id",
            "newContributorUsername" => "nullable|string|unique:App\Models\Contributor,username",
            "image" => "required|file",
            "score" => "required|integer|between:0,4",
            "width" => "required|integer|between:0,4",
            "height" => "required|integer|between:0,4",
            "group" => "required|integer",
            "name" => "required|string",
            "description" => "required|string",
            "remark" => "nullable|string",
            "zoneId" => "nullable|integer|exists:App\Models\Zone,id",
            "newZoneName" => "nullable|string|unique:App\Models\Zone,name",
            "coord_x" => "required|numeric",
            "coord_y" => "required|numeric",
        ]);

        $zoneId = $validated["zoneId"] ?? 0;
        $contributorId = $validated["zoneId"] ?? 0;

        if (!isset($validated["contributorId"]) && !$validated["newContributorUsername"])
            return back()->withErrors([
                'contributorId' => "Contributor ID or New contributor name is required",
            ]);
        elseif (!isset($validated["contributorId"]) && $validated["newContributorUsername"])
            // Insert new contributor
            $contributorId = Contributor::insertGetId([
                'username' => $validated["newContributorUsername"],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        if (!isset($validated["zoneId"]) && !$validated["newZoneName"])
            return back()->withErrors([
                'contributorId' => "Zone ID or New zone name is required",
            ]);
        elseif (!isset($validated["zoneId"]) && $validated["newZoneName"])
            // Insert new zone
            $zoneId = Zone::insertGetId([
                'name' => $validated["newZoneName"],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $slug = substr(Str::of($validated["name"])->slug('_'), 0, 200) . "_{$validated['id']}";

        // Image processing
        $fileName = "{$slug}.". $request->file('image')->getClientOriginalExtension();

        if (!Storage::exists('pictures/billboards'))
            Storage::makeDirectory('pictures/billboards');

        $uploadedImage = $request->file('image')->storeAs(
            'pictures/billboards', $fileName, 'public'
            );

        $manager = new ImageManager(new Driver());

        $manager->decode(storage_path("app/public/".$uploadedImage))
                        ->scaleDown(50, 50)
                        ->save(storage_path('app/public/pictures/billboards/thumbnails/'.$fileName), quality: 10, progressive: true);

        Billboard::insert([
            "group" => $validated["group"],
            "name" => $validated["name"],
            "slug" => $slug,
            "description" => $validated["description"],
            "remark" => $validated["remark"],
            "zone_id" => $zoneId,
            "coordinates" => json_encode(["x" => $validated["coord_x"], "y" => $validated["coord_y"]]),
            "filename" => $fileName,
            "width" => $validated["width"],
            "height" => $validated["height"],
            "score" => $validated["score"],
            "contributor_id" => $contributorId,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        // increase contributor contribution number
        Contributor::where('id', $contributorId)->increment('contribution_number');

        return redirect()
        ->back()
        ->with('success', 'New billboard added');
    }
}
