<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'sale_category_id', 'region_id'];

    public function category()
    {
        return $this->belongsTo(SaleCategory::class, 'sale_category_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    // public function region()
    // {
    //     return $this->belongsTo(Region::class, 'region_id');
    // }
}
