<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index(Request $request)
    {
        $limit = (int) $request->query('limit', 0);
        $q = Dog::query()->select('id','nombre');
        if ($limit > 0) $q->limit($limit);
        return response()->json($q->get());
    }

    public function show($id)
    {
        $dog = Dog::find($id);
        if (!$dog) return response()->json(['message'=>'El perro no existe'], 404);
        return response()->json($dog);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nombre'=>'required|string|max:50']);
        $dog = Dog::create($data);
        return response()->json($dog, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(['nombre'=>'required|string|max:50']);
        $dog = Dog::find($id);
        if (!$dog) return response()->json(['message'=>'El perro no existe'], 404);
        $dog->update($data);
        return response()->json($dog);
    }

    public function destroy($id)
    {
        $dog = Dog::find($id);
        if (!$dog) return response()->json(['message'=>'El perro no existe'], 404);
        $dog->delete();
        return response()->noContent();
    }
}
