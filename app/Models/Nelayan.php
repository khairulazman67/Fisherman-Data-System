<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nelayan extends Model
{
    // use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'id_boat'
    ]; 
    
    public function Boat(){
        return $this->belongsTo(Boat::class,'id_boat','id');
    }
}
