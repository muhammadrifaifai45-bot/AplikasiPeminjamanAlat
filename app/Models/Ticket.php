<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'user_id',
        'asset_id',
        'ticket_number',
        'qty',
        'Booked_at',
        'Borrowed_at',
        'updated_at',
        'due_at',
        'returned_at',
        'note',
        'status'

    ];

    public function user(){
       return  $this->belongsTo(User::class);
    }

    public function asset(){
       return  $this->belongsTo(Asset::class);
    }
}
