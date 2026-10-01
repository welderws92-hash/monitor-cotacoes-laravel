<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable= [
        'code',
        'name',
        'type',
        'symbol',
        'current_price',
        'high_price',
        'low_price',
        'validation_24h',
    
    ];
     protected function casts(): array
     {
        return [
            'decimal:4',
            'decimal:4',
            'decimal:4',
            'decimal:2',
        ];
    }
    public function priceHistories()
    {
        return $this->hasMany(PriceHistory::class);
    }
    public function alerts()
    {
        return $this->hasMany(PriceAlert::class);
    }
}
