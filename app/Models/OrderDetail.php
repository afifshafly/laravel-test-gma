<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    protected $fillable = [
        'id','produk_id','order_id','qty','status'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Produk','produk_id','id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id','id');
    }


}
