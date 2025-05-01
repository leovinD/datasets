<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesPerson extends Model
{
    protected $fillable = [
        'date',
        'name',
        'region',
    ];

    /**
     * Get all of the products for the SalesPerson.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'sales_person_id');
    }
}
