<?php
namespace App\Http\Controllers;

use App\Repositories\ItemRepository;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function index()
    {
        $items = $this->itemRepository->getAll();
        return response()->json($items);
    }

    public function show($id)
    {
        $item = $this->itemRepository->getById($id);
        return $item ? response()->json($item) : response()->json(['error' => 'Item not found'], 404);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $item = $this->itemRepository->create($data);

        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
        ]);

        $updated = $this->itemRepository->update($id, $data);

        return $updated ? response()->json(['message' => 'Item updated']) : response()->json(['error' => 'Item not found'], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->itemRepository->delete($id);
        return $deleted ? response()->json(['message' => 'Item deleted']) : response()->json(['error' => 'Item not found'], 404);
    }
}
