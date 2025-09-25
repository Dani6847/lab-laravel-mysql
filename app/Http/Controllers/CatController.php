<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatController extends Controller
{
    public function index(Request $request)
    {
        $limit = (int) $request->query('limit', 0);
        $query = DB::table('gatos')->select('id', 'nombre');
        if ($limit > 0) {
            $query->limit($limit);
        }
        return response()->json($query->get());
    }

    public function show($id)
    {
        $cat = DB::table('gatos')->where('id', $id)->first();
        if (!$cat) {
            return response()->json(['message' => 'El gato no existe'], 404);
        }
        return response()->json($cat);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
        ]);
        $id = DB::table('gatos')->insertGetId(['nombre' => $validated['nombre']]);
        $cat = DB::table('gatos')->where('id', $id)->first();
        return response()->json($cat, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
        ]);
        $exists = DB::table('gatos')->where('id', $id)->exists();
        if (!$exists) {
            return response()->json(['message' => 'El gato no existe'], 404);
        }
        DB::table('gatos')->where('id', $id)->update(['nombre' => $validated['nombre']]);
        $cat = DB::table('gatos')->where('id', $id)->first();
        return response()->json($cat);
    }

    public function destroy($id)
    {
        $deleted = DB::table('gatos')->where('id', $id)->delete();
        if (!$deleted) {
            return response()->json(['message' => 'El gato no existe'], 404);
        }
        return response()->noContent(); // 204
    }
}
