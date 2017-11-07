<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DepositManager;
use App\Models\Deposit;
use Carbon\Carbon;

class InterestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit-calculate:interest {deposit?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Accrues interest on deposits';

    /**
     * @var DepositManager
     */
    private $depositManager;

    /**
     * Create a new command instance.
     *
     * InterestCommand constructor.
     * @param DepositManager $manager
     */
    public function __construct(DepositManager $manager)
    {
        parent::__construct();
        $this->depositManager = $manager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($depositId = $this->argument('deposit')) {
            $this->depositManager->calculateInterest(Deposit::findOrFail($depositId));
            return;
        }

        /** @var Carbon $now */
        $now = Carbon::now();
        if ($now->day == $now->daysInMonth && $now->day != 31) {

            $yearMonth = $now->format('Y-m');
            $condition = "DATE_FORMAT(created_at, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d') AND ";
            foreach (range((integer)$now->day, 31) as $day) {
                $date = $yearMonth . '-' . $day;
                $condition .= "DATE_FORMAT(created_at, '%d') = DATE_FORMAT('{$date}', '%d') OR ";
            }
            $condition = rtrim($condition, " OR ");

        } else {
            $condition = "DATE_FORMAT(created_at, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d') AND DATE_FORMAT(created_at, '%d') = DATE_FORMAT('{$now->toDateString()}', '%d')";
        }

        Deposit::whereRaw($condition)->orderBy('id')->chunk(100, function ($deposits) {
            foreach ($deposits as $deposit) {
                $this->depositManager->calculateInterest($deposit);
            }
        });
    }
}