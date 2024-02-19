<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliveryStatus',
        'vehicle',
        'customer_id',
        'product_id',
        'category_id',
        'category_name',
        'user_id',
        'product_details',
        'file',
        'fil',
        'product2_id',
        'Product1_quantity',
        'Product2_quantity',

    ];
/*
    protected $casts = [
        'category_id'=> 'array',
        'category_name' => 'array',




    ];

*/
    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity')
                    ->using(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
    public function categories()
    {
        return $this->belongsToMany(Category::class)
                    ->withPivot( 'category_name')
                    ->using(OrderCategory::class);
    }
}
