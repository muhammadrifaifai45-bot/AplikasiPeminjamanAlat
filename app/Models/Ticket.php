<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable =[
        'user_id',
        'asset_id',
        'ticket_number',
        'qty',
        'Booked_at',
        'Borrowed_at',
        'due_at',
        'returned_at'
    ];

    public function user(){
       return  $this->belongsTo(User::class);
    }

    public function asset(){
       return  $this->belongsTo(Asset::class);
    }
}
