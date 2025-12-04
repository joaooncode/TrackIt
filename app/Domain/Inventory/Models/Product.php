<?php

namespace App\Domain\Inventory\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'description',
        'price',
        'stock_quantity',
        'min_stock_level',
    ];

    protected $casts = [
        'stock_quantity' => 'integer',
        'min_stock_level' => 'integer',
        'price' => 'integer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function hasSufficentStock(int $quantity): bool
    {
        return $this->stock_quantity >= $quantity;
    }

    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }
}
