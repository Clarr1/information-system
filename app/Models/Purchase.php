<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $table = 'purchase';

    protected $fillable = [
    'product_id',
    'quantity',
    'total_price',
];

    //
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
