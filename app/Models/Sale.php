<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_date',
        'product_id',
        'region_id',
        'sale_category_id',
        'salesperson_id',
        'units_sold',
        'unit_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function salesperson()
    {
        return $this->belongsTo(Salesperson::class);
    }

    public function saleCategory() 
    {
        return $this->belongsTo(SaleCategory::class, 'sale_category_id');
    }

    // Computed total sales accessor
    public function getTotalSalesAttribute()
    {
        return $this->units_sold * $this->unit_price;
    }
}

