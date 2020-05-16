<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('account_id');
            $table->bigInteger('budget_id');
            $table->bigInteger('type_id');
            $table->bigInteger('currency_type_id');
            $table->text('name');
            $table->text('bank_name');
            $table->integer('account_number')->nullable();
            $table->timestamptz('opened_at');
            $table->timestamptz('closed_at')->nullable();
            $table->decimal('balance', 30, 2);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('budget_id')->references('budget_id')->on('budgets')->onDelete('cascade');
            $table->foreign('type_id')->references('type_id')->on('types')->onDelete('cascade');
            $table->foreign('currency_type_id')->references('type_id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
