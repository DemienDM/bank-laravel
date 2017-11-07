<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUser extends Migration
{
    private $tableName = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id')->comment('It\'s Primary Key');
            $table->string('firstname')->comment('Users Firstname');
            $table->string('lastname')->comment('Users Lastname');
            $table->string('inn')->unique()->comment('Taxpayer identification number');
            $table->dateTime('birthday')->comment('Users birthday date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
