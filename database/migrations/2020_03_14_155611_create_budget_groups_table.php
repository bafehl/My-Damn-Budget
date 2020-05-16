<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_groups', function (Blueprint $table) {
            $table->bigIncrements('group_id');
            $table->bigInteger('budget_id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->integer('sequence');
            $table->boolean('is_hidden')->default(false);
            $table->timestamps();
            $table->unique(['budget_id', 'name']);
            $table->foreign('budget_id')->references('budget_id')->on('budgets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_groups');
    }
}
