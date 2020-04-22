<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'comment_id',
        'comment'
    ];

    /**
     * Hidden fields
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Comment belongs to user
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'parent_id');
    }
}
