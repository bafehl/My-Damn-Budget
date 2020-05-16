<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sched_transactions', function (Blueprint $table) {
            $table->bigIncrements('sched_id');
            $table->bigInteger('account_id');
            $table->bigInteger('payee_id');
            $table->timestamptz('sched_date');
            $table->timestamptz('sched_until')->nullable();
            $table->decimal('ammount', 30, 2);
            $table->text('note')->nullable();
            $table->boolean('is_complete')->default(false);
            $table->boolean('is_recurring')->default(true);
            $table->boolean('recurrs_daily')->default(false);
            $table->boolean('recurrs_weekly')->default(false);
            $table->boolean('recurrs_monthly')->default(true);
            $table->boolean('recurrs_quarterly')->default(false);
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
        Schema::dropIfExists('sched_transactions');
    }
}
