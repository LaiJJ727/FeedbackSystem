<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;
use App\Models\Place;
class Branch extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'address','description','image','status'];
    protected $table = 'branches';

    public function places()
    {
        return $this->hasMany(Place::class,'branch_id','id');
    }
}
