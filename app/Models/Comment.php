<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by Pawan on 08/06/2020
 */
class Comment extends Model
{
    protected $fillable = ['user_id', 'job_id', 'parent_id', 'body'];

    /**
     * relationship with users    
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * relationship with comment replies    
     */
    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
