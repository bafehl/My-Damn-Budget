<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payees', function (Blueprint $table) {
            $table->bigIncrements('payee_id');
            $table->bigInteger('budget_id');
            $table->bigInteger('type_id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unique(['budget_id', 'type_id']);
            $table->foreign('budget_id')->references('budget_id')->on('budgets')->onDelete('cascade');
            $table->foreign('type_id')->references('type_id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payees');
    }
}
