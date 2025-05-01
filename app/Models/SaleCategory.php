<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    public function products()
    {
        return $this->hasMany(Product::class, 'sale_category_id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'sale_category_id'); 
    }
}
