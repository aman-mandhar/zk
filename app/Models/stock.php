<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class Stock extends Model
{
    protected $fillable = [
        'item_id',
        'prod_pic',
        'name',
        'measure',
        'tot_no_of_items',
        'qrcode',
        'pur_value',
        'cgst',
        'sgst',
        'mrp',
        'sale_price',
        'tot_points',
        'pur_bill_no',
        'merchant',
        'user_id',
        ];

    // Relationships
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}