<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    //

    //table name
    protected $table = 'products_table';

    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'product_name',
        'category',
        'price',
        'quantity',
        'low_stock_threshold',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    
}
