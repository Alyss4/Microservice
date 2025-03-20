<?php
namespace App\Repositories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemRepository
{
    /**
     * Get all items.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Item::all();
    }

    /**
     * Get item by ID.
     *
     * @param  int  $id
     * @return Item|null
     */
    public function getById(int $id): ?Item
    {
        return Item::find($id);
    }

    /**
     * Create a new item.
     *
     * @param  array  $data
     * @return Item
     */
    public function create(array $data): Item
    {
        return Item::create($data);
    }

    /**
     * Update an existing item.
     *
     * @param  int  $id
     * @param  array  $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $item = $this->getById($id);
        if ($item) {
            return $item->update($data);
        }

        return false;
    }

    /**
     * Delete an item by ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $item = $this->getById($id);
        if ($item) {
            return $item->delete();
        }

        return false;
    }
}
