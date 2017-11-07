<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $balanceStat = DB::select(
            DB::raw("
                SELECT DATE_FORMAT(created_at,'%Y-%m') AS month, 
                    SUM(CASE WHEN direction = 'COMMISSION' THEN total END) AS profit, 
                    SUM(CASE WHEN direction = 'INTEREST' THEN total END) AS loss
                FROM transactions
                GROUP BY month;
            ")
        );

        $usersStat = DB::select(
            DB::raw("
                SELECT 'от 18 до 25' AS 'age_group', ROUND(SUM(d.balance) / COUNT(d.id), 2) AS average
                FROM users AS u
                JOIN deposits as d ON d.user_id = u.id 
                WHERE TIMESTAMPDIFF(YEAR, birthday ,NOW()) BETWEEN  18 AND 25
                UNION ALL
                SELECT 'от 25 до 50' AS 'age_group', ROUND(SUM(d.balance) / COUNT(d.id), 2) AS average
                FROM users AS u
                JOIN deposits as d ON d.user_id = u.id 
                WHERE TIMESTAMPDIFF(YEAR, birthday ,NOW()) BETWEEN  25 AND 50
                UNION ALL
                SELECT 'старше 50' AS 'age_group', ROUND(SUM(d.balance) / COUNT(d.id), 2) AS average 
                FROM users AS u
                JOIN deposits as d ON d.user_id = u.id 
                WHERE TIMESTAMPDIFF(YEAR, birthday ,NOW()) > 50;
            ")
        );

        return view('statistics.index', [
            'balanceStat' => $balanceStat,
            'usersStat' => $usersStat,
        ]);
    }
}