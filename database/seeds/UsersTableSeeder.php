<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    private $firstNameList = [
        'Андрей', 'Вячеслав', 'Артем', 'Сергей', 'Евгений', 'Владимир', 'Мхаил', 'Николай',
        'Ростислав', 'Борис', 'Виктор', 'Виталий', 'Максим', 'Антон', 'Юрий', 'Станислав',
        'Виктория', 'Анна', 'Анжела', 'Елена', 'Екатерина', 'Ольга', 'Марина', 'Янина',
        'София', 'Анастасия', 'Алла', 'Тамила', 'Нина', 'Светлана', 'Надежда', 'Наталья'
    ];

    private $lastNameList = [
        'Бойко', 'Дробот', 'Пасечник', 'Столяр', 'Головко', 'Петренко', 'Руденко', 'Ситченко',
        'Пономарь', 'Бондарь', 'Котляр', 'Семенченко', 'Довгань', 'Сененко', 'Никитченко', 'Постельга',
    ];

    private $inn = '123456789000';

    /**
     * From 1950-01-01
     * @var int
     */
    private $ageFrom = -631162800;

    /**
     * To 1999-01-01
     * @var int
     */
    private $ageTo = 915141600;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];

        foreach (range(1, 50) as $item) {
            $users[] = [
                'firstname' => $this->firstNameList[array_rand($this->firstNameList)],
                'lastname' => $this->lastNameList[array_rand($this->lastNameList)],
                'inn' => $this->inn++,
                'birthday' => date('Y-m-d', rand($this->ageFrom, $this->ageTo)),
            ];
        }

        DB::table('users')->insert($users);
    }
}
