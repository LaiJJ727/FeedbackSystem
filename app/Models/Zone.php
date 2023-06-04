<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Place;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['c_name', 'e_name', 'status'];

    public function places()
    {
        return $this->hasMany(Place::class,'zone_id','id');
    }
}
