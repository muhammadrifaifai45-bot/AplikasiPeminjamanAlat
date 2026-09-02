<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'code',
        'total_qty',
        'good_qty',
        'damaged_qty',
        'borrowed_qty',
        'lost_qty',
        'is_avaliable',
        'image',
        'description'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
