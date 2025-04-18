<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;

class ThemeController extends Controller
{
    public function index()
    {
        return Theme::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:themes,name',
            'image' => 'required|image'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('items'), $imageName);
        }

        $theme = new Theme();
        $theme->name = $request->name;
        $theme->image = $imageName;
        $theme->save();

        return response()->json(['message' => 'Téma sikeresen mentve!'], 201);
    }
}
