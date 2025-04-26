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
            'image' => 'required|mimes:jpg,jpeg,png,gif'
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

    /**
     * Remove the specified theme.
     */
    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);
        if ($theme->image) {
            $path = public_path('items/' . $theme->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $theme->delete();
        return response()->json(['message' => 'Téma sikeresen törölve!']);
    }

}
