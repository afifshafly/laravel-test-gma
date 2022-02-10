<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'id','order_no','toko_id','status'
    ];

    public function toko()
    {
        return $this->belongsTo('App\Models\User','toko_id','id');
    }

    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail','order_id','id');
    }

}
