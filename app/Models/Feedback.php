<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\User;
use App\Models\Comment;
use App\Models\Title;
use App\Models\Place;
class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'place_id','feedback_to','title_id','description','status','image','branch_id'];
    protected $table = 'feedbacks';

    public function branches()
    {
        return $this->hasOne(Branch::class,'id','branch_id');
    }
    public function users()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'feedback_id','id');
    }
    public function titles()
    {
        return $this->hasOne(Title::class,'id','title_id');
    }
    public function places()
    {
        return $this->hasOne(Place::class,'id','place_id');
    }
}
