<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactions extends Migration
{
    private $tableName = 'transactions';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id')->comment('It\'s Primary Key');
            $table->integer('deposit_id')->unsigned()->comment('Deposit id');
            $table->enum('direction', ['INTEREST', 'COMMISSION'])->comment('Transaction type');
            $table->decimal('total', 10, 2)->comment('Transaction amount');
            $table->timestamp('created_at')->comment('Transaction created time');

            $table->foreign('deposit_id', 'transactions_deposit_fk')->references('id')->on('deposits');
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
