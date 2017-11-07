<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\{
    Deposit, Transaction
};

/**
 * Make transactions with Deposits
 *
 * Class DepositManager
 * @package App\Services
 */
class DepositManager
{
    const MIN_COMMISSION_VALUE = 50;
    const MAX_COMMISSION_VALUE = 500;
    const COMMISSION_SCALE = [
        [
            'from' => 0,
            'to' => 1000,
            'percent' => 5,
        ],
        [
            'from' => 1000,
            'to' => 10000,
            'percent' => 6,
        ],
        [
            'from' => 10000,
            'to' => null,
            'percent' => 7,
        ],
    ];

    /**
     * @var \App\Models\Deposit
     */
    private $deposit;

    /**
     * Calculating interest for Deposit & create Transaction
     *
     * @param Deposit $model
     */
    public function calculateInterest(Deposit $model)
    {
        $this->deposit = $model;
        $interestValue = $this->calculatePercentValue($this->deposit->interest_rate);
        $this->deposit->balance = round($this->deposit->balance + $interestValue, 2, PHP_ROUND_HALF_EVEN);
        $this->store(Transaction::DIRECTION_INTEREST, $interestValue);
    }

    /**
     * Calculating commission for Deposit & create Transaction
     *
     * @param Deposit $model
     */
    public function calculateCommission(Deposit $model)
    {
        $this->deposit = $model;
        $percent = $this->getCommissionPercent();
        $commissionValue = $this->calculatePercentValue($percent);
        /**
         * If the deposit was created last month
         */
        $daysDifference = Carbon::now()->diff($this->deposit->created_at)->days;
        if ($daysDifference < $this->deposit->created_at->daysInMonth) {
            $commissionValuePerDay = $commissionValue / $this->deposit->created_at->daysInMonth;
            $commissionValue = $daysDifference * $commissionValuePerDay;
        } else {
            if ($commissionValue < self::MIN_COMMISSION_VALUE)
                $commissionValue = self::MIN_COMMISSION_VALUE;

            if ($commissionValue > self::MAX_COMMISSION_VALUE)
                $commissionValue = self::MAX_COMMISSION_VALUE;
        }
        $this->deposit->balance = round($this->deposit->balance - $commissionValue, 2, PHP_ROUND_HALF_EVEN);
        $this->store(Transaction::DIRECTION_COMMISSION, $commissionValue);
    }

    /**
     * Updated deposit with its Transaction
     *
     * @param string $direction
     * @param float $total
     */
    private function store(string $direction, float $total)
    {
        DB::transaction(function () use ($direction, $total) {
            $this->deposit->save();
            (new Transaction([
                'deposit_id' => $this->deposit->id,
                'total' => $total,
                'direction' => $direction,
            ]))->save();
        });
    }

    /**
     * Set a new Deposit balance value and return the total of change
     *
     * @param int $percent
     * @return float
     */
    private function calculatePercentValue(int $percent): float
    {
        $percentValue = $this->deposit->balance * $percent / 100;

        return round($percentValue, 2, PHP_ROUND_HALF_EVEN);
    }

    /**
     * Find & return the commission rate on the balance sheet
     *
     * @return int
     */
    private function getCommissionPercent(): int
    {
        $balance = (float)$this->deposit->balance;
        foreach (self::COMMISSION_SCALE as $commission) {
            if ($balance >= $commission['from']) {
                if (is_null($commission['to']) || $balance < $commission['to']) {
                    return $commission['percent'];
                }
            }
        }
    }
}