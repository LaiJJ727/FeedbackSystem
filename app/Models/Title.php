<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;
use App\Models\Category;

class Title extends Model
{
    use HasFactory;

    protected $fillable = ['c_name', 'e_name', 'image', 'category_id','status'];

    protected $table = 'titles';

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class,'title','id');
    }
    public function categories()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

}
