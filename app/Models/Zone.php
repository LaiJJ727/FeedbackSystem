<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\Place;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id','c_name', 'e_name', 'status'];

    public function branches()
    {
        return $this->hasOne(Branch::class,'id','branch_id');
    }
    public function places()
    {
        return $this->hasMany(Place::class,'zone_id','id');
    }
}
