<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DepositManager;
use App\Models\Deposit;

class CommissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit-calculate:commission {deposit?}';

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
            $this->depositManager->calculateCommission(Deposit::findOrFail($depositId));
            return;
        }

        $condition = "DATE_FORMAT(created_at, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d')";
        Deposit::whereRaw($condition)->orderBy('id')->chunk(100, function ($deposits) {
            foreach ($deposits as $deposit) {
                $this->depositManager->calculateCommission($deposit);
            }
        });
    }
}