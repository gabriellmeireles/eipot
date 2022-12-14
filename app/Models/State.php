<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'short_name',
        'status'        
    ];

    public function cities(){
        return $this->hasMany('cities','state_id','id');
    }
    
}
