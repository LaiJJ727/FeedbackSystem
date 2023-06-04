<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\Zone;

class Place extends Model
{
    use HasFactory;

    protected $fillable = ['zone_id','c_name', 'e_name', 'image', 'branch_id','status'];

    protected $table = 'places';

    public function branches()
    {
        return $this->hasOne(Branch::class,'id','branch_id');
    }
    public function zones()
    {
        return $this->hasOne(Zone::class,'id','zone_id');
    }



}
