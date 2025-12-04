<?php

namespace App\Domain\Inventory\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasUuids;

    protected $table = 'categories';
    protected $fillable = ['name', 'description'];

    protected $hidden = ['created_at', 'updated_at'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
