<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tangkapan extends Model
{
    // use HasFactory;
    public function Boat(){
        return $this->belongsTo(Boat::class,'id_boat','id');
    }
}
