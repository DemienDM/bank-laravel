<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeposit extends Migration
{
    private $tableName = 'deposits';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id')->comment('It\'s Primary Key');
            $table->integer('user_id')->unsigned()->comment('Users id');
            $table->integer('interest_rate')->unsigned()->comment('Deposit interest rate');
            $table->decimal('start_value', 10)->comment('An initial fee');
            $table->decimal('balance', 10)->comment('Current deposit balance');
            $table->timestamps();

            $table->foreign('user_id', 'deposit_users_fk')->references('id')->on('users');
            $table->index('created_at');
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
