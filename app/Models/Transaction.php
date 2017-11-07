<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Models
 * 
 * @property string $direction
 * @property integer $total
 * @property \App\Models\Deposit $deposit
 */
class Transaction extends Model
{
    const UPDATED_AT = null;

    const DIRECTION_COMMISSION = 'COMMISSION';
    const DIRECTION_INTEREST = 'INTEREST';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deposit_id',
        'direction',
        'total',
    ];

    /**
     * Get the Deposit that owns the Transaction.
     */
    public function deposit()
    {
        return $this->belongsTo('App\Models\Deposit');
    }

}
