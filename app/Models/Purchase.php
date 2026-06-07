<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $table = 'purchase';

    protected $fillable = [
    'product_id',
    'product_name',
    'quantity',
    'total_price',
    'cash_received',
    'change_amount',
];

    //
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
