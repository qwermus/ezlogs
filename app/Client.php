<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [
        'firstname',
        'surname',
        'age',
        'license',
        'photo',
        'phone_text',
        'phone_int',
        'address'
    ];

    /**
     * Hidden fields
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * User has many comments
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }

    /**
     * Where like function if field exists
     * It's awfull, i know, i can not use if-statement in model. Sorry me:(
     * @param $fieldName
     * @param $requestValue
     */
    public static function scopeWhereLike($query, $fieldName, $requestValue)
    {
        if ($requestValue != '') {
            $query->where($fieldName,'LIKE','%'.$requestValue.'%');
        }
    }
}
