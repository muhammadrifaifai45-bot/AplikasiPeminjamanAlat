<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active'
    ];

    public function Asset(){
        return $this->hasMany(Asset::class);
    }

    public function Ticket(){
        return $this->hasMany(Ticket::class);
    }


}
