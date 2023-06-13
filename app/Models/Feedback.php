<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\User;
use App\Models\Comment;
use App\Models\Title;
use App\Models\Place;
use App\Models\Caegory;
use App\Models\Zone;
class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'branch_id', 'zone_id','place_id', 'category_id', 'title_id', 'feedback_to', 'description', 'status', 'image'];
    protected $table = 'feedbacks';

    public function getCreatedAtDiffAttribute()
    {
        return $this->created_at->format('Y-m-d g:i A');
    }
    public function getUpdateAtDiffAttribute()
    {
        return $this->updated_at->format('Y-m-d g:i A');
    }
    public function branches()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'feedback_id', 'id');
    }
    public function titles()
    {
        return $this->hasOne(Title::class, 'id', 'title_id');
    }
    public function places()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }
    public function categories(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function zones(){
        return $this->hasOne(Zone::class,'id','zone_id');
    }
}
