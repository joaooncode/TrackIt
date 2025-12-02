<?php

namespace App\Domain\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected   $table = 'categories';
    protected   $fillable = ['name', 'description'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
