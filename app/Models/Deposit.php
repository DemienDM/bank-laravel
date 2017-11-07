<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Deposit
 * @package App\Models
 * 
 * @property integer $id
 * @property integer $user_id
 * @property integer $interest_rate
 * @property string $start_value
 * @property integer $balance
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\User $user
 * @property \App\Models\Transaction[] $transactions
 */
class Deposit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'interest_rate',
        'start_value',
    ];

    /**
     * Get the User that owns the Deposit.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the Transactions for the Deposit.
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
