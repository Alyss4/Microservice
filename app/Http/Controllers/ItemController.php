<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    private static array $items = [
        ['id' => 1, 'name' => 'Épée', 'description' => 'Une épée tranchante', 'price' => 100.0],
        ['id' => 2, 'name' => 'Bouclier', 'description' => 'Un bouclier robuste', 'price' => 150.0],
        ['id' => 3, 'name' => 'Chaton', 'description' => 'Un gros chaton mignon ! ', 'price' => 150.0],

    ];
    public function index()
    {
        return response()->json(self::$items);
    }
    public function show($id)
    {
        $item = collect(self::$items)->firstWhere('id', $id);
        return $item ? response()->json($item) : response()->json(['error' => 'Item non trouvé'], 404);
    }
    public function store(Request $request)
    {
        $newItem = [
            'id' => count(self::$items) + 1,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ];
        self::$items[] = $newItem;

        return response()->json($newItem, 201);
    }

    public function update(Request $request, $id)
    {
        foreach (self::$items as &$item) {
            if ($item['id'] == $id) {
                $item['name'] = $request->input('name', $item['name']);
                $item['description'] = $request->input('description', $item['description']);
                $item['price'] = $request->input('price', $item['price']);
                return response()->json($item);
            }
        }
        return response()->json(['error' => 'Item non trouvé'], 404);
    }
    public function destroy($id)
    {
        foreach (self::$items as $key => $item) {
            if ($item['id'] == $id) {
                array_splice(self::$items, $key, 1);
                return response()->json(['message' => 'Item supprimé :(']);
            }
        }

        return response()->json(['error' => 'Item non trouvé >:(' ], 404);
    }
}
