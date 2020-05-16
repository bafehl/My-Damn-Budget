<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('tx_id');
            $table->bigInteger('account_id');
            $table->bigInteger('payee_id');
            $table->timestamptz('clear_date')->nullable();
            $table->decimal('amount', 30, 2);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('payee_id')->references('payee_id')->on('payees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
