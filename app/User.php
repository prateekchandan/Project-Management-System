<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table="users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
     public $timestamps = false;
    protected $primaryKey = 'userid';
    public $incrementing = false;

    public function getRememberToken()
    {
        return '';
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        // just anything that's not actually on the model
        return 'trash_attribute';
    }

    /**
     * Fake attribute setter so that Guard doesn't complain about
     * a property not existing that it tries to set.
     *
     * Does nothing, obviously.
     */
    public function setTrashAttributeAttribute($value)
    {
    }

}
