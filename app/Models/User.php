<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 *
 * @property string $firstname
 * @property string $lastname
 * @property string $inn
 * @property integer $birthday
 * @property \App\Models\Deposit[] $deposits
 */
class User extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'inn',
        'birthday',
    ];

    /**
     * Get the Deposits for the User.
     */
    public function deposits()
    {
        return $this->hasMany('App\Models\Deposit');
    }

    /**
     * @return string
     */
    function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
