<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class DepositsTableSeeder extends Seeder
{
    /**
     * 2014-01-01
     *
     * @var int
     */
    private $createdFrom = 1388527200;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = time();

        $deposits = [];
        foreach (User::get() as $user) {
            foreach (range(1, rand(1, 3)) as $item) {

                $value = rand(100, 10000);
                $created = date('Y-m-d H:i:s', rand($this->createdFrom, $now));

                $deposits[] = [
                    'user_id' => $user->id,
                    'interest_rate' => rand(3, 12),
                    'start_value' => $value,
                    'balance' => $value,
                    'created_at' => $created,
                    'updated_at' => $created,
                ];
            }
        }

        DB::table('deposits')->insert($deposits);
    }
}
