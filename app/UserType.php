<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_types';
    protected $fillable = [
        'nombre'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
    
}
