<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;

class Title extends Model
{
    use HasFactory;

    protected $fillable = ['c_name', 'e_name', 'image', 'status'];

    protected $table = 'titles';

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class,'title','id');
    }


}
