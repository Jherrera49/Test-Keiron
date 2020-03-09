<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $table = 'tickets';
    protected $fillable = [
        'id_user', 'ticket_pedido'
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    
}
