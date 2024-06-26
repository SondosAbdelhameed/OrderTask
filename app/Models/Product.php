<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'brand_id',
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function purchases() {
        return $this->hasMany(Purchase::class);
    }
}
