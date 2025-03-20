<?php
namespace App\Http\Controllers;

use App\DTOs\ItemDTO;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $dto = new ItemDTO($validatedData);
        $item = $this->itemRepository->create($dto->toArray());

        return response()->json($item, 201);
    }
    public function show($id)
    {
        $item = $this->itemRepository->getById($id);

        return $item
            ? response()->json($item)
            : response()->json(['error' => '404'], 404);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
        ]);

        $dto = new ItemDTO($validatedData);
        $updated = $this->itemRepository->update($id, $dto->toArray());

        return $updated
            ? response()->json(['message' => '200'])
            : response()->json(['error' => '404'], 404);
    }
}
