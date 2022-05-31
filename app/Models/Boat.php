<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    // use HasFactory;
    protected $table="boats";
    protected $fillable = [
        'nama',
        'pemilik'
    ]; 
    public function Nelayan(){
        return $this->hasMany(Nelayan::class,'id_boat');
    }
    public function Tangkapan(){
        return $this->hasMany(Tangkapan::class,'id_boat');
    }
}
