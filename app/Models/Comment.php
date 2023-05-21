<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'feedback_id','description','image','click_status'];

    protected $table = 'comments';

    public function users()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function feedbacks()
    {
        return $this->hasOne(Feedback::class,'id','feedback_id');
    }
}
