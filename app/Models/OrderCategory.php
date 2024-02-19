<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderCategory extends Pivot
{
    protected $table = 'order_category';

    protected $fillable = [
        'order_id',
        'category_id',
        'category_name'
    ];




    public function categories()
    {
        return $this->belongsToMany(Category::class)
                    ->withPivot('category_name') // Add additional pivot columns as needed
                    ->using(OrderCategory::class); // Custom pivot model
    }
}
