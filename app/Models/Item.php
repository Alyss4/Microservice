<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contrats\IEntity;

class Item extends Model implements IEntity
{
    protected $fillable = ['name', 'description', 'price'];

    public function getId(): int
    {
        return $this->id;
    }
}
?>
