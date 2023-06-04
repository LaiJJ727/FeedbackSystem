<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
class Place extends Model
{
    use HasFactory;

    protected $fillable = ['zone_id','c_name', 'e_name', 'image', 'branch_id','status'];

    protected $table = 'places';

    public function branches()
    {
        return $this->hasOne(Branch::class,'id','branch_id');
    }



}
